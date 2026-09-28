@extends('layouts.admin')

@section('title', 'Tambah Tim Baru — WIKCUP Admin')
@section('header_title', 'Tambah Tim Baru')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h2 class="text-xl font-extrabold text-slate-900">Form Tambah Tim Resmi</h2>
        <p class="text-xs text-slate-500 mt-0.5">Buat tim turnamen yang nantinya dapat dipilih oleh para pemain</p>
    </div>

    <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Nama Tim -->
        <div>
            <label for="nama_tim" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Tim</label>
            <input type="text" name="nama_tim" id="nama_tim" value="{{ old('nama_tim') }}" required autofocus
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                   placeholder="Contoh: Wikrama Thunder">
            @error('nama_tim')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Logo Tim -->
        <div>
            <label for="logo" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Logo Tim (Opsional)</label>
            <input type="file" name="logo" id="logo" accept="image/*"
                   class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition cursor-pointer">
            <p class="text-[10px] text-slate-400 mt-1">Maksimal 2MB (PNG, JPG, SVG, WebP)</p>
            @error('logo')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit & Cancel -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.teams.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-orange-600 hover:bg-orange-500 shadow-md shadow-orange-600/30 transition">
                Simpan Tim
            </button>
        </div>
    </form>
</div>
@endsection
