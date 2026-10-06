@extends('layouts.app')

@section('title', 'Wikrama Cup Basketball — Turnamen & Statistik Basket Wikrama')

@section('content')
<!-- HERO SECTION -->
<section class="bg-white border-b border-slate-200 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div class="space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-700 text-xs font-bold tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-orange-600 animate-pulse"></span>
                    Turnamen Basket Resmi SMK Wikrama
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 leading-[1.1]">
                    Wikrama Cup <span class="text-orange-600">Basketball</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Informasi pertandingan dan statistik Wikrama dalam satu website. Pantau jadwal tim, hasil skor langsung, profil pemain, serta performa statistik turnamen terlengkap.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('schedule.index') }}" class="inline-flex items-center justify-center px-6 py-3 font-bold text-white bg-orange-600 hover:bg-orange-700 transition-colors">
                        Lihat Jadwal
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('statistic.index') }}" class="inline-flex items-center justify-center px-6 py-3 font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                        Lihat Statistik
                    </a>
                </div>
            </div>

            <!-- Minimalist Stats Widget -->
            <div class="flex justify-center lg:justify-end">
                <div class="w-full max-w-md bg-slate-900 text-white p-8 border-t-4 border-orange-600">
                    <div class="flex items-center justify-between border-b border-slate-700 pb-4 mb-6">
                        <div class="text-xs font-bold uppercase tracking-widest text-orange-500">Live Championship</div>
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

                    <div class="text-3xl font-black mb-1">SMK WIKRAMA</div>
                    <div class="text-sm text-slate-400 mb-8">BOGOR BASKETBALL LEAGUE</div>

                    <div class="grid grid-cols-3 gap-4 text-center divide-x divide-slate-700">
                        <div>
                            <div class="text-2xl font-black text-white">6</div>
                            <div class="text-xs text-slate-500 font-bold mt-1 uppercase">Tim</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-orange-500">FIBA</div>
                            <div class="text-xs text-slate-500 font-bold mt-1 uppercase">Rules</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-white">100%</div>
                            <div class="text-xs text-slate-500 font-bold mt-1 uppercase">Stats</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: PERTANDINGAN TERDEKAT -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                Pertandingan Terdekat
            </h2>
        </div>
        <a href="{{ route('schedule.index') }}" class="text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
            Seluruh Jadwal &rarr;
        </a>
    </div>

    @if($upcomingMatches->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($upcomingMatches as $match)
                <div class="bg-white p-6 border border-slate-200 hover:border-orange-600 transition-colors flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold {{ $match->is_today ? 'bg-orange-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                                {{ $match->is_today ? 'HARI INI' : 'MENDATANG' }}
                            </span>
                            <div class="text-sm text-slate-500 font-bold">
                                {{ $match->formatted_date }} &bull; {{ $match->formatted_time }}
                            </div>
                        </div>

                        <!-- Teams Display -->
                        <div class="flex items-center justify-between my-4">
                            <!-- Team A -->
                            <div class="flex flex-col items-center w-1/3">
                                <img src="{{ $match->teamA->logo_url }}" alt="{{ $match->teamA->nama_tim }}" class="w-16 h-16 object-contain mb-3">
                                <div class="font-black text-slate-900 text-center leading-tight">{{ $match->teamA->nama_tim }}</div>
                            </div>

                            <!-- VS -->
                            <div class="w-1/3 text-center">
                                <span class="text-slate-300 font-black text-xl">VS</span>
                            </div>

                            <!-- Team B -->
                            <div class="flex flex-col items-center w-1/3">
                                <img src="{{ $match->teamB->logo_url }}" alt="{{ $match->teamB->nama_tim }}" class="w-16 h-16 object-contain mb-3">
                                <div class="font-black text-slate-900 text-center leading-tight">{{ $match->teamB->nama_tim }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location & Detail -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-sm">
                        <div class="text-slate-500 font-medium">
                            📍 {{ $match->lokasi }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-50 p-8 text-center border border-slate-200 text-slate-500 font-medium">
            Belum ada jadwal pertandingan terdekat saat ini.
        </div>
    @endif
</section>

<!-- SECTION 2: HASIL PERTANDINGAN TERBARU -->
<section class="bg-slate-100 border-y border-slate-200 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                    Hasil Pertandingan Terbaru
                </h2>
            </div>
            <a href="{{ route('result.index') }}" class="text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
                Semua Hasil &rarr;
            </a>
        </div>

        @if($recentResults->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($recentResults as $result)
                    <div class="bg-white p-6 border border-slate-200 flex flex-col hover:border-slate-400 transition-colors">
                        <div class="flex items-center justify-between text-sm text-slate-500 mb-6">
                            <span class="font-bold text-slate-900">FULL TIME</span>
                            <span>{{ $result->formatted_date }}</span>
                        </div>

                        <!-- Match Scores -->
                        <div class="flex items-center justify-between mb-6">
                            <!-- Team A -->
                            <div class="flex items-center gap-4 w-5/12">
                                <img src="{{ $result->teamA->logo_url }}" alt="{{ $result->teamA->nama_tim }}" class="w-12 h-12 object-contain">
                                <div class="font-black text-slate-900 {{ $result->skor_tim_a > $result->skor_tim_b ? 'text-orange-600' : '' }}">
                                    {{ $result->teamA->nama_tim }}
                                </div>
                            </div>

                            <!-- Score Center -->
                            <div class="w-2/12 text-center font-black text-2xl tracking-tight">
                                <span class="{{ $result->skor_tim_a > $result->skor_tim_b ? 'text-orange-600' : 'text-slate-900' }}">{{ $result->skor_tim_a }}</span>
                                <span class="text-slate-300">-</span>
                                <span class="{{ $result->skor_tim_b > $result->skor_tim_a ? 'text-orange-600' : 'text-slate-900' }}">{{ $result->skor_tim_b }}</span>
                            </div>

                            <!-- Team B -->
                            <div class="flex items-center justify-end gap-4 w-5/12 text-right">
                                <div class="font-black text-slate-900 {{ $result->skor_tim_b > $result->skor_tim_a ? 'text-orange-600' : '' }}">
                                    {{ $result->teamB->nama_tim }}
                                </div>
                                <img src="{{ $result->teamB->logo_url }}" alt="{{ $result->teamB->nama_tim }}" class="w-12 h-12 object-contain">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-center mt-auto">
                            <a href="{{ route('result.show', $result->id_match) }}" class="text-sm font-bold text-orange-600 hover:text-orange-700">
                                Lihat Box Score &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-8 text-center border border-slate-200 text-slate-500 font-medium">
                Belum ada hasil pertandingan yang selesai.
            </div>
        @endif
    </div>
</section>

<!-- SECTION 3: STATISTIK TERATAS -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                Statistik Pemain Teratas
            </h2>
        </div>
        <a href="{{ route('statistic.index') }}" class="text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
            Papan Peringkat Lengkap &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Top Scorer -->
        <div class="bg-white p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <span class="text-sm font-black text-slate-900 uppercase">Top Scorer</span>
                <span class="text-xs font-bold text-slate-400">PTS</span>
            </div>

            @if($topScorerStat && $topScorerStat->player)
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $topScorerStat->player->foto_url }}" alt="{{ $topScorerStat->player->nama }}" class="w-16 h-16 object-cover bg-slate-100">
                    <div>
                        <a href="{{ route('player.show', $topScorerStat->player->id_player) }}" class="font-black text-lg text-orange-600 hover:text-orange-700 block">
                            {{ $topScorerStat->player->nama }}
                        </a>
                        <p class="text-sm text-slate-500 font-medium">{{ $topScorerStat->player->team->nama_tim ?? 'Tim' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-end justify-between">
                    <div>
                        <div class="text-3xl font-black text-slate-900 leading-none">{{ $topScorerStat->total_stat }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">TOTAL POIN</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-black text-slate-900 leading-none">{{ $topScorerStat->gp > 0 ? round($topScorerStat->total_stat / $topScorerStat->gp, 1) : 0 }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">PPG</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Belum ada data.</div>
            @endif
        </div>

        <!-- Card 2: Top Assist -->
        <div class="bg-white p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <span class="text-sm font-black text-slate-900 uppercase">Top Assist</span>
                <span class="text-xs font-bold text-slate-400">AST</span>
            </div>

            @if($topAssistStat && $topAssistStat->player)
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $topAssistStat->player->foto_url }}" alt="{{ $topAssistStat->player->nama }}" class="w-16 h-16 object-cover bg-slate-100">
                    <div>
                        <a href="{{ route('player.show', $topAssistStat->player->id_player) }}" class="font-black text-lg text-orange-600 hover:text-orange-700 block">
                            {{ $topAssistStat->player->nama }}
                        </a>
                        <p class="text-sm text-slate-500 font-medium">{{ $topAssistStat->player->team->nama_tim ?? 'Tim' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-end justify-between">
                    <div>
                        <div class="text-3xl font-black text-slate-900 leading-none">{{ $topAssistStat->total_stat }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">TOTAL ASSIST</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-black text-slate-900 leading-none">{{ $topAssistStat->gp > 0 ? round($topAssistStat->total_stat / $topAssistStat->gp, 1) : 0 }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">APG</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Belum ada data.</div>
            @endif
        </div>

        <!-- Card 3: Top Rebound -->
        <div class="bg-white p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <span class="text-sm font-black text-slate-900 uppercase">Top Rebound</span>
                <span class="text-xs font-bold text-slate-400">REB</span>
            </div>

            @if($topReboundStat && $topReboundStat->player)
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $topReboundStat->player->foto_url }}" alt="{{ $topReboundStat->player->nama }}" class="w-16 h-16 object-cover bg-slate-100">
                    <div>
                        <a href="{{ route('player.show', $topReboundStat->player->id_player) }}" class="font-black text-lg text-orange-600 hover:text-orange-700 block">
                            {{ $topReboundStat->player->nama }}
                        </a>
                        <p class="text-sm text-slate-500 font-medium">{{ $topReboundStat->player->team->nama_tim ?? 'Tim' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-end justify-between">
                    <div>
                        <div class="text-3xl font-black text-slate-900 leading-none">{{ $topReboundStat->total_stat }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">TOTAL REB</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-black text-slate-900 leading-none">{{ $topReboundStat->gp > 0 ? round($topReboundStat->total_stat / $topReboundStat->gp, 1) : 0 }}</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">RPG</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Belum ada data.</div>
            @endif
        </div>
    </div>
</section>
@endsection
