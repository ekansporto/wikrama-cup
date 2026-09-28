<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminStatisticController extends Controller
{
    public function index(Request $request)
    {
        $matchId = $request->query('match_id');

        $matches = MatchModel::with(['teamA', 'teamB'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $query = Statistic::with(['player.team', 'match.teamA', 'match.teamB']);

        if ($matchId) {
            $query->where('id_match', $matchId);
        }

        $statistics = $query->orderBy('id_statistic', 'desc')->paginate(20)->withQueryString();

        return view('admin.statistics.index', compact('statistics', 'matches', 'matchId'));
    }

    public function create(Request $request)
    {
        $selectedMatchId = $request->query('match_id');
        $matches = MatchModel::with(['teamA.players', 'teamB.players'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $players = Player::with('team')->orderBy('nama', 'asc')->get();

        return view('admin.statistics.create', compact('matches', 'players', 'selectedMatchId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_match' => ['required', 'exists:tr_matches,id_match'],
            'id_player' => [
                'required',
                'exists:ms_players,id_player',
                Rule::unique('tr_statistics')->where(function ($query) use ($request) {
                    return $query->where('id_match', $request->id_match)
                                 ->where('id_player', $request->id_player);
                }),
            ],
            'minutes' => ['required', 'string', 'max:10'],
            'poin' => ['required', 'integer', 'min:0'],
            'rebound' => ['required', 'integer', 'min:0'],
            'defensive_rebound' => ['nullable', 'integer', 'min:0'],
            'assist' => ['required', 'integer', 'min:0'],
            'steal' => ['required', 'integer', 'min:0'],
            'block' => ['required', 'integer', 'min:0'],
            'turnover' => ['required', 'integer', 'min:0'],
            'foul' => ['nullable', 'integer', 'min:0'],
            'plus_minus' => ['nullable', 'integer'],
            'fgm' => ['required', 'integer', 'min:0'],
            'fga' => ['required', 'integer', 'min:0', 'gte:fgm'],
            'three_point_made' => ['required', 'integer', 'min:0'],
            'three_point_attempted' => ['required', 'integer', 'min:0', 'gte:three_point_made'],
            'two_point_made' => ['required', 'integer', 'min:0'],
            'two_point_attempted' => ['required', 'integer', 'min:0', 'gte:two_point_made'],
            'free_throw_made' => ['required', 'integer', 'min:0'],
            'free_throw_attempted' => ['required', 'integer', 'min:0', 'gte:free_throw_made'],
        ], [
            'id_match.required' => 'Pertandingan wajib dipilih.',
            'id_player.required' => 'Pemain wajib dipilih.',
            'id_player.unique' => 'Statistik untuk pemain ini pada pertandingan tersebut sudah ada! Silakan edit data yang sudah ada.',
            'fga.gte' => 'FGA (Attempt) harus lebih besar atau sama dengan FGM (Made).',
            'three_point_attempted.gte' => '3PT Attempted harus lebih besar atau sama dengan 3PT Made.',
            'two_point_attempted.gte' => '2PT Attempted harus lebih besar atau sama dengan 2PT Made.',
            'free_throw_attempted.gte' => 'FT Attempted harus lebih besar atau sama dengan FT Made.',
        ]);

        Statistic::create($validated);

        return redirect()->route('admin.statistics.index', ['match_id' => $validated['id_match']])
            ->with('success', 'Statistik pemain berhasil disimpan!');
    }

    public function edit($id)
    {
        $statistic = Statistic::with(['player.team', 'match.teamA', 'match.teamB'])->findOrFail($id);
        $matches = MatchModel::with(['teamA', 'teamB'])->get();
        $players = Player::with('team')->orderBy('nama', 'asc')->get();

        return view('admin.statistics.edit', compact('statistic', 'matches', 'players'));
    }

    public function update(Request $request, $id)
    {
        $statistic = Statistic::findOrFail($id);

        $validated = $request->validate([
            'id_match' => ['required', 'exists:tr_matches,id_match'],
            'id_player' => [
                'required',
                'exists:ms_players,id_player',
                Rule::unique('tr_statistics')->where(function ($query) use ($request) {
                    return $query->where('id_match', $request->id_match)
                                 ->where('id_player', $request->id_player);
                })->ignore($statistic->id_statistic, 'id_statistic'),
            ],
            'minutes' => ['required', 'string', 'max:10'],
            'poin' => ['required', 'integer', 'min:0'],
            'rebound' => ['required', 'integer', 'min:0'],
            'defensive_rebound' => ['nullable', 'integer', 'min:0'],
            'assist' => ['required', 'integer', 'min:0'],
            'steal' => ['required', 'integer', 'min:0'],
            'block' => ['required', 'integer', 'min:0'],
            'turnover' => ['required', 'integer', 'min:0'],
            'foul' => ['nullable', 'integer', 'min:0'],
            'plus_minus' => ['nullable', 'integer'],
            'fgm' => ['required', 'integer', 'min:0'],
            'fga' => ['required', 'integer', 'min:0', 'gte:fgm'],
            'three_point_made' => ['required', 'integer', 'min:0'],
            'three_point_attempted' => ['required', 'integer', 'min:0', 'gte:three_point_made'],
            'two_point_made' => ['required', 'integer', 'min:0'],
            'two_point_attempted' => ['required', 'integer', 'min:0', 'gte:two_point_made'],
            'free_throw_made' => ['required', 'integer', 'min:0'],
            'free_throw_attempted' => ['required', 'integer', 'min:0', 'gte:free_throw_made'],
        ], [
            'id_player.unique' => 'Statistik untuk pemain ini pada pertandingan tersebut sudah tercatat.',
            'fga.gte' => 'FGA (Attempt) harus lebih besar atau sama dengan FGM (Made).',
            'three_point_attempted.gte' => '3PT Attempted harus lebih besar atau sama dengan 3PT Made.',
            'two_point_attempted.gte' => '2PT Attempted harus lebih besar atau sama dengan 2PT Made.',
            'free_throw_attempted.gte' => 'FT Attempted harus lebih besar atau sama dengan FT Made.',
        ]);

        $statistic->update($validated);

        return redirect()->route('admin.statistics.index', ['match_id' => $validated['id_match']])
            ->with('success', 'Statistik pemain berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $statistic = Statistic::findOrFail($id);
        $matchId = $statistic->id_match;
        $statistic->delete();

        return redirect()->route('admin.statistics.index', ['match_id' => $matchId])
            ->with('success', 'Statistik pemain berhasil dihapus!');
    }
}
