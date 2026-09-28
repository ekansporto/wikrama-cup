@extends('layouts.admin')

@section('title', 'Edit Pertandingan & Skor — WIKCUP Admin')
@section('header_title', 'Edit Jadwal / Hasil Pertandingan')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h2 class="text-xl font-extrabold text-slate-900">Edit Pertandingan</h2>
        <p class="text-xs text-slate-500 mt-0.5">Perbarui tanggal, waktu, lokasi, atau masukkan skor akhir hasil pertandingan</p>
    </div>

    <form action="{{ route('admin.matches.update', $match->id_match) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Tim A -->
            <div>
                <label for="team_a_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tim A (Tuan Rumah / Tim 1)</label>
                <select name="team_a_id" id="team_a_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                    @foreach($teams as $t)
                        <option value="{{ $t->id_team }}" {{ old('team_a_id', $match->team_a_id) == $t->id_team ? 'selected' : '' }}>
                            {{ $t->nama_tim }}
                        </option>
                    @endforeach
                </select>
                @error('team_a_id')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tim B -->
            <div>
                <label for="team_b_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tim B (Tamu / Tim 2)</label>
                <select name="team_b_id" id="team_b_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                    @foreach($teams as $t)
                        <option value="{{ $t->id_team }}" {{ old('team_b_id', $match->team_b_id) == $t->id_team ? 'selected' : '' }}>
                            {{ $t->nama_tim }}
                        </option>
                    @endforeach
                </select>
                @error('team_b_id')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Pertandingan</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $match->tanggal->format('Y-m-d')) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
                @error('tanggal')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jam -->
            <div>
                <label for="jam" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Jam Pertandingan</label>
                <input type="time" name="jam" id="jam" value="{{ old('jam', substr($match->jam, 0, 5)) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
                @error('jam')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="sm:col-span-2">
                <label for="lokasi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Lokasi / Arena</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $match->lokasi) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
                @error('lokasi')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Score Input Section -->
        <div class="pt-4 border-t border-slate-100 bg-slate-50 p-4 rounded-2xl">
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-800 mb-3">Input / Update Skor Hasil Pertandingan</h3>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label for="skor_tim_a" class="block text-xs font-bold text-slate-700 mb-1">Skor Tim A ({{ $match->teamA->nama_tim }})</label>
                    <input type="number" name="skor_tim_a" id="skor_tim_a" min="0" value="{{ old('skor_tim_a', $match->skor_tim_a) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-base font-bold outline-none"
                           placeholder="Contoh: 72">
                </div>
                <div>
                    <label for="skor_tim_b" class="block text-xs font-bold text-slate-700 mb-1">Skor Tim B ({{ $match->teamB->nama_tim }})</label>
                    <input type="number" name="skor_tim_b" id="skor_tim_b" min="0" value="{{ old('skor_tim_b', $match->skor_tim_b) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-base font-bold outline-none"
                           placeholder="Contoh: 65">
                </div>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">Mengisi kedua skor di atas akan otomatis menandai pertandingan sebagai selesai (Final Score).</p>
        </div>

        <!-- Submit & Cancel -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.matches.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-orange-600 hover:bg-orange-500 shadow-md shadow-orange-600/30 transition">
                Perbarui Pertandingan
            </button>
        </div>
    </form>
</div>
@endsection
