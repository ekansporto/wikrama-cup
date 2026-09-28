<?php

namespace App\Http\Controllers;

use App\Models\MatchModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $today = Carbon::today();

        $query = MatchModel::with(['teamA', 'teamB'])
            ->whereNull('skor_tim_a')
            ->whereNull('skor_tim_b');

        if ($filter === 'hari_ini') {
            $query->whereDate('tanggal', $today);
        } elseif ($filter === 'mendatang') {
            $query->whereDate('tanggal', '>', $today);
        }
        // Jika filter 'semua', tampilkan seluruh pertandingan yang belum selesai (skor null)

        $matches = $query->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->paginate(12)
            ->withQueryString();

        return view('public.jadwal', compact('matches', 'filter'));
    }
}
