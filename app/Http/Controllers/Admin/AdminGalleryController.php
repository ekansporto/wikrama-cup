<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\MatchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('match.teamA', 'match.teamB')
            ->orderBy('tanggal', 'desc')
            ->orderBy('id_gallery', 'desc')
            ->paginate(12);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $matches = MatchModel::with(['teamA', 'teamB'])->orderBy('tanggal', 'desc')->get();
        return view('admin.galleries.create', compact('matches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'id_match' => ['nullable', 'exists:tr_matches,id_match'],
            'caption' => ['nullable', 'string', 'max:500'],
            'tanggal' => ['required', 'date'],
        ], [
            'foto.required' => 'Foto dokumentasi wajib diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
            'tanggal.required' => 'Tanggal dokumentasi wajib diisi.',
        ]);

        $fotoPath = $request->file('foto')->store('galleries', 'public');

        Gallery::create([
            'id_match' => $validated['id_match'] ?? null,
            'foto' => $fotoPath,
            'caption' => $validated['caption'] ?? null,
            'tanggal' => $validated['tanggal'],
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $matches = MatchModel::with(['teamA', 'teamB'])->orderBy('tanggal', 'desc')->get();

        return view('admin.galleries.edit', compact('gallery', 'matches'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'id_match' => ['nullable', 'exists:tr_matches,id_match'],
            'caption' => ['nullable', 'string', 'max:500'],
            'tanggal' => ['required', 'date'],
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
            'tanggal.required' => 'Tanggal dokumentasi wajib diisi.',
        ]);

        $fotoPath = $gallery->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('galleries', 'public');
        }

        $gallery->update([
            'id_match' => $validated['id_match'] ?? null,
            'foto' => $fotoPath,
            'caption' => $validated['caption'] ?? null,
            'tanggal' => $validated['tanggal'],
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->foto && Storage::disk('public')->exists($gallery->foto)) {
            Storage::disk('public')->delete($gallery->foto);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
