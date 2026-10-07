@extends('layouts.app')

@section('title', 'Statistik Turnamen & Ranking Pemain — WIKCUP')

@section('content')
<!-- Page Header Banner -->
<div class="relative py-14 border-b border-slate-200/80 bg-white overflow-hidden">
    <!-- Abstract Blurred Circles Background (Samain persis design) -->
    <div class="absolute -top-16 left-1/4 w-[420px] h-[420px] rounded-full bg-orange-300/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute top-0 right-10 w-[380px] h-[380px] rounded-full bg-cyan-200/40 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-10 left-10 w-[320px] h-[320px] rounded-full bg-emerald-200/30 blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/70 text-orange-600 text-xs font-bold mb-3 uppercase tracking-wider shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#EA580C] animate-pulse"></span>
                    Turnamen Basket Resmi SMK Wikrama Bogor
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B]">Statistik Turnamen</h1>
                <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl font-normal">
                    Pusat rekapitulasi data statistik pertandingan dan papan peringkat individu pemain turnamen Wikrama Cup Basketball.
                </p>
            </div>

            @if($isFiltered)
                <div>
                    <a href="{{ route('statistic.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold text-xs sm:text-sm transition shadow-sm">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Lihat Riwayat Statistik Pertandingan
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-8">

    <!-- ========================================================================= -->
    <!-- FILTER / RANKING SEARCH BAR (SELALU TAMPIL DI ATAS) -->
    <!-- ========================================================================= -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between gap-4 mb-4 pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-5 bg-orange-600 rounded-full inline-block"></span>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900">Filter & Cari Ranking Pemain</h2>
            </div>
            <span class="text-xs text-slate-500 hidden sm:inline-block">Pilih kriteria untuk menampilkan peringkat statistik pemain</span>
        </div>

        <form action="{{ route('statistic.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
            <input type="hidden" name="filter" value="1">

            <!-- 1. Divisi (Boys / Girls) -->
            <div>
                <label for="gender" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Divisi / Kategori
                </label>
                <select name="gender" id="gender" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                    <option value="Boys" {{ $gender === 'Boys' ? 'selected' : '' }}>👦 Boys (Putra)</option>
                    <option value="Girls" {{ $gender === 'Girls' ? 'selected' : '' }}>👧 Girls (Putri)</option>
                    <option value="all" {{ $gender === 'all' ? 'selected' : '' }}>🌐 Semua Divisi</option>
                </select>
            </div>

            <!-- 2. Top Limit (Top 5 / 10 / 20) -->
            <div>
                <label for="top" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Peringkat
                </label>
                <select name="top" id="top" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                    <option value="5" {{ $top == 5 ? 'selected' : '' }}>Top 5 Pemain</option>
                    <option value="10" {{ $top == 10 ? 'selected' : '' }}>Top 10 Pemain</option>
                    <option value="20" {{ $top == 20 ? 'selected' : '' }}>Top 20 Pemain</option>
                </select>
            </div>

            <!-- 3. Kategori Statistik -->
            <div>
                <label for="category" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Kategori Statistik
                </label>
                <select name="category" id="category" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-800 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                    @foreach($categories as $key => $cat)
                        <option value="{{ $key }}" {{ $category === $key ? 'selected' : '' }}>
                            {{ $cat['label'] }} ({{ $cat['unit'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 4. Cari Nama Sekolah / Tim -->
            <div>
                <label for="school" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Nama Sekolah / Tim
                </label>
                <input type="text" name="school" id="school" value="{{ $school }}" 
                       placeholder="Contoh: SMK Wikrama"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-medium text-slate-800 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
            </div>

            <!-- 5. Tombol Submit & Reset -->
            <div class="flex items-end gap-2">
                <button type="submit" 
                        class="flex-1 px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-extrabold text-xs sm:text-sm shadow-sm transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Cari Ranking</span>
                </button>

                @if($isFiltered)
                    <a href="{{ route('statistic.index') }}" 
                       title="Kembali ke Riwayat Statistik Pertandingan"
                       class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- ========================================================================= -->
    <!-- STATE 1 — DEFAULT: RIWAYAT STATISTIK PERTANDINGAN -->
    <!-- Tampil ketika user belum memfilter / saat awal halaman dibuka -->
    <!-- ========================================================================= -->
    @if(!$isFiltered)
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-5 bg-orange-500 rounded-full inline-block"></span>
                    <div>
                        <h2 class="text-base sm:text-lg font-extrabold">Riwayat Statistik Pertandingan</h2>
                        <p class="text-[11px] text-slate-400">Seluruh data rekaman statistik pemain per laga turnamen WIKCUP</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-xs font-semibold text-orange-400">
                        Total {{ $statistics->total() }} Data Pertandingan
                    </span>
                </div>
            </div>

            <!-- Tabel Riwayat Statistik Pertandingan Lengkap -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3.5 sticky left-0 bg-slate-50 z-10">Pertandingan</th>
                            <th class="px-4 py-3.5">Pemain</th>
                            <th class="px-3 py-3.5 text-center">MIN</th>
                            <th class="px-3 py-3.5 text-center font-black text-orange-600 bg-orange-50/50">PTS</th>
                            <th class="px-3 py-3.5 text-center font-bold">REB</th>
                            <th class="px-3 py-3.5 text-center font-bold">AST</th>
                            <th class="px-3 py-3.5 text-center">STL</th>
                            <th class="px-3 py-3.5 text-center">BLK</th>
                            <th class="px-3 py-3.5 text-center">TO</th>
                            <th class="px-3 py-3.5 text-center">FGM</th>
                            <th class="px-3 py-3.5 text-center">FGA</th>
                            <th class="px-3 py-3.5 text-center font-semibold">FG%</th>
                            <th class="px-3 py-3.5 text-center">3FGM</th>
                            <th class="px-3 py-3.5 text-center">3FGA</th>
                            <th class="px-3 py-3.5 text-center font-semibold">3FG%</th>
                            <th class="px-3 py-3.5 text-center">2FGM</th>
                            <th class="px-3 py-3.5 text-center">2FGA</th>
                            <th class="px-3 py-3.5 text-center font-semibold">2FG%</th>
                            <th class="px-3 py-3.5 text-center">FTM</th>
                            <th class="px-3 py-3.5 text-center">FTA</th>
                            <th class="px-3 py-3.5 text-center font-semibold">FT%</th>
                            <th class="px-3 py-3.5 text-center">DRB</th>
                            <th class="px-3 py-3.5 text-center">FOL</th>
                            <th class="px-3 py-3.5 text-center font-bold">+/-</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                        @forelse($statistics as $stat)
                            <tr class="hover:bg-slate-50 transition">
                                <!-- Pertandingan -->
                                <td class="px-4 py-3 sticky left-0 bg-white hover:bg-slate-50 z-10 border-r border-slate-100 sm:border-r-0">
                                    @if($stat->match)
                                        <a href="{{ route('result.show', $stat->match->id_match) }}" class="font-bold text-slate-900 hover:text-orange-600 transition block leading-tight">
                                            {{ $stat->match->teamA->nama_tim ?? '-' }} vs {{ $stat->match->teamB->nama_tim ?? '-' }}
                                        </a>
                                        <span class="text-[11px] text-slate-400 block mt-0.5">{{ $stat->match->formatted_date }}</span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Pemain & Tim -->
                                <td class="px-4 py-3">
                                    @if($stat->player)
                                        <a href="{{ route('player.show', $stat->player->id_player) }}" class="flex items-center gap-2.5 group">
                                            <img src="{{ $stat->player->foto_url }}" alt="{{ $stat->player->nama }}" class="w-8 h-8 rounded-lg object-cover bg-slate-100 border border-slate-200 shrink-0">
                                            <div>
                                                <div class="font-extrabold text-slate-900 group-hover:text-orange-600 transition flex items-center gap-1">
                                                    <span>{{ $stat->player->nama }}</span>
                                                    <span class="text-[10px] text-slate-400 font-normal">#{{ $stat->player->no_punggung }}</span>
                                                </div>
                                                <div class="text-[11px] text-slate-500 flex items-center gap-1">
                                                    <span>{{ $stat->player->team->nama_tim ?? '-' }}</span>
                                                    <span>•</span>
                                                    <span class="text-orange-600 font-semibold">{{ $stat->player->gender ?? 'Boys' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Statistik Columns -->
                                <td class="px-3 py-3 text-center text-slate-500">{{ $stat->minutes ?? '00:00' }}</td>
                                <td class="px-3 py-3 text-center font-black text-orange-600 text-sm bg-orange-50/50">{{ $stat->poin }}</td>
                                <td class="px-3 py-3 text-center font-bold text-slate-900">{{ $stat->rebound }}</td>
                                <td class="px-3 py-3 text-center font-bold text-slate-900">{{ $stat->assist }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->steal }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->block }}</td>
                                <td class="px-3 py-3 text-center text-slate-500">{{ $stat->turnover }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->fgm }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->fga }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-800">{{ $stat->fg_percentage }}%</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->three_point_made }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->three_point_attempted }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-800">{{ $stat->three_pt_percentage }}%</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->two_point_made }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->two_point_attempted }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-800">{{ $stat->two_pt_percentage }}%</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->free_throw_made }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->free_throw_attempted }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-800">{{ $stat->ft_percentage }}%</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->defensive_rebound }}</td>
                                <td class="px-3 py-3 text-center text-slate-700">{{ $stat->foul }}</td>
                                <td class="px-3 py-3 text-center font-bold {{ $stat->plus_minus >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $stat->plus_minus > 0 ? '+' : '' }}{{ $stat->plus_minus }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="24" class="px-6 py-12 text-center text-slate-400 font-medium">
                                    Belum ada data statistik pertandingan yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($statistics->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $statistics->links() }}
                </div>
            @endif
        </div>

    <!-- ========================================================================= -->
    <!-- STATE 2 — SETELAH FILTER: RANKING PEMAIN -->
    <!-- Tampil setelah user memilih filter dan klik Cari Ranking -->
    <!-- ========================================================================= -->
    @else
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-5 bg-orange-500 rounded-full inline-block"></span>
                        <h2 class="text-base sm:text-lg font-extrabold">
                            Hasil Ranking: Top {{ $top }} Pemain — {{ $currentCat['label'] }} ({{ $currentCat['unit'] }})
                        </h2>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 mt-1.5">
                        <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-[11px] font-semibold text-orange-400 border border-slate-700">
                            Divisi: {{ $gender === 'all' ? 'Semua Divisi' : ($gender === 'Boys' ? 'Boys (Putra)' : 'Girls (Putri)') }}
                        </span>
                        @if(!empty($school))
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-[11px] font-semibold text-slate-300 border border-slate-700">
                                Sekolah/Tim: "{{ $school }}"
                            </span>
                        @endif
                    </div>
                </div>

                <a href="{{ route('statistic.index') }}" 
                   class="inline-flex items-center gap-1.5 text-xs text-orange-400 hover:text-orange-300 font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Riwayat Statistik
                </a>
            </div>

            <!-- Tabel Ranking Pemain -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3.5 w-16 text-center">Rank</th>
                            <th class="px-5 py-3.5">Pemain</th>
                            <th class="px-5 py-3.5">Tim / Sekolah</th>
                            <th class="px-3 py-3.5 text-center">Divisi</th>
                            <th class="px-3 py-3.5 text-center">Laga (GP)</th>
                            <th class="px-4 py-3.5 text-center font-extrabold text-orange-600 bg-orange-50/60">
                                Total {{ $currentCat['unit'] }}
                            </th>
                            <th class="px-4 py-3.5 text-center font-bold text-slate-800">
                                Rata-rata ({{ $currentCat['per_game'] }})
                            </th>
                            <th class="px-3 py-3.5 text-center">PTS</th>
                            <th class="px-3 py-3.5 text-center">REB</th>
                            <th class="px-3 py-3.5 text-center">AST</th>
                            <th class="px-3 py-3.5 text-center">STL</th>
                            <th class="px-3 py-3.5 text-center">BLK</th>
                            <th class="px-3 py-3.5 text-center">3FGM</th>
                            <th class="px-3 py-3.5 text-center">FTM</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                        @forelse($rankings as $index => $row)
                            @php
                                $rank = $index + 1;
                            @endphp
                            <tr class="hover:bg-slate-50 transition">
                                <!-- Rank Badge -->
                                <td class="px-4 py-4 text-center">
                                    @if($rank === 1)
                                        <span class="w-7 h-7 rounded-full bg-amber-400 text-slate-950 font-black inline-flex items-center justify-center text-xs shadow-sm">
                                            1
                                        </span>
                                    @elseif($rank === 2)
                                        <span class="w-7 h-7 rounded-full bg-slate-300 text-slate-950 font-black inline-flex items-center justify-center text-xs shadow-sm">
                                            2
                                        </span>
                                    @elseif($rank === 3)
                                        <span class="w-7 h-7 rounded-full bg-amber-700 text-white font-black inline-flex items-center justify-center text-xs shadow-sm">
                                            3
                                        </span>
                                    @else
                                        <span class="text-slate-500 font-bold text-xs">{{ $rank }}</span>
                                    @endif
                                </td>

                                <!-- Pemain -->
                                <td class="px-5 py-4">
                                    @if($row->player)
                                        <a href="{{ route('player.show', $row->player->id_player) }}" class="flex items-center gap-3 group">
                                            <img src="{{ $row->player->foto_url }}" alt="{{ $row->player->nama }}" class="w-10 h-10 rounded-xl object-cover bg-slate-100 border border-slate-200 shrink-0">
                                            <div>
                                                <div class="font-extrabold text-slate-900 group-hover:text-orange-600 transition flex items-center gap-1.5">
                                                    <span>{{ $row->player->nama }}</span>
                                                    <span class="text-xs text-slate-400 font-normal">#{{ $row->player->no_punggung }}</span>
                                                </div>
                                                <div class="text-xs text-slate-500">{{ $row->player->posisi }}</div>
                                            </div>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Tim / Sekolah -->
                                <td class="px-5 py-4">
                                    @if($row->player && $row->player->team)
                                        <a href="{{ route('team.show', $row->player->team->id_team) }}" class="font-bold text-slate-700 hover:text-orange-600 transition block">
                                            {{ $row->player->team->nama_tim }}
                                        </a>
                                        <span class="text-[11px] text-slate-400">{{ $row->player->kelas_program ?? 'Siswa' }}</span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Divisi -->
                                <td class="px-3 py-4 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ ($row->player->gender ?? 'Boys') === 'Girls' ? 'bg-pink-100 text-pink-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $row->player->gender ?? 'Boys' }}
                                    </span>
                                </td>

                                <!-- GP -->
                                <td class="px-3 py-4 text-center font-bold text-slate-600">
                                    {{ $row->gp }}
                                </td>

                                <!-- Total Stat Highlighted -->
                                <td class="px-4 py-4 text-center font-black text-lg text-orange-600 bg-orange-50/60">
                                    {{ $row->total_val }}
                                </td>

                                <!-- Rata-rata per game -->
                                <td class="px-4 py-4 text-center font-extrabold text-slate-900">
                                    {{ $row->avg_val }}
                                </td>

                                <!-- Breakdown Stats -->
                                <td class="px-3 py-4 text-center font-semibold text-slate-700">{{ $row->sum_poin }}</td>
                                <td class="px-3 py-4 text-center font-semibold text-slate-700">{{ $row->sum_rebound }}</td>
                                <td class="px-3 py-4 text-center font-semibold text-slate-700">{{ $row->sum_assist }}</td>
                                <td class="px-3 py-4 text-center text-slate-600">{{ $row->sum_steal }}</td>
                                <td class="px-3 py-4 text-center text-slate-600">{{ $row->sum_block }}</td>
                                <td class="px-3 py-4 text-center text-slate-600">{{ $row->sum_3pm }}</td>
                                <td class="px-3 py-4 text-center text-slate-600">{{ $row->sum_ftm }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="px-6 py-12 text-center text-slate-400">
                                    <div class="max-w-sm mx-auto space-y-2">
                                        <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="font-bold text-slate-700">Tidak ada data pemain yang cocok</p>
                                        <p class="text-xs text-slate-500">Coba ubah kriteria filter pencarian atau reset filter untuk kembali ke riwayat pertandingan.</p>
                                        <div class="pt-2">
                                            <a href="{{ route('statistic.index') }}" class="inline-block px-4 py-2 rounded-xl bg-orange-600 text-white font-bold text-xs shadow-sm hover:bg-orange-500 transition">
                                                Reset Filter
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer info -->
            <div class="p-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                <span>Menampilkan maksimal {{ $top }} pemain dengan total {{ $currentCat['label'] }} tertinggi.</span>
                <a href="{{ route('statistic.index') }}" class="font-bold text-orange-600 hover:text-orange-700 transition">
                    ← Lihat Seluruh Riwayat Statistik Pertandingan
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
