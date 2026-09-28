@extends('layouts.admin')

@section('title', 'Admin Dashboard — WIKCUP')
@section('header_title', 'Ringkasan Turnamen')

@section('content')
<div class="space-y-8">
    <!-- METRICS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Tim -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex items-center justify-between admin-stat-card accent-orange">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Tim</div>
                <div class="text-3xl font-black text-slate-900 mt-1">{{ $totalTeams }}</div>
                <a href="{{ route('admin.teams.index') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 mt-2 inline-block">Kelola Tim →</a>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-2xl font-bold">
                🛡️
            </div>
        </div>

        <!-- Total Pemain -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex items-center justify-between admin-stat-card accent-amber">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Pemain</div>
                <div class="text-3xl font-black text-slate-900 mt-1">{{ $totalPlayers }}</div>
                <span class="text-xs text-slate-400 mt-2 inline-block">Terdaftar di Turnamen</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold">
                🏃
            </div>
        </div>

        <!-- Total Pertandingan -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex items-center justify-between admin-stat-card accent-emerald">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Pertandingan</div>
                <div class="text-3xl font-black text-slate-900 mt-1">{{ $totalMatches }}</div>
                <a href="{{ route('admin.matches.index') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 mt-2 inline-block">Kelola Jadwal →</a>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold">
                🏀
            </div>
        </div>

        <!-- Total Foto Galeri -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex items-center justify-between admin-stat-card accent-cyan">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Foto Galeri</div>
                <div class="text-3xl font-black text-slate-900 mt-1">{{ $totalGalleries }}</div>
                <a href="{{ route('admin.galleries.index') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 mt-2 inline-block">Kelola Galeri →</a>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl font-bold">
                📸
            </div>
        </div>
    </div>

    <!-- RECENT MATCHES TABLE -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900">Pertandingan Terbaru</h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar pertandingan terkini yang telah dicatat panitia</p>
            </div>
            <a href="{{ route('admin.matches.create') }}" class="px-4 py-2 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition">
                + Tambah Pertandingan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-xs tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3.5">Tanggal & Waktu</th>
                        <th class="px-6 py-3.5">Tim A</th>
                        <th class="px-6 py-3.5 text-center">Skor</th>
                        <th class="px-6 py-3.5">Tim B</th>
                        <th class="px-6 py-3.5">Lokasi</th>
                        <th class="px-6 py-3.5 text-center">Status</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                    @forelse($recentMatches as $m)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $m->formatted_date }} <br>
                                <span class="font-bold text-slate-700">{{ $m->formatted_time }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $m->teamA->nama_tim }}
                            </td>
                            <td class="px-6 py-4 text-center font-extrabold text-base">
                                @if($m->is_finished)
                                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-900">{{ $m->skor_tim_a }} - {{ $m->skor_tim_b }}</span>
                                @else
                                    <span class="text-slate-400 font-normal text-xs">Belum Dimainkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $m->teamB->nama_tim }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600">
                                {{ $m->lokasi }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($m->is_finished)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                                @elseif($m->is_today)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">Hari Ini</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">Mendatang</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.matches.edit', $m->id_match) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">Edit / Skor</a>
                                <a href="{{ route('admin.statistics.create', ['match_id' => $m->id_match]) }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">+ Stats</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-400">Belum ada data pertandingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
