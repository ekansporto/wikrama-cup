<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('match.teamA', 'match.teamB')
            ->orderBy('tanggal', 'desc')
            ->orderBy('id_gallery', 'desc')
            ->paginate(12);

        return view('public.galeri', compact('galleries'));
    }
}
