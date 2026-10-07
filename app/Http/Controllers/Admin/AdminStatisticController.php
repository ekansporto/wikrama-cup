<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminStatisticController extends Controller
{
    /**
     * Display the Box Score management page for matches.
     */
    public function index(Request $request)
    {
        $matches = MatchModel::with(['teamA', 'teamB'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        $matchId = $request->query('match_id', $matches->first()?->id_match);

        $selectedMatch = null;
        $statsMap = collect();

        if ($matchId) {
            $selectedMatch = MatchModel::with([
                'teamA.players' => fn($q) => $q->orderBy('no_punggung', 'asc'),
                'teamB.players' => fn($q) => $q->orderBy('no_punggung', 'asc'),
                'statistics.player.team',
            ])->find($matchId);

            if ($selectedMatch) {
                $statsMap = $selectedMatch->statistics->keyBy('id_player');
            }
        }

        $teams = Team::withCount('players')->orderBy('nama_tim', 'asc')->get();

        return view('admin.statistics.index', compact('matches', 'selectedMatch', 'statsMap', 'teams', 'matchId'));
    }

    /**
     * Update Box Score statistics for all players in a match simultaneously.
     */
    public function updateBatch(Request $request, $matchId)
    {
        $match = MatchModel::with(['teamA.players', 'teamB.players'])->findOrFail($matchId);
        $statsData = $request->input('stats', []);

        $totalA = 0;
        $totalB = 0;

        foreach ($statsData as $playerId => $data) {
            $poin = (int) ($data['poin'] ?? 0);
            $reb = (int) ($data['rebound'] ?? 0);
            $ast = (int) ($data['assist'] ?? 0);
            $stl = (int) ($data['steal'] ?? 0);
            $blk = (int) ($data['block'] ?? 0);
            $to = (int) ($data['turnover'] ?? 0);
            $foul = (int) ($data['foul'] ?? 0);

            $threePointMade = (int) ($data['three_point_made'] ?? 0);
            $threePointAtt = (int) ($data['three_point_attempted'] ?? max($threePointMade, 0));

            $twoPointMade = (int) ($data['two_point_made'] ?? 0);
            $twoPointAtt = (int) ($data['two_point_attempted'] ?? max($twoPointMade, 0));

            $ftMade = (int) ($data['free_throw_made'] ?? 0);
            $ftAtt = (int) ($data['free_throw_attempted'] ?? max($ftMade, 0));

            $fgm = (int) ($data['fgm'] ?? ($threePointMade + $twoPointMade));
            $fga = (int) ($data['fga'] ?? max($fgm, $threePointAtt + $twoPointAtt));

            Statistic::updateOrCreate(
                [
                    'id_match' => $match->id_match,
                    'id_player' => $playerId,
                ],
                [
                    'minutes' => $data['minutes'] ?? '20:00',
                    'poin' => $poin,
                    'rebound' => $reb,
                    'assist' => $ast,
                    'steal' => $stl,
                    'block' => $blk,
                    'turnover' => $to,
                    'foul' => $foul,
                    'three_point_made' => $threePointMade,
                    'three_point_attempted' => $threePointAtt,
                    'two_point_made' => $twoPointMade,
                    'two_point_attempted' => $twoPointAtt,
                    'fgm' => $fgm,
                    'fga' => $fga,
                    'free_throw_made' => $ftMade,
                    'free_throw_attempted' => $ftAtt,
                    'plus_minus' => (int) ($data['plus_minus'] ?? 0),
                ]
            );

            // Calculate total team score
            if ($match->teamA && $match->teamA->players->contains('id_player', $playerId)) {
                $totalA += $poin;
            } elseif ($match->teamB && $match->teamB->players->contains('id_player', $playerId)) {
                $totalB += $poin;
            }
        }

        // Update match final score automatically from calculated points
        $match->update([
            'skor_tim_a' => $totalA,
            'skor_tim_b' => $totalB,
        ]);

        return redirect()->route('admin.statistics.index', ['match_id' => $match->id_match])
            ->with('success', "Statistik Box Score untuk {$match->teamA->nama_tim} vs {$match->teamB->nama_tim} berhasil disimpan! Skor otomatis diperbarui ({$totalA} - {$totalB}) dan terintegrasi ke seluruh web publik.");
    }

    /**
     * Store a new player (and team/school if needed) directly from Box Score view.
     */
    public function storePlayer(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'id_team' => ['nullable', 'exists:ms_teams,id_team'],
            'nama_tim_baru' => ['nullable', 'string', 'max:100'],
            'no_punggung' => ['required', 'integer', 'min:0', 'max:99'],
            'posisi' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', 'in:Boys,Girls'],
            'kelas_program' => ['nullable', 'string', 'max:100'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:100', 'max:250'],
            'berat_badan' => ['nullable', 'numeric', 'min:30', 'max:180'],
            'match_id' => ['nullable', 'exists:tr_matches,id_match'],
        ], [
            'nama.required' => 'Nama pemain wajib diisi.',
            'no_punggung.required' => 'Nomor punggung wajib diisi.',
            'posisi.required' => 'Posisi pemain wajib dipilih.',
            'gender.required' => 'Divisi/Gender wajib dipilih.',
        ]);

        // Resolve Team ID: Either existing or create new team/school
        $teamId = $validated['id_team'] ?? null;
        if (!empty($validated['nama_tim_baru'])) {
            $newTeam = Team::firstOrCreate([
                'nama_tim' => trim($validated['nama_tim_baru']),
            ]);
            $teamId = $newTeam->id_team;
        }

        if (!$teamId) {
            return back()->withErrors(['id_team' => 'Silakan pilih tim yang sudah ada atau ketik nama sekolah/tim baru.'])->withInput();
        }

        // Create player user account for authentication
        $slug = Str::slug($validated['nama']);
        $uniqueEmail = $slug . rand(100, 9999) . '@wikcup.id';

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $uniqueEmail,
            'password' => Hash::make('password123'),
            'role' => 'pemain',
        ]);

        // Create Player record
        $player = Player::create([
            'id_user' => $user->id_user,
            'id_team' => $teamId,
            'nama' => $validated['nama'],
            'no_punggung' => $validated['no_punggung'],
            'posisi' => $validated['posisi'],
            'gender' => $validated['gender'],
            'kelas_program' => $validated['kelas_program'] ?? null,
            'tinggi_badan' => $validated['tinggi_badan'] ?? null,
            'berat_badan' => $validated['berat_badan'] ?? null,
            'is_captain' => false,
        ]);

        $teamName = Team::find($teamId)?->nama_tim ?? 'Tim';
        $redirectMatchId = $request->input('match_id');

        return redirect()->route('admin.statistics.index', $redirectMatchId ? ['match_id' => $redirectMatchId] : [])
            ->with('success', "Pemain '{$player->nama}' (#{$player->no_punggung} - {$teamName}) berhasil ditambahkan dan siap diisi data statistiknya!");
    }

    /**
     * Store a new school / team directly.
     */
    public function storeTeam(Request $request)
    {
        $validated = $request->validate([
            'nama_tim' => ['required', 'string', 'max:100', 'unique:ms_teams,nama_tim'],
            'match_id' => ['nullable', 'exists:tr_matches,id_match'],
        ], [
            'nama_tim.required' => 'Nama tim/sekolah wajib diisi.',
            'nama_tim.unique' => 'Nama tim/sekolah sudah terdaftar.',
        ]);

        $team = Team::create([
            'nama_tim' => $validated['nama_tim'],
            'logo' => null,
        ]);

        $redirectMatchId = $request->input('match_id');

        return redirect()->route('admin.statistics.index', $redirectMatchId ? ['match_id' => $redirectMatchId] : [])
            ->with('success', "Tim/Sekolah '{$team->nama_tim}' berhasil didaftarkan!");
    }

    /**
     * Delete individual statistic entry.
     */
    public function destroy($id)
    {
        $statistic = Statistic::with('match')->findOrFail($id);
        $match = $statistic->match;
        $statistic->delete();

        // Recalculate score for the match
        if ($match) {
            $match->load(['teamA.players', 'teamB.players', 'statistics']);
            $totalA = 0;
            $totalB = 0;
            foreach ($match->statistics as $stat) {
                if ($match->teamA && $match->teamA->players->contains('id_player', $stat->id_player)) {
                    $totalA += $stat->poin;
                } elseif ($match->teamB && $match->teamB->players->contains('id_player', $stat->id_player)) {
                    $totalB += $stat->poin;
                }
            }
            $match->update([
                'skor_tim_a' => $totalA,
                'skor_tim_b' => $totalB,
            ]);
        }

        return redirect()->route('admin.statistics.index', $match ? ['match_id' => $match->id_match] : [])
            ->with('success', 'Data statistik pemain pada pertandingan ini berhasil dihapus.');
    }

    /**
     * Clear all stats for a specific match.
     */
    public function clearMatchStats($matchId)
    {
        $match = MatchModel::findOrFail($matchId);
        Statistic::where('id_match', $match->id_match)->delete();

        $match->update([
            'skor_tim_a' => null,
            'skor_tim_b' => null,
        ]);

        return redirect()->route('admin.statistics.index', ['match_id' => $match->id_match])
            ->with('success', 'Seluruh data statistik box score pertandingan ini telah di-reset.');
    }
}
