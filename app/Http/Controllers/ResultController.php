<?php

namespace App\Http\Controllers;

use App\Models\MatchModel;

class ResultController extends Controller
{
    public function index()
    {
        $results = MatchModel::with(['teamA', 'teamB'])
            ->whereNotNull('skor_tim_a')
            ->whereNotNull('skor_tim_b')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->paginate(10);

        return view('public.hasil', compact('results'));
    }

    public function show($id)
    {
        $match = MatchModel::with(['teamA.players', 'teamB.players', 'statistics.player.team', 'galleries'])
            ->findOrFail($id);

        // Group statistics by team
        $teamAStats = $match->statistics->filter(function ($stat) use ($match) {
            return $stat->player && $stat->player->id_team == $match->team_a_id;
        });

        $teamBStats = $match->statistics->filter(function ($stat) use ($match) {
            return $stat->player && $stat->player->id_team == $match->team_b_id;
        });

        return view('public.detail-hasil', compact('match', 'teamAStats', 'teamBStats'));
    }
}
