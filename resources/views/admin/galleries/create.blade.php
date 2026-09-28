@extends('layouts.admin')

@section('title', 'Upload Foto Galeri — WIKCUP Admin')
@section('header_title', 'Upload Foto Galeri')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h2 class="text-xl font-extrabold text-slate-900">Upload Foto Dokumentasi</h2>
        <p class="text-xs text-slate-500 mt-0.5">Unggah foto aksi pertandingan atau suasana turnamen</p>
    </div>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- File Foto -->
        <div>
            <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">File Foto</label>
            <input type="file" name="foto" id="foto" required accept="image/*"
                   class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition cursor-pointer">
            <p class="text-[10px] text-slate-400 mt-1">Maksimal 5MB (JPG, PNG, WebP)</p>
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
                    <option value="{{ $m->id_match }}" {{ old('id_match') == $m->id_match ? 'selected' : '' }}>
                        {{ $m->teamA->nama_tim }} vs {{ $m->teamB->nama_tim }} ({{ $m->formatted_date }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Pengambilan</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
            @error('tanggal')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Caption / Keterangan -->
        <div>
            <label for="caption" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Keterangan / Caption Foto</label>
            <textarea name="caption" id="caption" rows="3"
                      class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                      placeholder="Tuliskan momen menarik dalam foto ini...">{{ old('caption') }}</textarea>
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
                Upload Foto
            </button>
        </div>
    </form>
</div>
@endsection
