<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;

class TeamPlayerController extends Controller
{
    public function index()
    {
        $teams = Team::withCount('players')
            ->orderBy('nama_tim', 'asc')
            ->get();

        return view('public.tim', compact('teams'));
    }

    public function showTeam($id)
    {
        $team = Team::with(['players' => function ($q) {
            $q->orderBy('is_captain', 'desc')->orderBy('no_punggung', 'asc');
        }])->findOrFail($id);

        return view('public.detail-tim', compact('team'));
    }

    public function showPlayer($id)
    {
        $player = Player::with(['team', 'statistics.match.teamA', 'statistics.match.teamB'])
            ->findOrFail($id);

        // Sort match stats by match date
        $statistics = $player->statistics->sortByDesc(function ($stat) {
            return $stat->match ? $stat->match->tanggal->timestamp : 0;
        });

        return view('public.pemain', compact('player', 'statistics'));
    }
}
