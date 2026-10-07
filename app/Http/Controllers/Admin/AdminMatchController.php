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
        return redirect()->route('admin.statistics.index', ['match_id' => $id]);
    }

    public function updateStats(Request $request, $id)
    {
        return redirect()->route('admin.statistics.index', ['match_id' => $id]);
    }
}
