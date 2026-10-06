<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchModel;
use App\Models\Team;
use Illuminate\Http\Request;

class AdminMatchController extends Controller
{
    public function index()
    {
        $matches = MatchModel::with(['teamA', 'teamB'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->paginate(15);

        return view('admin.matches.index', compact('matches'));
    }

    public function create()
    {
        $teams = Team::orderBy('nama_tim', 'asc')->get();
        return view('admin.matches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_a_id' => ['required', 'exists:ms_teams,id_team'],
            'team_b_id' => ['required', 'exists:ms_teams,id_team', 'different:team_a_id'],
            'tanggal' => ['required', 'date'],
            'jam' => ['required'],
            'lokasi' => ['required', 'string', 'max:100'],
            'skor_tim_a' => ['nullable', 'integer', 'min:0'],
            'skor_tim_b' => ['nullable', 'integer', 'min:0'],
        ], [
            'team_a_id.required' => 'Tim A wajib dipilih.',
            'team_b_id.required' => 'Tim B wajib dipilih.',
            'team_b_id.different' => 'Tim B tidak boleh sama dengan Tim A.',
            'tanggal.required' => 'Tanggal pertandingan wajib diisi.',
            'jam.required' => 'Jam pertandingan wajib diisi.',
            'lokasi.required' => 'Lokasi pertandingan wajib diisi.',
        ]);

        MatchModel::create($validated);

        return redirect()->route('admin.matches.index')->with('success', 'Pertandingan / jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $match = MatchModel::findOrFail($id);
        $teams = Team::orderBy('nama_tim', 'asc')->get();

        return view('admin.matches.edit', compact('match', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $match = MatchModel::findOrFail($id);

        $validated = $request->validate([
            'team_a_id' => ['required', 'exists:ms_teams,id_team'],
            'team_b_id' => ['required', 'exists:ms_teams,id_team', 'different:team_a_id'],
            'tanggal' => ['required', 'date'],
            'jam' => ['required'],
            'lokasi' => ['required', 'string', 'max:100'],
            'skor_tim_a' => ['nullable', 'integer', 'min:0'],
            'skor_tim_b' => ['nullable', 'integer', 'min:0'],
        ], [
            'team_a_id.required' => 'Tim A wajib dipilih.',
            'team_b_id.required' => 'Tim B wajib dipilih.',
            'team_b_id.different' => 'Tim B tidak boleh sama dengan Tim A.',
            'tanggal.required' => 'Tanggal pertandingan wajib diisi.',
            'jam.required' => 'Jam pertandingan wajib diisi.',
            'lokasi.required' => 'Lokasi pertandingan wajib diisi.',
        ]);

        $match->update($validated);

        return redirect()->route('admin.matches.index')->with('success', 'Data pertandingan / hasil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $match = MatchModel::findOrFail($id);
        $match->delete();

        return redirect()->route('admin.matches.index')->with('success', 'Pertandingan berhasil dihapus!');
    }

    public function editStats($id)
    {
        $match = MatchModel::with(['teamA.players', 'teamB.players', 'statistics'])->findOrFail($id);
        
        // Buat map statistic by id_player
        $statsMap = $match->statistics->keyBy('id_player');
        
        return view('admin.matches.stats', compact('match', 'statsMap'));
    }

    public function updateStats(Request $request, $id)
    {
        $match = MatchModel::findOrFail($id);
        $statsData = $request->input('stats', []);
        
        $totalA = 0;
        $totalB = 0;

        foreach ($statsData as $playerId => $data) {
            // Update or create statistic
            \App\Models\Statistic::updateOrCreate(
                ['id_match' => $match->id_match, 'id_player' => $playerId],
                [
                    'minutes' => $data['minutes'] ?? '00:00',
                    'poin' => $data['poin'] ?? 0,
                    'rebound' => $data['rebound'] ?? 0,
                    'assist' => $data['assist'] ?? 0,
                    'steal' => $data['steal'] ?? 0,
                    'block' => $data['block'] ?? 0,
                    'turnover' => $data['turnover'] ?? 0,
                    'fgm' => $data['fgm'] ?? 0,
                    'fga' => $data['fga'] ?? 0,
                    'three_point_made' => $data['three_point_made'] ?? 0,
                    'three_point_attempted' => $data['three_point_attempted'] ?? 0,
                    'free_throw_made' => $data['free_throw_made'] ?? 0,
                    'free_throw_attempted' => $data['free_throw_attempted'] ?? 0,
                    'foul' => $data['foul'] ?? 0,
                ]
            );
            
            // Calculate total team score based on points
            if ($match->teamA->players->contains('id_player', $playerId)) {
                $totalA += (int)($data['poin'] ?? 0);
            } elseif ($match->teamB->players->contains('id_player', $playerId)) {
                $totalB += (int)($data['poin'] ?? 0);
            }
        }
        
        // Automatically update match score based on players' points
        $match->update([
            'skor_tim_a' => $totalA,
            'skor_tim_b' => $totalB
        ]);

        return redirect()->route('admin.matches.index')->with('success', 'Statistik seluruh pemain berhasil di-update sekaligus!');
    }
}
