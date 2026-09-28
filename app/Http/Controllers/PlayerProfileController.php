<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlayerProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $player = Player::with(['team', 'statistics.match'])->where('id_user', $user->id_user)->first();
        $teams = Team::orderBy('nama_tim', 'asc')->get();

        return view('player.profil', compact('user', 'player', 'teams'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $player = Player::where('id_user', $user->id_user)->first();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'id_team' => ['required', 'exists:ms_teams,id_team'],
            'no_punggung' => ['required', 'integer', 'min:0', 'max:99'],
            'posisi' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', 'in:Boys,Girls'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:120', 'max:250'],
            'berat_badan' => ['nullable', 'numeric', 'min:30', 'max:180'],
            'kelas_program' => ['nullable', 'string', 'max:100'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'id_team.required' => 'Silakan pilih tim Anda.',
            'id_team.exists' => 'Tim yang dipilih tidak valid.',
            'no_punggung.required' => 'Nomor punggung wajib diisi.',
            'posisi.required' => 'Posisi bermain wajib dipilih.',
            'gender.required' => 'Divisi/Gender wajib dipilih.',
            'gender.in' => 'Divisi yang dipilih harus Boys atau Girls.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Handle foto upload if present
        $fotoPath = $player ? $player->foto : null;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('players', 'public');
        }

        if ($player) {
            $player->update([
                'id_team' => $validated['id_team'],
                'nama' => $validated['nama'],
                'no_punggung' => $validated['no_punggung'],
                'posisi' => $validated['posisi'],
                'gender' => $validated['gender'],
                'tinggi_badan' => $validated['tinggi_badan'],
                'berat_badan' => $validated['berat_badan'],
                'kelas_program' => $validated['kelas_program'],
                'foto' => $fotoPath,
            ]);
        } else {
            $player = Player::create([
                'id_user' => $user->id_user,
                'id_team' => $validated['id_team'],
                'nama' => $validated['nama'],
                'no_punggung' => $validated['no_punggung'],
                'posisi' => $validated['posisi'],
                'gender' => $validated['gender'],
                'tinggi_badan' => $validated['tinggi_badan'],
                'berat_badan' => $validated['berat_badan'],
                'kelas_program' => $validated['kelas_program'],
                'foto' => $fotoPath,
                'is_captain' => false,
            ]);
        }

        // Also update name on user record if changed
        if ($user->name !== $validated['nama']) {
            $user->update(['name' => $validated['nama']]);
        }

        return redirect()->route('player.profile')->with('success', 'Profil pemain Anda berhasil diperbarui!');
    }
}
