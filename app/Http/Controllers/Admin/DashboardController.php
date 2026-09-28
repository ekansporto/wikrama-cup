<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTeams = Team::count();
        $totalPlayers = Player::count();
        $totalMatches = MatchModel::count();
        $totalGalleries = Gallery::count();

        $recentMatches = MatchModel::with(['teamA', 'teamB'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTeams',
            'totalPlayers',
            'totalMatches',
            'totalGalleries',
            'recentMatches'
        ));
    }
}
