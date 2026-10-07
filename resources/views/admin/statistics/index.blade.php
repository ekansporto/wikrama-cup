@extends('layouts.admin')

@section('title', 'Kelola Box Score & Statistik Total — WIKCUP Admin')
@section('header_title', 'Kelola Box Score & Statistik Total')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar & Match Selector -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs font-bold uppercase tracking-wider mb-2">
                <span>🏀</span> Box Score & Input Statistik Total
            </div>
            <h2 class="text-xl font-black text-slate-900">Statistik Pertandingan (Box Score)</h2>
            <p class="text-xs text-slate-500 mt-0.5">Pilih pertandingan untuk mengisi atau mengubah statistik lengkap setiap pemain dari kedua tim.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Match Selector Form -->
            <form action="{{ route('admin.statistics.index') }}" method="GET" class="flex items-center gap-2">
                <label for="match_select" class="text-xs font-bold text-slate-600 uppercase tracking-wider hidden sm:inline">Pilih Laga:</label>
                <select name="match_id" id="match_select" onchange="this.form.submit()" 
                        class="px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-bold text-slate-800 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-orange-500 outline-none shadow-sm">
                    @forelse($matches as $m)
                        <option value="{{ $m->id_match }}" {{ $matchId == $m->id_match ? 'selected' : '' }}>
                            {{ $m->teamA->nama_tim }} ({{ $m->skor_tim_a ?? 0 }}) vs ({{ $m->skor_tim_b ?? 0 }}) {{ $m->teamB->nama_tim }} — {{ $m->formatted_date }}
                        </option>
                    @empty
                        <option value="">-- Belum Ada Jadwal Pertandingan --</option>
                    @endforelse
                </select>
            </form>

            <!-- Add Player Button (Opens Modal) -->
            <button type="button" onclick="openAddPlayerModal()" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Pemain
            </button>

            <!-- Add Team Button (Opens Modal) -->
            <button type="button" onclick="openAddTeamModal()" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Tambah Sekolah/Tim
            </button>
        </div>
    </div>

    @if(!$selectedMatch)
        <div class="bg-white rounded-3xl p-12 border border-slate-200 text-center shadow-sm">
            <div class="w-16 h-16 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                🏀
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak ada pertandingan yang dipilih</h3>
            <p class="text-slate-500 text-sm mt-1 mb-6">Silakan buat jadwal pertandingan terlebih dahulu di menu Jadwal & Skor.</p>
            <a href="{{ route('admin.matches.create') }}" class="px-5 py-2.5 bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs rounded-xl shadow-sm transition">
                + Tambah Jadwal Pertandingan
            </a>
        </div>
    @else

        <!-- Selected Match Overview Banner -->
        <div class="bg-slate-900 text-white rounded-3xl p-6 border border-slate-800 shadow-md">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Tim A -->
                <div class="flex items-center gap-4 text-right flex-1 justify-end">
                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-white">{{ $selectedMatch->teamA->nama_tim }}</h3>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Tim A (Home)</p>
                    </div>
                    <img src="{{ $selectedMatch->teamA->logo_url }}" alt="" class="w-12 h-12 rounded-2xl object-contain bg-white/10 p-1.5 border border-white/20">
                </div>

                <!-- Match VS & Score Badge -->
                <div class="text-center px-6 py-2 bg-slate-800/80 rounded-2xl border border-slate-700/60 shrink-0">
                    <div class="text-xs font-bold text-orange-400 uppercase tracking-widest mb-1">
                        {{ $selectedMatch->formatted_date }} • {{ $selectedMatch->formatted_time }}
                    </div>
                    <div class="flex items-center justify-center gap-3 text-2xl sm:text-3xl font-black">
                        <span id="header_score_a" class="text-orange-400">{{ $selectedMatch->skor_tim_a ?? 0 }}</span>
                        <span class="text-slate-500 text-xl">-</span>
                        <span id="header_score_b" class="text-orange-400">{{ $selectedMatch->skor_tim_b ?? 0 }}</span>
                    </div>
                    <div class="text-[11px] text-slate-400 mt-1">
                        📍 {{ $selectedMatch->lokasi }}
                    </div>
                </div>

                <!-- Tim B -->
                <div class="flex items-center gap-4 text-left flex-1 justify-start">
                    <img src="{{ $selectedMatch->teamB->logo_url }}" alt="" class="w-12 h-12 rounded-2xl object-contain bg-white/10 p-1.5 border border-white/20">
                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-white">{{ $selectedMatch->teamB->nama_tim }}</h3>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Tim B (Away)</p>
                    </div>
                </div>

            </div>

            <div class="mt-4 pt-4 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-2">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Skor pertandingan pada tabel jadwal dan seluruh halaman web publik otomatis disinkronkan dari kalkulasi total poin di bawah.</span>
                </div>
                <form action="{{ route('admin.statistics.match.clear', $selectedMatch->id_match) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset seluruh statistik dan skor pertandingan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-rose-400 hover:text-rose-300 font-bold underline transition">
                        Reset Semua Box Score Laga Ini
                    </button>
                </form>
            </div>
        </div>

        <!-- Box Score Batch Edit Form -->
        <form action="{{ route('admin.statistics.batch.update', $selectedMatch->id_match) }}" method="POST" id="boxScoreForm">
            @csrf
            @method('PUT')

            <!-- ========================================== -->
            <!-- 1. TIM A BOX SCORE TABLE -->
            <!-- ========================================== -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8">
                <div class="p-5 bg-gradient-to-r from-orange-50/70 to-white border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ $selectedMatch->teamA->logo_url }}" class="w-10 h-10 object-contain rounded-xl bg-white p-1 border border-slate-200 shadow-sm">
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">
                                Box Score Tim A: {{ $selectedMatch->teamA->nama_tim }}
                            </h3>
                            <p class="text-xs text-slate-500">Daftar statistik seluruh pemain tim ini</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="px-3 py-1.5 rounded-xl bg-orange-100/80 text-orange-800 font-extrabold text-xs">
                            Total Poin Tim A: <span id="team_a_total_pts" class="text-sm font-black text-orange-600 ml-1">0</span> PTS
                        </div>
                        <button type="button" onclick="openAddPlayerModal({{ $selectedMatch->teamA->id_team }}, '{{ addslashes($selectedMatch->teamA->nama_tim) }}')" 
                                class="px-3 py-1.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition shadow-sm">
                            + Tambah Pemain ke Tim A
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="text-slate-600 bg-slate-50 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3 sticky left-0 bg-slate-50 z-10 shadow-[1px_0_0_0_#e2e8f0]">Pemain</th>
                                <th class="px-2 py-3 text-center">MIN</th>
                                <th class="px-2 py-3 text-center text-orange-600 bg-orange-50/50">PTS</th>
                                <th class="px-2 py-3 text-center">REB</th>
                                <th class="px-2 py-3 text-center">AST</th>
                                <th class="px-2 py-3 text-center">STL</th>
                                <th class="px-2 py-3 text-center">BLK</th>
                                <th class="px-2 py-3 text-center bg-blue-50/40 text-blue-700">3PM</th>
                                <th class="px-2 py-3 text-center bg-blue-50/40 text-blue-700">3PA</th>
                                <th class="px-2 py-3 text-center bg-emerald-50/40 text-emerald-700">2PM</th>
                                <th class="px-2 py-3 text-center bg-emerald-50/40 text-emerald-700">2PA</th>
                                <th class="px-2 py-3 text-center bg-amber-50/40 text-amber-700">FTM</th>
                                <th class="px-2 py-3 text-center bg-amber-50/40 text-amber-700">FTA</th>
                                <th class="px-2 py-3 text-center text-rose-600">TO</th>
                                <th class="px-2 py-3 text-center text-rose-600">FOUL</th>
                                <th class="px-2 py-3 text-center">+/-</th>
                                <th class="px-3 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                            @forelse($selectedMatch->teamA->players as $player)
                                @php $s = $statsMap->get($player->id_player); @endphp
                                <tr class="hover:bg-slate-50/80 transition stat-row team-a-row">
                                    <!-- Player Info Sticky -->
                                    <td class="px-4 py-2.5 sticky left-0 bg-white z-10 shadow-[1px_0_0_0_#e2e8f0] whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-slate-100 text-slate-800 flex items-center justify-center font-bold text-[11px] shrink-0">
                                                #{{ $player->no_punggung }}
                                            </span>
                                            <div>
                                                <span class="font-bold text-slate-900 block text-xs">{{ $player->nama }}</span>
                                                <span class="text-[10px] text-slate-400 font-normal">{{ $player->posisi }} • {{ $player->gender }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- MIN -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="text" name="stats[{{ $player->id_player }}][minutes]" value="{{ $s->minutes ?? '20:00' }}" 
                                               class="w-14 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-semibold focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- PTS -->
                                    <td class="px-1.5 py-2 text-center bg-orange-50/30">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][poin]" value="{{ $s->poin ?? 0 }}" 
                                               class="w-14 text-center py-1 px-1 rounded-lg border border-orange-300 bg-white text-xs font-black text-orange-600 focus:ring-2 focus:ring-orange-500 outline-none stat-input-pts stat-input-a">
                                    </td>

                                    <!-- REB -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][rebound]" value="{{ $s->rebound ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-bold text-slate-800 focus:ring-1 focus:ring-orange-500 outline-none stat-input-reb-a">
                                    </td>

                                    <!-- AST -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][assist]" value="{{ $s->assist ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-bold text-slate-800 focus:ring-1 focus:ring-orange-500 outline-none stat-input-ast-a">
                                    </td>

                                    <!-- STL -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][steal]" value="{{ $s->steal ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- BLK -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][block]" value="{{ $s->block ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- 3PM -->
                                    <td class="px-1.5 py-2 text-center bg-blue-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_made]" value="{{ $s->three_point_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-blue-300 bg-blue-50/50 text-xs font-bold text-blue-700 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </td>

                                    <!-- 3PA -->
                                    <td class="px-1.5 py-2 text-center bg-blue-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_attempted]" value="{{ $s->three_point_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </td>

                                    <!-- 2PM -->
                                    <td class="px-1.5 py-2 text-center bg-emerald-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][two_point_made]" value="{{ $s->two_point_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-emerald-300 bg-emerald-50/50 text-xs font-bold text-emerald-700 focus:ring-1 focus:ring-emerald-500 outline-none">
                                    </td>

                                    <!-- 2PA -->
                                    <td class="px-1.5 py-2 text-center bg-emerald-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][two_point_attempted]" value="{{ $s->two_point_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-emerald-500 outline-none">
                                    </td>

                                    <!-- FTM -->
                                    <td class="px-1.5 py-2 text-center bg-amber-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_made]" value="{{ $s->free_throw_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-amber-300 bg-amber-50/50 text-xs font-bold text-amber-700 focus:ring-1 focus:ring-amber-500 outline-none">
                                    </td>

                                    <!-- FTA -->
                                    <td class="px-1.5 py-2 text-center bg-amber-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_attempted]" value="{{ $s->free_throw_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-amber-500 outline-none">
                                    </td>

                                    <!-- TO -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][turnover]" value="{{ $s->turnover ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-rose-600 focus:ring-1 focus:ring-rose-500 outline-none">
                                    </td>

                                    <!-- FOUL -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][foul]" value="{{ $s->foul ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-rose-600 focus:ring-1 focus:ring-rose-500 outline-none">
                                    </td>

                                    <!-- +/- -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" name="stats[{{ $player->id_player }}][plus_minus]" value="{{ $s->plus_minus ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-600 focus:ring-1 focus:ring-slate-500 outline-none">
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-3 py-2 text-right whitespace-nowrap">
                                        @if($s)
                                            <button type="button" onclick="deleteStatRow({{ $s->id_statistic }})" class="text-rose-500 hover:text-rose-700 text-[10px] font-bold">
                                                Hapus Stat
                                            </button>
                                        @else
                                            <span class="text-slate-300 text-[10px]">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="px-6 py-6 text-center text-slate-400">
                                        Belum ada pemain di tim ini. Klik tombol <button type="button" onclick="openAddPlayerModal({{ $selectedMatch->teamA->id_team }}, '{{ addslashes($selectedMatch->teamA->nama_tim) }}')" class="text-orange-600 font-bold underline">+ Tambah Pemain</button> untuk menambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- ========================================== -->
            <!-- 2. TIM B BOX SCORE TABLE -->
            <!-- ========================================== -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8">
                <div class="p-5 bg-gradient-to-r from-blue-50/70 to-white border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ $selectedMatch->teamB->logo_url }}" class="w-10 h-10 object-contain rounded-xl bg-white p-1 border border-slate-200 shadow-sm">
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">
                                Box Score Tim B: {{ $selectedMatch->teamB->nama_tim }}
                            </h3>
                            <p class="text-xs text-slate-500">Daftar statistik seluruh pemain tim ini</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="px-3 py-1.5 rounded-xl bg-blue-100/80 text-blue-900 font-extrabold text-xs">
                            Total Poin Tim B: <span id="team_b_total_pts" class="text-sm font-black text-blue-700 ml-1">0</span> PTS
                        </div>
                        <button type="button" onclick="openAddPlayerModal({{ $selectedMatch->teamB->id_team }}, '{{ addslashes($selectedMatch->teamB->nama_tim) }}')" 
                                class="px-3 py-1.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition shadow-sm">
                            + Tambah Pemain ke Tim B
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="text-slate-600 bg-slate-50 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3 sticky left-0 bg-slate-50 z-10 shadow-[1px_0_0_0_#e2e8f0]">Pemain</th>
                                <th class="px-2 py-3 text-center">MIN</th>
                                <th class="px-2 py-3 text-center text-orange-600 bg-orange-50/50">PTS</th>
                                <th class="px-2 py-3 text-center">REB</th>
                                <th class="px-2 py-3 text-center">AST</th>
                                <th class="px-2 py-3 text-center">STL</th>
                                <th class="px-2 py-3 text-center">BLK</th>
                                <th class="px-2 py-3 text-center bg-blue-50/40 text-blue-700">3PM</th>
                                <th class="px-2 py-3 text-center bg-blue-50/40 text-blue-700">3PA</th>
                                <th class="px-2 py-3 text-center bg-emerald-50/40 text-emerald-700">2PM</th>
                                <th class="px-2 py-3 text-center bg-emerald-50/40 text-emerald-700">2PA</th>
                                <th class="px-2 py-3 text-center bg-amber-50/40 text-amber-700">FTM</th>
                                <th class="px-2 py-3 text-center bg-amber-50/40 text-amber-700">FTA</th>
                                <th class="px-2 py-3 text-center text-rose-600">TO</th>
                                <th class="px-2 py-3 text-center text-rose-600">FOUL</th>
                                <th class="px-2 py-3 text-center">+/-</th>
                                <th class="px-3 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                            @forelse($selectedMatch->teamB->players as $player)
                                @php $s = $statsMap->get($player->id_player); @endphp
                                <tr class="hover:bg-slate-50/80 transition stat-row team-b-row">
                                    <!-- Player Info Sticky -->
                                    <td class="px-4 py-2.5 sticky left-0 bg-white z-10 shadow-[1px_0_0_0_#e2e8f0] whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-slate-100 text-slate-800 flex items-center justify-center font-bold text-[11px] shrink-0">
                                                #{{ $player->no_punggung }}
                                            </span>
                                            <div>
                                                <span class="font-bold text-slate-900 block text-xs">{{ $player->nama }}</span>
                                                <span class="text-[10px] text-slate-400 font-normal">{{ $player->posisi }} • {{ $player->gender }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- MIN -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="text" name="stats[{{ $player->id_player }}][minutes]" value="{{ $s->minutes ?? '20:00' }}" 
                                               class="w-14 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-semibold focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- PTS -->
                                    <td class="px-1.5 py-2 text-center bg-orange-50/30">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][poin]" value="{{ $s->poin ?? 0 }}" 
                                               class="w-14 text-center py-1 px-1 rounded-lg border border-orange-300 bg-white text-xs font-black text-orange-600 focus:ring-2 focus:ring-orange-500 outline-none stat-input-pts stat-input-b">
                                    </td>

                                    <!-- REB -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][rebound]" value="{{ $s->rebound ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-bold text-slate-800 focus:ring-1 focus:ring-orange-500 outline-none stat-input-reb-b">
                                    </td>

                                    <!-- AST -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][assist]" value="{{ $s->assist ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs font-bold text-slate-800 focus:ring-1 focus:ring-orange-500 outline-none stat-input-ast-b">
                                    </td>

                                    <!-- STL -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][steal]" value="{{ $s->steal ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- BLK -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][block]" value="{{ $s->block ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-orange-500 outline-none">
                                    </td>

                                    <!-- 3PM -->
                                    <td class="px-1.5 py-2 text-center bg-blue-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_made]" value="{{ $s->three_point_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-blue-300 bg-blue-50/50 text-xs font-bold text-blue-700 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </td>

                                    <!-- 3PA -->
                                    <td class="px-1.5 py-2 text-center bg-blue-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_attempted]" value="{{ $s->three_point_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </td>

                                    <!-- 2PM -->
                                    <td class="px-1.5 py-2 text-center bg-emerald-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][two_point_made]" value="{{ $s->two_point_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-emerald-300 bg-emerald-50/50 text-xs font-bold text-emerald-700 focus:ring-1 focus:ring-emerald-500 outline-none">
                                    </td>

                                    <!-- 2PA -->
                                    <td class="px-1.5 py-2 text-center bg-emerald-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][two_point_attempted]" value="{{ $s->two_point_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-emerald-500 outline-none">
                                    </td>

                                    <!-- FTM -->
                                    <td class="px-1.5 py-2 text-center bg-amber-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_made]" value="{{ $s->free_throw_made ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-amber-300 bg-amber-50/50 text-xs font-bold text-amber-700 focus:ring-1 focus:ring-amber-500 outline-none">
                                    </td>

                                    <!-- FTA -->
                                    <td class="px-1.5 py-2 text-center bg-amber-50/20">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_attempted]" value="{{ $s->free_throw_attempted ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-700 focus:ring-1 focus:ring-amber-500 outline-none">
                                    </td>

                                    <!-- TO -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][turnover]" value="{{ $s->turnover ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-rose-600 focus:ring-1 focus:ring-rose-500 outline-none">
                                    </td>

                                    <!-- FOUL -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" min="0" name="stats[{{ $player->id_player }}][foul]" value="{{ $s->foul ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-rose-600 focus:ring-1 focus:ring-rose-500 outline-none">
                                    </td>

                                    <!-- +/- -->
                                    <td class="px-1.5 py-2 text-center">
                                        <input type="number" name="stats[{{ $player->id_player }}][plus_minus]" value="{{ $s->plus_minus ?? 0 }}" 
                                               class="w-12 text-center py-1 px-1 rounded-lg border border-slate-300 text-xs text-slate-600 focus:ring-1 focus:ring-slate-500 outline-none">
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-3 py-2 text-right whitespace-nowrap">
                                        @if($s)
                                            <button type="button" onclick="deleteStatRow({{ $s->id_statistic }})" class="text-rose-500 hover:text-rose-700 text-[10px] font-bold">
                                                Hapus Stat
                                            </button>
                                        @else
                                            <span class="text-slate-300 text-[10px]">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="px-6 py-6 text-center text-slate-400">
                                        Belum ada pemain di tim ini. Klik tombol <button type="button" onclick="openAddPlayerModal({{ $selectedMatch->teamB->id_team }}, '{{ addslashes($selectedMatch->teamB->nama_tim) }}')" class="text-blue-600 font-bold underline">+ Tambah Pemain</button> untuk menambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sticky Bottom Action Bar -->
            <div class="sticky bottom-4 bg-slate-900/95 backdrop-blur text-white p-4 rounded-2xl shadow-2xl border border-slate-800 flex items-center justify-between z-40">
                <div class="hidden sm:flex items-center gap-4 text-xs font-semibold text-slate-300">
                    <div>
                        <span class="text-orange-400 font-bold">{{ $selectedMatch->teamA->nama_tim }}:</span>
                        <span id="bottom_total_a" class="font-black text-white text-sm">0</span> PTS
                    </div>
                    <span>vs</span>
                    <div>
                        <span class="text-blue-400 font-bold">{{ $selectedMatch->teamB->nama_tim }}:</span>
                        <span id="bottom_total_b" class="font-black text-white text-sm">0</span> PTS
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <button type="reset" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold text-xs transition">
                        Reset Angka
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-extrabold text-xs shadow-lg shadow-orange-600/30 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Semua Statistik Box Score
                    </button>
                </div>
            </div>
        </form>

    @endif

</div>

<!-- ========================================================================= -->
<!-- MODAL 1: TAMBAH PEMAIN BARU -->
<!-- ========================================================================= -->
<div id="addPlayerModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 animate-in fade-in duration-200">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-lg font-black text-slate-900">Tambah Pemain Baru</h3>
                <p class="text-xs text-slate-500">Daftarkan pemain langsung ke tim/sekolah</p>
            </div>
            <button type="button" onclick="closeAddPlayerModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">✕</button>
        </div>

        <form action="{{ route('admin.statistics.player.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <input type="hidden" name="match_id" value="{{ $selectedMatch->id_match ?? '' }}">

            <!-- Pilih Tim / Sekolah -->
            <div>
                <label for="modal_id_team" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sekolah / Tim <span class="text-rose-500">*</span></label>
                <select name="id_team" id="modal_id_team" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-white focus:ring-2 focus:ring-orange-500 outline-none">
                    <option value="">-- Pilih Tim yang Sudah Ada --</option>
                    @foreach($teams as $t)
                        <option value="{{ $t->id_team }}">{{ $t->nama_tim }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Atau Ketik Nama Sekolah Baru -->
            <div class="bg-orange-50/50 p-3 rounded-xl border border-orange-200/60">
                <label for="modal_nama_tim_baru" class="block text-[11px] font-bold text-orange-800 mb-1">
                    Atau Ketik Nama Sekolah / Tim Baru (Jika belum ada di daftar):
                </label>
                <input type="text" name="nama_tim_baru" id="modal_nama_tim_baru" 
                       class="w-full px-3 py-2 rounded-lg border border-orange-300 bg-white text-xs font-medium focus:ring-2 focus:ring-orange-500 outline-none" 
                       placeholder="Contoh: SMA Negeri 3 Bogor">
            </div>

            <!-- Nama Pemain -->
            <div>
                <label for="modal_nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Lengkap Pemain <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" id="modal_nama" required 
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-medium focus:ring-2 focus:ring-orange-500 outline-none" 
                       placeholder="Contoh: Ahmad Fauzan">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <!-- No Punggung -->
                <div>
                    <label for="modal_no_punggung" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">No Punggung <span class="text-rose-500">*</span></label>
                    <input type="number" min="0" max="99" name="no_punggung" id="modal_no_punggung" required 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-bold focus:ring-2 focus:ring-orange-500 outline-none" 
                           placeholder="Contoh: 10">
                </div>

                <!-- Posisi -->
                <div>
                    <label for="modal_posisi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Posisi <span class="text-rose-500">*</span></label>
                    <select name="posisi" id="modal_posisi" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-white focus:ring-2 focus:ring-orange-500 outline-none">
                        <option value="Point Guard (PG)">Point Guard (PG)</option>
                        <option value="Shooting Guard (SG)">Shooting Guard (SG)</option>
                        <option value="Small Forward (SF)">Small Forward (SF)</option>
                        <option value="Power Forward (PF)">Power Forward (PF)</option>
                        <option value="Center (C)">Center (C)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <!-- Gender / Divisi -->
                <div>
                    <label for="modal_gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Divisi <span class="text-rose-500">*</span></label>
                    <select name="gender" id="modal_gender" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-white focus:ring-2 focus:ring-orange-500 outline-none">
                        <option value="Boys">Boys (Putra)</option>
                        <option value="Girls">Girls (Putri)</option>
                    </select>
                </div>

                <!-- Kelas / Jurusan -->
                <div>
                    <label for="modal_kelas" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kelas / Jurusan</label>
                    <input type="text" name="kelas_program" id="modal_kelas" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-medium focus:ring-2 focus:ring-orange-500 outline-none" 
                           placeholder="Contoh: XII PPLG 2">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddPlayerModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-xs hover:bg-slate-200 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition">
                    Simpan Pemain
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL 2: TAMBAH TIM / SEKOLAH BARU -->
<!-- ========================================================================= -->
<div id="addTeamModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 animate-in fade-in duration-200">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-lg font-black text-slate-900">Tambah Sekolah / Tim Baru</h3>
                <p class="text-xs text-slate-500">Daftarkan institusi sekolah atau nama tim turnamen</p>
            </div>
            <button type="button" onclick="closeAddTeamModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">✕</button>
        </div>

        <form action="{{ route('admin.statistics.team.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <input type="hidden" name="match_id" value="{{ $selectedMatch->id_match ?? '' }}">

            <div>
                <label for="team_nama_tim" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Tim / Sekolah <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_tim" id="team_nama_tim" required 
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-medium focus:ring-2 focus:ring-orange-500 outline-none" 
                       placeholder="Contoh: SMA Regina Pacis Bogor">
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddTeamModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-xs hover:bg-slate-200 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Sekolah/Tim
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Single Statistic Delete Form -->
<form id="deleteStatForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
    function openAddPlayerModal(teamId = null, teamName = '') {
        const select = document.getElementById('modal_id_team');
        if (teamId) {
            select.value = teamId;
        }
        document.getElementById('addPlayerModal').classList.remove('hidden');
    }

    function closeAddPlayerModal() {
        document.getElementById('addPlayerModal').classList.add('hidden');
    }

    function openAddTeamModal() {
        document.getElementById('addTeamModal').classList.remove('hidden');
    }

    function closeAddTeamModal() {
        document.getElementById('addTeamModal').classList.add('hidden');
    }

    function deleteStatRow(statId) {
        if (confirm('Hapus baris data statistik pemain ini dari pertandingan?')) {
            const form = document.getElementById('deleteStatForm');
            form.action = '/admin/statistics/' + statId;
            form.submit();
        }
    }

    // Dynamic Live Point & Score Calculation
    function calculateTotals() {
        let totalA = 0;
        let totalB = 0;

        document.querySelectorAll('.stat-input-a').forEach(input => {
            totalA += parseInt(input.value) || 0;
        });

        document.querySelectorAll('.stat-input-b').forEach(input => {
            totalB += parseInt(input.value) || 0;
        });

        // Update indicators
        const elTotalA = document.getElementById('team_a_total_pts');
        const elTotalB = document.getElementById('team_b_total_pts');
        const headerA = document.getElementById('header_score_a');
        const headerB = document.getElementById('header_score_b');
        const bottomA = document.getElementById('bottom_total_a');
        const bottomB = document.getElementById('bottom_total_b');

        if (elTotalA) elTotalA.textContent = totalA;
        if (elTotalB) elTotalB.textContent = totalB;
        if (headerA) headerA.textContent = totalA;
        if (headerB) headerB.textContent = totalB;
        if (bottomA) bottomA.textContent = totalA;
        if (bottomB) bottomB.textContent = totalB;
    }

    document.addEventListener('DOMContentLoaded', () => {
        calculateTotals();

        document.querySelectorAll('.stat-input-pts').forEach(input => {
            input.addEventListener('input', calculateTotals);
        });
    });
</script>
@endpush
