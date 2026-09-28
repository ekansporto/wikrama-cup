@extends('layouts.app')

@section('title', 'Wikrama Cup Basketball — Turnamen & Statistik Basket Wikrama')

@section('content')
<!-- HERO SECTION -->
<section class="relative bg-gradient-to-b from-white via-orange-50/20 to-[#F8FAFC] overflow-hidden border-b border-slate-200/80 py-16 sm:py-24">
    <!-- Ambient glow decorations -->
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-orange-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -left-32 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Text Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs sm:text-sm font-bold tracking-wide shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#FF5722] animate-pulse"></span>
                    Turnamen Basket Resmi SMK Wikrama Bogor
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-[#0B132B] leading-[1.15]">
                    Wikrama Cup <span class="bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 bg-clip-text text-transparent">Basketball</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Informasi pertandingan dan statistik Wikrama dalam satu website. Pantau jadwal tim, hasil skor langsung, profil pemain, serta performa statistik turnamen terlengkap.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
                    <a href="{{ route('schedule.index') }}" class="inline-flex items-center justify-center px-7 py-3.5 rounded-2xl font-bold text-sm sm:text-base text-white bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 hover:from-orange-500 hover:to-amber-400 shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition duration-200 group">
                        Lihat Jadwal
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('statistic.index') }}" class="inline-flex items-center justify-center px-7 py-3.5 rounded-2xl font-bold text-sm sm:text-base text-slate-800 bg-white hover:bg-slate-50 border border-slate-200 shadow-sm hover:shadow transition duration-200">
                        Lihat Statistik
                    </a>
                </div>

                <!-- Match -> Player -> Stats indicator -->
                <div class="pt-6 border-t border-slate-200/80 flex items-center justify-center lg:justify-start gap-3 text-xs font-extrabold text-slate-400">
                    <span class="text-orange-600">MATCH</span>
                    <span>→</span>
                    <span class="text-amber-500">PLAYER</span>
                    <span>→</span>
                    <span class="text-cyan-600">STATISTICS</span>
                </div>
            </div>

            <!-- Basketball Visual Card Widget -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-80 sm:w-96">
                    <!-- Glow behind card -->
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-orange-500 to-cyan-500 opacity-20 blur-xl"></div>
                    
                    <div class="relative rounded-3xl bg-[#0B132B] text-white p-7 border border-[#1E2D5A] shadow-2xl space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-orange-500/20 text-orange-400 text-xs font-extrabold uppercase tracking-wider border border-orange-500/30">
                                <span class="w-2 h-2 rounded-full bg-[#FF5722] animate-pulse"></span>
                                Live Championship
                            </div>
                            <span class="text-3xl">🏀</span>
                        </div>

                        <div class="text-center py-2 space-y-1">
                            <div class="text-2xl font-black tracking-wide text-white">SMK WIKRAMA</div>
                            <div class="text-xs text-orange-400 font-bold tracking-wider">BOGOR BASKETBALL LEAGUE</div>
                        </div>

                        <div class="grid grid-cols-3 gap-2.5 text-center bg-[#111C38] rounded-2xl p-4 border border-[#1E2D5A]">
                            <div>
                                <div class="text-xl font-black text-white">6</div>
                                <div class="text-[10px] text-slate-400 uppercase font-bold mt-0.5">Tim</div>
                            </div>
                            <div class="border-x border-[#1E2D5A]">
                                <div class="text-xl font-black text-orange-400">FIBA</div>
                                <div class="text-[10px] text-slate-400 uppercase font-bold mt-0.5">Rules</div>
                            </div>
                            <div>
                                <div class="text-xl font-black text-cyan-400">100%</div>
                                <div class="text-[10px] text-slate-400 uppercase font-bold mt-0.5">Stats</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: PERTANDINGAN TERDEKAT -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black text-[#0B132B] tracking-tight flex items-center gap-2.5">
                <span class="w-2.5 h-7 bg-[#FF5722] rounded-full inline-block"></span>
                Pertandingan Terdekat
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Jadwal pertandingan selanjutnya di arena SMK Wikrama</p>
        </div>
        <a href="{{ route('schedule.index') }}" class="text-xs sm:text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group bg-orange-50 hover:bg-orange-100 px-3.5 py-2 rounded-xl transition">
            Seluruh Jadwal
            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if($upcomingMatches->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($upcomingMatches as $match)
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-orange-200 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4 pb-3.5 border-b border-slate-100">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold {{ $match->is_today ? 'bg-rose-100 text-rose-700 animate-pulse' : 'bg-orange-50 text-orange-700 border border-orange-200/60' }}">
                                {{ $match->is_today ? '🔥 Hari Ini' : '📅 Mendatang' }}
                            </span>
                            <div class="text-xs text-slate-500 font-bold flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $match->formatted_date }} • {{ $match->formatted_time }}
                            </div>
                        </div>

                        <!-- Teams Display -->
                        <div class="grid grid-cols-5 items-center my-5">
                            <!-- Team A -->
                            <div class="col-span-2 text-center space-y-2">
                                <img src="{{ $match->teamA->logo_url }}" alt="{{ $match->teamA->nama_tim }}" class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl object-cover shadow-sm bg-slate-50 border border-slate-200">
                                <div class="font-extrabold text-[#0B132B] text-sm sm:text-base leading-tight">{{ $match->teamA->nama_tim }}</div>
                            </div>

                            <!-- VS Badge -->
                            <div class="col-span-1 text-center">
                                <span class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 inline-flex items-center justify-center font-black text-xs text-[#FF5722] shadow-inner">
                                    VS
                                </span>
                            </div>

                            <!-- Team B -->
                            <div class="col-span-2 text-center space-y-2">
                                <img src="{{ $match->teamB->logo_url }}" alt="{{ $match->teamB->nama_tim }}" class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl object-cover shadow-sm bg-slate-50 border border-slate-200">
                                <div class="font-extrabold text-[#0B132B] text-sm sm:text-base leading-tight">{{ $match->teamB->nama_tim }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location & Detail -->
                    <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <div class="flex items-center gap-1.5 truncate">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate font-medium">{{ $match->lokasi }}</span>
                        </div>
                        <a href="{{ route('schedule.index') }}" class="font-bold text-orange-600 hover:text-orange-700 whitespace-nowrap">Detail Jadwal →</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 text-slate-500">
            Belum ada jadwal pertandingan terdekat saat ini.
        </div>
    @endif
</section>

<!-- SECTION 2: HASIL PERTANDINGAN TERBARU -->
<section class="bg-slate-100/60 border-y border-slate-200/80 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-[#0B132B] tracking-tight flex items-center gap-2.5">
                    <span class="w-2.5 h-7 bg-[#0B132B] rounded-full inline-block"></span>
                    Hasil Pertandingan Terbaru
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Skor akhir laga yang baru saja selesai dipertandingkan</p>
            </div>
            <a href="{{ route('result.index') }}" class="text-xs sm:text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group bg-white hover:bg-orange-50 px-3.5 py-2 rounded-xl border border-slate-200 transition">
                Semua Hasil
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if($recentResults->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($recentResults as $result)
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition">
                        <div class="flex items-center justify-between text-xs text-slate-500 pb-3.5 border-b border-slate-100">
                            <span class="font-extrabold px-3 py-1 rounded-full bg-slate-100 text-slate-700 uppercase tracking-wider text-[11px]">
                                Full Time
                            </span>
                            <span class="font-medium">{{ $result->formatted_date }} • {{ $result->lokasi }}</span>
                        </div>

                        <!-- Match Scores -->
                        <div class="grid grid-cols-7 items-center my-6">
                            <!-- Team A -->
                            <div class="col-span-3 flex items-center gap-3">
                                <img src="{{ $result->teamA->logo_url }}" alt="{{ $result->teamA->nama_tim }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover border border-slate-200 flex-shrink-0 bg-slate-50">
                                <div>
                                    <div class="font-extrabold text-[#0B132B] text-sm sm:text-base leading-tight {{ $result->skor_tim_a > $result->skor_tim_b ? 'text-[#FF5722] font-black' : '' }}">
                                        {{ $result->teamA->nama_tim }}
                                    </div>
                                    @if($result->skor_tim_a > $result->skor_tim_b)
                                        <span class="inline-block mt-0.5 text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md uppercase tracking-wider border border-emerald-200">Winner</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Score Center -->
                            <div class="col-span-1 text-center font-black text-2xl sm:text-3xl tracking-tight">
                                <span class="{{ $result->skor_tim_a > $result->skor_tim_b ? 'text-[#FF5722]' : 'text-slate-700' }}">{{ $result->skor_tim_a }}</span>
                                <span class="text-slate-300 mx-0.5">-</span>
                                <span class="{{ $result->skor_tim_b > $result->skor_tim_a ? 'text-[#FF5722]' : 'text-slate-700' }}">{{ $result->skor_tim_b }}</span>
                            </div>

                            <!-- Team B -->
                            <div class="col-span-3 flex items-center justify-end gap-3 text-right">
                                <div>
                                    <div class="font-extrabold text-[#0B132B] text-sm sm:text-base leading-tight {{ $result->skor_tim_b > $result->skor_tim_a ? 'text-[#FF5722] font-black' : '' }}">
                                        {{ $result->teamB->nama_tim }}
                                    </div>
                                    @if($result->skor_tim_b > $result->skor_tim_a)
                                        <span class="inline-block mt-0.5 text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md uppercase tracking-wider border border-emerald-200">Winner</span>
                                    @endif
                                </div>
                                <img src="{{ $result->teamB->logo_url }}" alt="{{ $result->teamB->nama_tim }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover border border-slate-200 flex-shrink-0 bg-slate-50">
                            </div>
                        </div>

                        <!-- Button to Box Score -->
                        <div class="pt-3.5 border-t border-slate-100 flex justify-end">
                            <a href="{{ route('result.show', $result->id_match) }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold text-[#0B132B] bg-slate-100 hover:bg-[#FF5722] hover:text-white transition group shadow-sm">
                                Lihat Statistik Pertandingan
                                <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 text-slate-500">
                Belum ada hasil pertandingan yang selesai.
            </div>
        @endif
    </div>
</section>

<!-- SECTION 3: STATISTIK TERATAS -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black text-[#0B132B] tracking-tight flex items-center gap-2.5">
                <span class="w-2.5 h-7 bg-amber-500 rounded-full inline-block"></span>
                Statistik Teratas
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Para pemimpin statistik individu turnamen WikCup Basketball</p>
        </div>
        <a href="{{ route('statistic.index') }}" class="text-xs sm:text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group bg-orange-50 hover:bg-orange-100 px-3.5 py-2 rounded-xl transition">
            Papan Peringkat Lengkap
            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Top Scorer -->
        <div class="bg-[#0B132B] text-white rounded-3xl p-6 sm:p-7 border border-[#1E2D5A] shadow-xl relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="px-3 py-1 rounded-xl bg-orange-500/20 text-orange-400 font-extrabold text-xs uppercase tracking-wider border border-orange-500/30">
                    🔥 Top Scorer
                </span>
                <span class="text-xs text-slate-400 font-semibold uppercase">Points</span>
            </div>

            @if($topScorerStat && $topScorerStat->player)
                <div class="flex items-center gap-4 my-3">
                    <img src="{{ $topScorerStat->player->foto_url }}" alt="{{ $topScorerStat->player->nama }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-[#FF5722] bg-slate-800 shadow-md">
                    <div>
                        <a href="{{ route('player.show', $topScorerStat->player->id_player) }}" class="font-black text-lg text-white hover:text-orange-400 transition block">
                            {{ $topScorerStat->player->nama }}
                        </a>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">{{ $topScorerStat->player->team->nama_tim ?? 'WikCup Team' }} • #{{ $topScorerStat->player->no_punggung }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-[#1E2D5A] flex items-baseline justify-between">
                    <div>
                        <div class="text-3xl font-black text-orange-400">{{ $topScorerStat->total_stat }} <span class="text-sm font-bold text-slate-300">PTS</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Total Poin Turnamen</div>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-black text-white">{{ $topScorerStat->gp > 0 ? round($topScorerStat->total_stat / $topScorerStat->gp, 1) : 0 }} <span class="text-xs text-slate-400 font-medium">PPG</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Rata-rata / Game</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Data statistik belum tersedia.</div>
            @endif
        </div>

        <!-- Card 2: Top Assist -->
        <div class="bg-[#0B132B] text-white rounded-3xl p-6 sm:p-7 border border-[#1E2D5A] shadow-xl relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="px-3 py-1 rounded-xl bg-amber-500/20 text-amber-400 font-extrabold text-xs uppercase tracking-wider border border-amber-500/30">
                    🎯 Top Assist
                </span>
                <span class="text-xs text-slate-400 font-semibold uppercase">Assists</span>
            </div>

            @if($topAssistStat && $topAssistStat->player)
                <div class="flex items-center gap-4 my-3">
                    <img src="{{ $topAssistStat->player->foto_url }}" alt="{{ $topAssistStat->player->nama }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-amber-500 bg-slate-800 shadow-md">
                    <div>
                        <a href="{{ route('player.show', $topAssistStat->player->id_player) }}" class="font-black text-lg text-white hover:text-amber-400 transition block">
                            {{ $topAssistStat->player->nama }}
                        </a>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">{{ $topAssistStat->player->team->nama_tim ?? 'WikCup Team' }} • #{{ $topAssistStat->player->no_punggung }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-[#1E2D5A] flex items-baseline justify-between">
                    <div>
                        <div class="text-3xl font-black text-amber-400">{{ $topAssistStat->total_stat }} <span class="text-sm font-bold text-slate-300">AST</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Total Assist Turnamen</div>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-black text-white">{{ $topAssistStat->gp > 0 ? round($topAssistStat->total_stat / $topAssistStat->gp, 1) : 0 }} <span class="text-xs text-slate-400 font-medium">APG</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Rata-rata / Game</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Data statistik belum tersedia.</div>
            @endif
        </div>

        <!-- Card 3: Top Rebound -->
        <div class="bg-[#0B132B] text-white rounded-3xl p-6 sm:p-7 border border-[#1E2D5A] shadow-xl relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="px-3 py-1 rounded-xl bg-cyan-500/20 text-cyan-400 font-extrabold text-xs uppercase tracking-wider border border-cyan-500/30">
                    🛡️ Top Rebound
                </span>
                <span class="text-xs text-slate-400 font-semibold uppercase">Rebounds</span>
            </div>

            @if($topReboundStat && $topReboundStat->player)
                <div class="flex items-center gap-4 my-3">
                    <img src="{{ $topReboundStat->player->foto_url }}" alt="{{ $topReboundStat->player->nama }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-cyan-400 bg-slate-800 shadow-md">
                    <div>
                        <a href="{{ route('player.show', $topReboundStat->player->id_player) }}" class="font-black text-lg text-white hover:text-cyan-400 transition block">
                            {{ $topReboundStat->player->nama }}
                        </a>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">{{ $topReboundStat->player->team->nama_tim ?? 'WikCup Team' }} • #{{ $topReboundStat->player->no_punggung }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-[#1E2D5A] flex items-baseline justify-between">
                    <div>
                        <div class="text-3xl font-black text-cyan-400">{{ $topReboundStat->total_stat }} <span class="text-sm font-bold text-slate-300">REB</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Total Rebound Turnamen</div>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-black text-white">{{ $topReboundStat->gp > 0 ? round($topReboundStat->total_stat / $topReboundStat->gp, 1) : 0 }} <span class="text-xs text-slate-400 font-medium">RPG</span></div>
                        <div class="text-[11px] text-slate-400 font-medium">Rata-rata / Game</div>
                    </div>
                </div>
            @else
                <div class="text-sm text-slate-400 py-8 text-center">Data statistik belum tersedia.</div>
            @endif
        </div>
    </div>
</section>
@endsection

