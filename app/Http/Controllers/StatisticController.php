<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Statistic;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        // Available statistic categories
        $categories = [
            'points' => ['label' => 'Points', 'column' => 'poin', 'unit' => 'PTS', 'per_game' => 'PPG', 'title' => 'Top Scorer'],
            'rebounds' => ['label' => 'Rebound', 'column' => 'rebound', 'unit' => 'REB', 'per_game' => 'RPG', 'title' => 'Top Rebound'],
            'assists' => ['label' => 'Assist', 'column' => 'assist', 'unit' => 'AST', 'per_game' => 'APG', 'title' => 'Top Assist'],
            'steals' => ['label' => 'Steal', 'column' => 'steal', 'unit' => 'STL', 'per_game' => 'SPG', 'title' => 'Top Steal'],
            'blocks' => ['label' => 'Block', 'column' => 'block', 'unit' => 'BLK', 'per_game' => 'BPG', 'title' => 'Top Block'],
            'three_point' => ['label' => '3 Point', 'column' => 'three_point_made', 'unit' => '3FGM', 'per_game' => '3PG', 'title' => 'Top 3-Point Shooter'],
            'free_throw' => ['label' => 'Free Throw', 'column' => 'free_throw_made', 'unit' => 'FTM', 'per_game' => 'FTPG', 'title' => 'Top Free Throw'],
        ];

        // Check if user has triggered a filter search (State 2)
        $isFiltered = $request->has('filter');

        // Filter Inputs
        $gender = $request->query('gender', 'Boys');
        $top = (int) $request->query('top', 5);
        $category = $request->query('category', 'points');
        $school = trim($request->query('school', ''));

        // Validate top limit
        if (!in_array($top, [5, 10, 20])) {
            $top = 5;
        }

        // Validate category
        if (!array_key_exists($category, $categories)) {
            $category = 'points';
        }

        $currentCat = $categories[$category];

        $statistics = null;
        $rankings = null;

        if (!$isFiltered) {
            // =========================================================================
            // STATE 1 — DEFAULT: Riwayat Statistik Pertandingan
            // Menampilkan seluruh data statistik pertandingan lengkap
            // =========================================================================
            $statistics = Statistic::with(['match.teamA', 'match.teamB', 'player.team'])
                ->latest('id_statistic')
                ->paginate(15)
                ->withQueryString();
        } else {
            // =========================================================================
            // STATE 2 — SETELAH FILTER: Filter Ranking Pemain
            // Menampilkan ranking pemain berdasarkan Divisi, Top Limit, Kategori, Sekolah
            // =========================================================================
            $col = $currentCat['column'];

            $query = Statistic::query()
                ->join('ms_players', 'tr_statistics.id_player', '=', 'ms_players.id_player')
                ->join('ms_teams', 'ms_players.id_team', '=', 'ms_teams.id_team');

            if ($gender && in_array($gender, ['Boys', 'Girls'])) {
                $query->where('ms_players.gender', $gender);
            }

            if (!empty($school)) {
                $query->where(function ($q) use ($school) {
                    $q->where('ms_teams.nama_tim', 'LIKE', "%{$school}%")
                      ->orWhere('ms_players.nama', 'LIKE', "%{$school}%")
                      ->orWhere('ms_players.kelas_program', 'LIKE', "%{$school}%");
                });
            }

            $rankings = $query->select(
                    'tr_statistics.id_player',
                    DB::raw("SUM(tr_statistics.$col) as total_val"),
                    DB::raw("COUNT(tr_statistics.id_match) as gp"),
                    DB::raw("ROUND(SUM(tr_statistics.$col) / COUNT(tr_statistics.id_match), 1) as avg_val"),
                    DB::raw("SUM(tr_statistics.poin) as sum_poin"),
                    DB::raw("SUM(tr_statistics.rebound) as sum_rebound"),
                    DB::raw("SUM(tr_statistics.assist) as sum_assist"),
                    DB::raw("SUM(tr_statistics.steal) as sum_steal"),
                    DB::raw("SUM(tr_statistics.block) as sum_block"),
                    DB::raw("SUM(tr_statistics.three_point_made) as sum_3pm"),
                    DB::raw("SUM(tr_statistics.three_point_attempted) as sum_3pa"),
                    DB::raw("SUM(tr_statistics.two_point_made) as sum_2pm"),
                    DB::raw("SUM(tr_statistics.two_point_attempted) as sum_2pa"),
                    DB::raw("SUM(tr_statistics.free_throw_made) as sum_ftm"),
                    DB::raw("SUM(tr_statistics.free_throw_attempted) as sum_fta"),
                    DB::raw("SUM(tr_statistics.fgm) as sum_fgm"),
                    DB::raw("SUM(tr_statistics.fga) as sum_fga"),
                    DB::raw("SUM(tr_statistics.turnover) as sum_to")
                )
                ->groupBy('tr_statistics.id_player')
                ->orderByDesc('total_val')
                ->orderByDesc('avg_val')
                ->with(['player.team'])
                ->take($top)
                ->get();
        }

        return view('public.statistik', compact(
            'isFiltered',
            'statistics',
            'rankings',
            'gender',
            'top',
            'category',
            'school',
            'categories',
            'currentCat'
        ));
    }
}
