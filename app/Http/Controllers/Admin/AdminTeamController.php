<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $teams = Team::withCount('players')->orderBy('nama_tim', 'asc')->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tim' => ['required', 'string', 'max:100', 'unique:ms_teams,nama_tim'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
        ], [
            'nama_tim.required' => 'Nama tim wajib diisi.',
            'nama_tim.unique' => 'Nama tim ini sudah ada.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('teams', 'public');
        }

        Team::create([
            'nama_tim' => $validated['nama_tim'],
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.teams.index')->with('success', 'Tim berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $validated = $request->validate([
            'nama_tim' => ['required', 'string', 'max:100', 'unique:ms_teams,nama_tim,' . $team->id_team . ',id_team'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
        ], [
            'nama_tim.required' => 'Nama tim wajib diisi.',
            'nama_tim.unique' => 'Nama tim ini sudah ada.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
        ]);

        $logoPath = $team->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('teams', 'public');
        }

        $team->update([
            'nama_tim' => $validated['nama_tim'],
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.teams.index')->with('success', 'Data tim berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        if ($team->logo && Storage::disk('public')->exists($team->logo)) {
            Storage::disk('public')->delete($team->logo);
        }
        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Tim berhasil dihapus!');
    }
}
