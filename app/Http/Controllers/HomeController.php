<?php

namespace App\Http\Controllers;

use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $teamCount = \App\Models\Team::count();

        // 1. Pertandingan Terdekat (1–2 pertandingan yang belum selesai, urut tanggal terdekat)
        $upcomingMatches = MatchModel::with(['teamA', 'teamB'])
            ->whereNull('skor_tim_a')
            ->whereNull('skor_tim_b')
            ->where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->take(2)
            ->get();

        if ($upcomingMatches->isEmpty()) {
            $upcomingMatches = MatchModel::with(['teamA', 'teamB'])
                ->whereNull('skor_tim_a')
                ->orderBy('tanggal', 'asc')
                ->take(2)
                ->get();
            if ($upcomingMatches->isEmpty()) {
                $upcomingMatches = MatchModel::with(['teamA', 'teamB'])
                    ->orderBy('tanggal', 'desc')
                    ->take(2)
                    ->get();
            }
        }

        // 2. Hasil Pertandingan Terbaru (2 pertandingan yang sudah selesai)
        $recentResults = MatchModel::with(['teamA', 'teamB'])
            ->whereNotNull('skor_tim_a')
            ->whereNotNull('skor_tim_b')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->take(2)
            ->get();

        if ($recentResults->isEmpty()) {
            $recentResults = MatchModel::with(['teamA', 'teamB'])
                ->orderBy('tanggal', 'desc')
                ->take(2)
                ->get();
        }

        // 3. Statistik Teratas (Top Scorer, Top Assist, Top Rebound)
        // Top Scorer
        $topScorerStat = Statistic::select('id_player', DB::raw('SUM(poin) as total_stat'), DB::raw('COUNT(id_match) as gp'))
            ->groupBy('id_player')
            ->orderByDesc('total_stat')
            ->with('player.team')
            ->first();

        // Top Assist
        $topAssistStat = Statistic::select('id_player', DB::raw('SUM(assist) as total_stat'), DB::raw('COUNT(id_match) as gp'))
            ->groupBy('id_player')
            ->orderByDesc('total_stat')
            ->with('player.team')
            ->first();

        // Top Rebound
        $topReboundStat = Statistic::select('id_player', DB::raw('SUM(rebound) as total_stat'), DB::raw('COUNT(id_match) as gp'))
            ->groupBy('id_player')
            ->orderByDesc('total_stat')
            ->with('player.team')
            ->first();

        return view('public.home', compact(
            'upcomingMatches',
            'recentResults',
            'topScorerStat',
            'topAssistStat',
            'topReboundStat',
            'teamCount'
        ));
    }
}
