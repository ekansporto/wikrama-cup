@extends('layouts.admin')

@section('title', 'Edit Foto Galeri — WIKCUP Admin')
@section('header_title', 'Edit Data Galeri')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
    <div class="border-b border-slate-100 pb-4 mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900">Edit Foto Galeri</h2>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui caption, tanggal, atau ganti file foto</p>
        </div>
        <img src="{{ $gallery->foto_url }}" alt="" class="w-14 h-14 rounded-xl object-cover border border-slate-200">
    </div>

    <form action="{{ route('admin.galleries.update', $gallery->id_gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- File Foto (Opsional) -->
        <div>
            <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Ganti File Foto (Opsional)</label>
            <input type="file" name="foto" id="foto" accept="image/*"
                   class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition cursor-pointer">
            <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti file gambar</p>
            @error('foto')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Terkait Pertandingan (Opsional) -->
        <div>
            <label for="id_match" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Terkait Pertandingan (Opsional)</label>
            <select name="id_match" id="id_match"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                <option value="">-- Tidak Terkait Pertandingan Khusus --</option>
                @foreach($matches as $m)
                    <option value="{{ $m->id_match }}" {{ old('id_match', $gallery->id_match) == $m->id_match ? 'selected' : '' }}>
                        {{ $m->teamA->nama_tim }} vs {{ $m->teamB->nama_tim }} ({{ $m->formatted_date }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Pengambilan</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $gallery->tanggal ? $gallery->tanggal->format('Y-m-d') : date('Y-m-d')) }}" required
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
            @error('tanggal')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Caption / Keterangan -->
        <div>
            <label for="caption" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Keterangan / Caption Foto</label>
            <textarea name="caption" id="caption" rows="3"
                      class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">{{ old('caption', $gallery->caption) }}</textarea>
            @error('caption')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit & Cancel -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-orange-600 hover:bg-orange-500 shadow-md shadow-orange-600/30 transition">
                Perbarui Galeri
            </button>
        </div>
    </form>
</div>
@endsection
