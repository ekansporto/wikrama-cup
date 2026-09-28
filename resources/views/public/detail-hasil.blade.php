@extends('layouts.app')

@section('title', 'Statistik Pertandingan: ' . $match->teamA->nama_tim . ' vs ' . $match->teamB->nama_tim . ' — WIKCUP')

@section('content')
<!-- Match Scoreboard Header -->
<div class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('result.index') }}" class="inline-flex items-center text-xs font-semibold text-slate-400 hover:text-orange-400 transition mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Semua Hasil
        </a>

        <!-- Scoreboard -->
        <div class="bg-slate-900/90 rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-2xl backdrop-blur">
            <div class="text-center text-xs text-slate-400 uppercase tracking-widest font-bold mb-4">
                Official Box Score • {{ $match->formatted_date }} • {{ $match->lokasi }}
            </div>

            <div class="grid grid-cols-7 items-center max-w-4xl mx-auto my-4">
                <!-- Team A -->
                <div class="col-span-3 text-center sm:text-right flex flex-col sm:flex-row items-center justify-end gap-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-white {{ $match->skor_tim_a > $match->skor_tim_b ? 'text-orange-400' : '' }}">
                            {{ $match->teamA->nama_tim }}
                        </h2>
                        @if($match->skor_tim_a > $match->skor_tim_b)
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider mt-1">WINNER</span>
                        @endif
                    </div>
                    <img src="{{ $match->teamA->logo_url }}" alt="{{ $match->teamA->nama_tim }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover bg-slate-800 border border-slate-700 shadow-md">
                </div>

                <!-- Score Numbers -->
                <div class="col-span-1 text-center font-black text-3xl sm:text-5xl tracking-tight">
                    <span class="{{ $match->skor_tim_a > $match->skor_tim_b ? 'text-orange-400' : 'text-white' }}">{{ $match->skor_tim_a ?? 0 }}</span>
                    <span class="text-slate-500 mx-1 text-2xl sm:text-3xl font-light">-</span>
                    <span class="{{ $match->skor_tim_b > $match->skor_tim_a ? 'text-orange-400' : 'text-white' }}">{{ $match->skor_tim_b ?? 0 }}</span>
                </div>

                <!-- Team B -->
                <div class="col-span-3 text-center sm:text-left flex flex-col sm:flex-row-reverse items-center justify-end gap-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-white {{ $match->skor_tim_b > $match->skor_tim_a ? 'text-orange-400' : '' }}">
                            {{ $match->teamB->nama_tim }}
                        </h2>
                        @if($match->skor_tim_b > $match->skor_tim_a)
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider mt-1">WINNER</span>
                        @endif
                    </div>
                    <img src="{{ $match->teamB->logo_url }}" alt="{{ $match->teamB->nama_tim }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover bg-slate-800 border border-slate-700 shadow-md">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    <!-- BOX SCORE TEAM A -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ $match->teamA->logo_url }}" alt="" class="w-8 h-8 rounded-lg object-cover bg-slate-800 border border-slate-700">
                <h3 class="text-lg font-bold">{{ $match->teamA->nama_tim }} — Statistik Pemain</h3>
            </div>
            <span class="text-xs text-orange-400 font-semibold uppercase tracking-wider">Total Skor: {{ $match->skor_tim_a }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Pemain</th>
                        <th class="px-3 py-3 text-center">MIN</th>
                        <th class="px-3 py-3 text-center text-orange-600">PTS</th>
                        <th class="px-3 py-3 text-center">REB</th>
                        <th class="px-3 py-3 text-center">AST</th>
                        <th class="px-3 py-3 text-center">STL</th>
                        <th class="px-3 py-3 text-center">BLK</th>
                        <th class="px-3 py-3 text-center">TO</th>
                        <th class="px-3 py-3 text-center">FGM-A</th>
                        <th class="px-3 py-3 text-center">FG%</th>
                        <th class="px-3 py-3 text-center">3PT%</th>
                        <th class="px-3 py-3 text-center">FT%</th>
                        <th class="px-3 py-3 text-center">+/-</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($teamAStats as $stat)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3">
                                <a href="{{ route('player.show', $stat->player->id_player) }}" class="flex items-center gap-2.5 font-bold text-slate-900 hover:text-orange-600 transition">
                                    <span class="text-xs text-slate-400 w-5">#{{ $stat->player->no_punggung }}</span>
                                    <span>{{ $stat->player->nama }}</span>
                                    @if($stat->player->is_captain)
                                        <span class="text-[9px] px-1 bg-amber-100 text-amber-800 rounded font-bold">C</span>
                                    @endif
                                </a>
                            </td>
                            <td class="px-3 py-3 text-center text-slate-500">{{ $stat->minutes }}</td>
                            <td class="px-3 py-3 text-center font-extrabold text-orange-600">{{ $stat->poin }}</td>
                            <td class="px-3 py-3 text-center font-bold text-slate-800">{{ $stat->rebound }}</td>
                            <td class="px-3 py-3 text-center font-bold text-slate-800">{{ $stat->assist }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->steal }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->block }}</td>
                            <td class="px-3 py-3 text-center text-slate-500">{{ $stat->turnover }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->fgm }}/{{ $stat->fga }}</td>
                            <td class="px-3 py-3 text-center font-semibold text-slate-700">{{ $stat->fg_percentage }}%</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->three_pt_percentage }}%</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->ft_percentage }}%</td>
                            <td class="px-3 py-3 text-center font-bold {{ $stat->plus_minus >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $stat->plus_minus > 0 ? '+' : '' }}{{ $stat->plus_minus }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-4 py-8 text-center text-slate-400">Belum ada statistik detail pemain untuk tim ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- BOX SCORE TEAM B -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ $match->teamB->logo_url }}" alt="" class="w-8 h-8 rounded-lg object-cover bg-slate-800 border border-slate-700">
                <h3 class="text-lg font-bold">{{ $match->teamB->nama_tim }} — Statistik Pemain</h3>
            </div>
            <span class="text-xs text-orange-400 font-semibold uppercase tracking-wider">Total Skor: {{ $match->skor_tim_b }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Pemain</th>
                        <th class="px-3 py-3 text-center">MIN</th>
                        <th class="px-3 py-3 text-center text-orange-600">PTS</th>
                        <th class="px-3 py-3 text-center">REB</th>
                        <th class="px-3 py-3 text-center">AST</th>
                        <th class="px-3 py-3 text-center">STL</th>
                        <th class="px-3 py-3 text-center">BLK</th>
                        <th class="px-3 py-3 text-center">TO</th>
                        <th class="px-3 py-3 text-center">FGM-A</th>
                        <th class="px-3 py-3 text-center">FG%</th>
                        <th class="px-3 py-3 text-center">3PT%</th>
                        <th class="px-3 py-3 text-center">FT%</th>
                        <th class="px-3 py-3 text-center">+/-</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($teamBStats as $stat)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3">
                                <a href="{{ route('player.show', $stat->player->id_player) }}" class="flex items-center gap-2.5 font-bold text-slate-900 hover:text-orange-600 transition">
                                    <span class="text-xs text-slate-400 w-5">#{{ $stat->player->no_punggung }}</span>
                                    <span>{{ $stat->player->nama }}</span>
                                    @if($stat->player->is_captain)
                                        <span class="text-[9px] px-1 bg-amber-100 text-amber-800 rounded font-bold">C</span>
                                    @endif
                                </a>
                            </td>
                            <td class="px-3 py-3 text-center text-slate-500">{{ $stat->minutes }}</td>
                            <td class="px-3 py-3 text-center font-extrabold text-orange-600">{{ $stat->poin }}</td>
                            <td class="px-3 py-3 text-center font-bold text-slate-800">{{ $stat->rebound }}</td>
                            <td class="px-3 py-3 text-center font-bold text-slate-800">{{ $stat->assist }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->steal }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->block }}</td>
                            <td class="px-3 py-3 text-center text-slate-500">{{ $stat->turnover }}</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->fgm }}/{{ $stat->fga }}</td>
                            <td class="px-3 py-3 text-center font-semibold text-slate-700">{{ $stat->fg_percentage }}%</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->three_pt_percentage }}%</td>
                            <td class="px-3 py-3 text-center text-slate-600">{{ $stat->ft_percentage }}%</td>
                            <td class="px-3 py-3 text-center font-bold {{ $stat->plus_minus >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $stat->plus_minus > 0 ? '+' : '' }}{{ $stat->plus_minus }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-4 py-8 text-center text-slate-400">Belum ada statistik detail pemain untuk tim ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
