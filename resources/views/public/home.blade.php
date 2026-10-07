@extends('layouts.app')

@section('title', 'Wikrama Cup Basketball — Turnamen & Statistik Basket Wikrama')

@section('content')
<div class="space-y-16 sm:space-y-24">

    <!-- ========================================================================= -->
    <!-- HERO SECTION -->
    <!-- ========================================================================= -->
    <section class="relative py-12 sm:py-20 border-b border-slate-200/80 bg-white overflow-hidden">
        <!-- Abstract Blurred Circles Background (Samain persis design) -->
        <div class="absolute -top-16 left-1/4 w-[480px] h-[480px] rounded-full bg-orange-300/40 blur-[110px] pointer-events-none"></div>
        <div class="absolute top-10 right-10 w-[400px] h-[400px] rounded-full bg-cyan-200/45 blur-[100px] pointer-events-none"></div>
        <div class="absolute -bottom-10 left-10 w-[360px] h-[360px] rounded-full bg-emerald-200/35 blur-[90px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Text & Actions -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/80 text-orange-600 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        Turnamen Basket Resmi SMK Wikrama Bogor
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-[#0B132B] leading-[1.1]">
                        Wikrama Cup <span class="text-[#00A7B5]" style="color: #00A7B5 !important;">Basketball</span>
                    </h1>

                    <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Informasi pertandingan dan statistik Wikrama dalam satu website. Pantau jadwal tim, hasil skor langsung, profil pemain, serta performa statistik turnamen terlengkap.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
                        <a href="{{ route('schedule.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3.5 rounded-full font-extrabold text-xs sm:text-sm text-white shadow-lg shadow-orange-600/30 transition-all duration-200 transform hover:-translate-y-0.5 hover:opacity-90"
                           style="background: linear-gradient(135deg, #EA580C, #F97316) !important; color: #FFFFFF !important;">
                            Lihat Jadwal
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>

                        <a href="{{ route('statistic.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3.5 rounded-full font-extrabold text-xs sm:text-sm text-slate-800 bg-white border border-slate-300 hover:bg-slate-50 hover:border-slate-400 shadow-sm transition-all duration-200 transform hover:-translate-y-0.5"
                           style="background-color: #FFFFFF !important; color: #0F172A !important;">
                            Lihat Statistik
                        </a>
                    </div>

                    <!-- Micro Tagline -->
                    <div class="flex items-center justify-center lg:justify-start gap-3 text-xs font-extrabold tracking-widest pt-3">
                        <span class="text-orange-500 font-black">MATCH</span>
                        <span class="text-slate-400">—</span>
                        <span class="text-cyan-500 font-black">PLAYER</span>
                        <span class="text-slate-400">—</span>
                        <span class="text-slate-500 font-black">STATISTIK</span>
                    </div>
                </div>

                <!-- Right Dark Hero Championship Card -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end">
                    <div class="w-full max-w-md p-8 rounded-3xl shadow-2xl relative overflow-hidden text-white"
                         style="background-color: #0F172A !important; color: #FFFFFF !important; border: 1px solid #1E293B !important;">
                        
                        <!-- Top Live Badge & Ball Icon -->
                        <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-800">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border text-orange-400 text-[11px] font-extrabold uppercase tracking-wider"
                                 style="background-color: #1E293B !important; border-color: rgba(249, 115, 22, 0.4) !important;">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-ping"></span>
                                LIVE CHAMPIONSHIP
                            </div>
                            <span class="text-xl">🏀</span>
                        </div>

                        <!-- Brand Emblem -->
                        <div class="text-center py-4 space-y-3">
                            <div class="p-2 inline-block">
                                <img src="{{ asset('images/logo-wikcup.png') }}" alt="WikCup Logo" class="h-20 w-auto mx-auto object-contain drop-shadow-lg">
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-white tracking-tight" style="color: #FFFFFF !important;">SMK WIKRAMA</h3>
                                <p class="text-xs font-extrabold uppercase tracking-widest mt-0.5" style="color: #00A7B5 !important;">BOGOR BASKETBALL LEAGUE</p>
                            </div>
                        </div>

                        <!-- 3 Stat Badges Grid -->
                        <div class="grid grid-cols-3 gap-2.5 pt-6 mt-4 border-t border-slate-800 text-center">
                            <div class="rounded-2xl p-3" style="background-color: #1E293B !important; border: 1px solid #334155 !important;">
                                <div class="text-xl font-black text-white" style="color: #FFFFFF !important;">{{ $teamCount ?? 8 }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">TIM</div>
                            </div>
                            <div class="rounded-2xl p-3" style="background-color: #1E293B !important; border: 1px solid #334155 !important;">
                                <div class="text-xl font-black text-[#00A7B5]" style="color: #00A7B5 !important;">FIBA</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">RULES</div>
                            </div>
                            <div class="rounded-2xl p-3" style="background-color: #1E293B !important; border: 1px solid #334155 !important;">
                                <div class="text-xl font-black text-orange-400" style="color: #F97316 !important;">100%</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">STATS</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================================= -->
    <!-- SECTION 1: PERTANDINGAN TERDEKAT -->
    <!-- ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 pb-3 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-1.5 h-6 bg-[#EA580C] rounded-full inline-block" style="background-color: #EA580C !important;"></span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#0B132B] tracking-tight">Pertandingan Terdekat</h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 pl-4">Jadwal pertandingan selanjutnya di arena SMK Wikrama</p>
            </div>

            <a href="{{ route('schedule.index') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-bold text-[#EA580C] hover:text-orange-500 transition">
                Seluruh Jadwal &rsaquo;
            </a>
        </div>

        @if($upcomingMatches->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($upcomingMatches as $m)
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/90 hover:border-orange-300 shadow-sm transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <!-- Badge & Date -->
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider {{ $m->is_today ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                    {{ $m->is_today ? 'HARI INI' : 'MENDATANG' }}
                                </span>
                                <span class="text-xs font-semibold text-slate-500">
                                    📅 {{ $m->formatted_date }} • {{ $m->formatted_time }}
                                </span>
                            </div>

                            <!-- Teams Face-Off -->
                            <div class="grid grid-cols-7 items-center py-6 gap-2">
                                <!-- Team A -->
                                <div class="col-span-3 flex flex-col items-center text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-[#0F172A] text-white flex items-center justify-center font-black text-base shadow-sm mb-2 overflow-hidden"
                                         style="background-color: #0F172A !important; color: #FFFFFF !important;">
                                        @if($m->teamA->logo_url)
                                            <img src="{{ $m->teamA->logo_url }}" alt="" class="w-full h-full object-contain p-1">
                                        @else
                                            {{ strtoupper(substr($m->teamA->nama_tim, 0, 2)) }}
                                        @endif
                                    </div>
                                    <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm line-clamp-2">{{ $m->teamA->nama_tim }}</h4>
                                </div>

                                <!-- VS -->
                                <div class="col-span-1 flex justify-center">
                                    <span class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-black border border-slate-200">
                                        VS
                                    </span>
                                </div>

                                <!-- Team B -->
                                <div class="col-span-3 flex flex-col items-center text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-[#00A7B5] text-white flex items-center justify-center font-black text-base shadow-sm mb-2 overflow-hidden"
                                         style="background-color: #00A7B5 !important; color: #FFFFFF !important;">
                                        @if($m->teamB->logo_url)
                                            <img src="{{ $m->teamB->logo_url }}" alt="" class="w-full h-full object-contain p-1">
                                        @else
                                            {{ strtoupper(substr($m->teamB->nama_tim, 0, 2)) }}
                                        @endif
                                    </div>
                                    <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm line-clamp-2">{{ $m->teamB->nama_tim }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-medium">📍 {{ $m->lokasi }}</span>
                            <a href="{{ route('schedule.index') }}" class="font-bold text-[#EA580C] hover:text-orange-500">
                                Detail Jadwal &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 text-slate-400 font-medium shadow-sm">
                Belum ada jadwal pertandingan mendatang.
            </div>
        @endif

    </section>


    <!-- ========================================================================= -->
    <!-- SECTION 2: HASIL PERTANDINGAN TERBARU -->
    <!-- ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 pb-3 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-1.5 h-6 bg-[#00A7B5] rounded-full inline-block" style="background-color: #00A7B5 !important;"></span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#0B132B] tracking-tight">Hasil Pertandingan Terbaru</h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 pl-4">Skor akhir laga yang baru saja selesai</p>
            </div>

            <a href="{{ route('result.index') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-bold text-[#00A7B5] hover:text-teal-600 transition">
                Semua Hasil &rsaquo;
            </a>
        </div>

        @if($recentResults->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($recentResults as $r)
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/90 hover:border-cyan-300 shadow-sm transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <!-- Badge & Date -->
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-700 border border-slate-200">
                                    FINAL SCORE
                                </span>
                                <span class="text-xs font-semibold text-slate-500">
                                    {{ $r->formatted_date }} • {{ $r->lokasi }}
                                </span>
                            </div>

                            <!-- Teams Face-Off with Scores -->
                            <div class="grid grid-cols-7 items-center py-6 gap-2">
                                <!-- Team A -->
                                <div class="col-span-2 flex flex-col items-center text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-[#0F172A] text-white flex items-center justify-center font-black text-base shadow-sm mb-2 overflow-hidden"
                                         style="background-color: #0F172A !important; color: #FFFFFF !important;">
                                        @if($r->teamA->logo_url)
                                            <img src="{{ $r->teamA->logo_url }}" alt="" class="w-full h-full object-contain p-1">
                                        @else
                                            {{ strtoupper(substr($r->teamA->nama_tim, 0, 2)) }}
                                        @endif
                                    </div>
                                    <h4 class="font-extrabold text-slate-900 text-xs line-clamp-1">{{ $r->teamA->nama_tim }}</h4>
                                    @if($r->skor_tim_a > $r->skor_tim_b)
                                        <span class="mt-1 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">WINNER</span>
                                    @endif
                                </div>

                                <!-- Score in Center -->
                                <div class="col-span-3 flex items-center justify-center gap-3 text-center">
                                    <span class="text-3xl sm:text-4xl font-black" style="color: {{ $r->skor_tim_a >= $r->skor_tim_b ? '#EA580C' : '#0B132B' }} !important;">
                                        {{ $r->skor_tim_a ?? 0 }}
                                    </span>
                                    <span class="text-slate-300 text-2xl font-bold">-</span>
                                    <span class="text-3xl sm:text-4xl font-black" style="color: {{ $r->skor_tim_b >= $r->skor_tim_a ? '#EA580C' : '#0B132B' }} !important;">
                                        {{ $r->skor_tim_b ?? 0 }}
                                    </span>
                                </div>

                                <!-- Team B -->
                                <div class="col-span-2 flex flex-col items-center text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-[#EA580C] text-white flex items-center justify-center font-black text-base shadow-sm mb-2 overflow-hidden"
                                         style="background-color: #EA580C !important; color: #FFFFFF !important;">
                                        @if($r->teamB->logo_url)
                                            <img src="{{ $r->teamB->logo_url }}" alt="" class="w-full h-full object-contain p-1">
                                        @else
                                            {{ strtoupper(substr($r->teamB->nama_tim, 0, 2)) }}
                                        @endif
                                    </div>
                                    <h4 class="font-extrabold text-slate-900 text-xs line-clamp-1">{{ $r->teamB->nama_tim }}</h4>
                                    @if($r->skor_tim_b > $r->skor_tim_a)
                                        <span class="mt-1 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">WINNER</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-center text-xs">
                            <a href="{{ route('result.show', $r->id_match) }}" class="font-bold text-[#00A7B5] hover:text-teal-600 flex items-center gap-1">
                                Lihat Statistik Pertandingan &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 text-slate-400 font-medium shadow-sm">
                Belum ada hasil pertandingan yang selesai.
            </div>
        @endif

    </section>


    <!-- ========================================================================= -->
    <!-- SECTION 3: STATISTIK TERATAS (DARK NAVY CARDS) -->
    <!-- ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 pb-3 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-1.5 h-6 bg-[#EA580C] rounded-full inline-block" style="background-color: #EA580C !important;"></span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#0B132B] tracking-tight">Statistik Teratas</h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 pl-4">Para pemimpin statistik individu turnamen WikCup</p>
            </div>

            <a href="{{ route('statistic.index') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-bold text-[#EA580C] hover:text-orange-500 transition">
                Papan Peringkat Lengkap &rsaquo;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- CARD 1: TOP SCORER -->
            <div class="rounded-3xl p-6 text-white border shadow-xl flex flex-col justify-between"
                 style="background-color: #0F172A !important; color: #FFFFFF !important; border: 1px solid #1E293B !important;">
                <div>
                    <!-- Header Pill -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-orange-500/10 text-orange-400 border border-orange-500/30">
                            🔥 TOP SCORER
                        </span>
                        <span class="text-xs text-slate-400 font-bold">Poin</span>
                    </div>

                    <!-- Player Info -->
                    <div class="flex items-center gap-3.5 my-5">
                        <div class="w-12 h-12 rounded-2xl bg-slate-800 text-orange-400 border border-slate-700 flex items-center justify-center font-black text-sm shrink-0"
                             style="background-color: #1E293B !important; color: #F97316 !important;">
                            {{ $topScorerStat ? strtoupper(substr($topScorerStat->player->nama ?? 'RP', 0, 2)) : 'RP' }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-white text-sm sm:text-base leading-snug" style="color: #FFFFFF !important;">
                                {{ $topScorerStat->player->nama ?? 'Rizky Pratama' }}
                            </h4>
                            <p class="text-xs text-slate-400 font-normal">
                                {{ $topScorerStat->player->team->nama_tim ?? 'SMK Wikrama Thunder' }} #{{ $topScorerStat->player->no_punggung ?? '07' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stat Footer -->
                <div class="grid grid-cols-2 gap-2 pt-4 border-t border-slate-800 text-left">
                    <div>
                        <div class="text-xl font-black text-orange-400" style="color: #F97316 !important;">
                            {{ $topScorerStat->total_stat ?? 52 }} <span class="text-xs text-slate-400 font-semibold">PTS</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">TOTAL AKUMULASI</div>
                    </div>
                    <div>
                        <div class="text-xl font-black text-white" style="color: #FFFFFF !important;">
                            {{ $topScorerStat ? round($topScorerStat->total_stat / max($topScorerStat->gp, 1), 1) : 26 }} <span class="text-xs text-slate-400 font-semibold">PPG</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">RATA-RATA / GAME</div>
                    </div>
                </div>
            </div>

            <!-- CARD 2: TOP ASSIST -->
            <div class="rounded-3xl p-6 text-white border shadow-xl flex flex-col justify-between"
                 style="background-color: #0F172A !important; color: #FFFFFF !important; border: 1px solid #1E293B !important;">
                <div>
                    <!-- Header Pill -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/30">
                            ⚡ TOP ASSIST
                        </span>
                        <span class="text-xs text-slate-400 font-bold">Assists</span>
                    </div>

                    <!-- Player Info -->
                    <div class="flex items-center gap-3.5 my-5">
                        <div class="w-12 h-12 rounded-2xl bg-slate-800 text-cyan-400 border border-slate-700 flex items-center justify-center font-black text-sm shrink-0"
                             style="background-color: #1E293B !important; color: #00A7B5 !important;">
                            {{ $topAssistStat ? strtoupper(substr($topAssistStat->player->nama ?? 'DS', 0, 2)) : 'DS' }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-white text-sm sm:text-base leading-snug" style="color: #FFFFFF !important;">
                                {{ $topAssistStat->player->nama ?? 'Dimas Saputra' }}
                            </h4>
                            <p class="text-xs text-slate-400 font-normal">
                                {{ $topAssistStat->player->team->nama_tim ?? 'SMK Wikrama Thunder' }} #{{ $topAssistStat->player->no_punggung ?? '11' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stat Footer -->
                <div class="grid grid-cols-2 gap-2 pt-4 border-t border-slate-800 text-left">
                    <div>
                        <div class="text-xl font-black text-cyan-400" style="color: #00A7B5 !important;">
                            {{ $topAssistStat->total_stat ?? 17 }} <span class="text-xs text-slate-400 font-semibold">AST</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">TOTAL AKUMULASI</div>
                    </div>
                    <div>
                        <div class="text-xl font-black text-white" style="color: #FFFFFF !important;">
                            {{ $topAssistStat ? round($topAssistStat->total_stat / max($topAssistStat->gp, 1), 1) : 8.5 }} <span class="text-xs text-slate-400 font-semibold">APG</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">RATA-RATA / GAME</div>
                    </div>
                </div>
            </div>

            <!-- CARD 3: TOP REBOUND -->
            <div class="rounded-3xl p-6 text-white border shadow-xl flex flex-col justify-between"
                 style="background-color: #0F172A !important; color: #FFFFFF !important; border: 1px solid #1E293B !important;">
                <div>
                    <!-- Header Pill -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                            🛡️ TOP REBOUND
                        </span>
                        <span class="text-xs text-slate-400 font-bold">Rebounds</span>
                    </div>

                    <!-- Player Info -->
                    <div class="flex items-center gap-3.5 my-5">
                        <div class="w-12 h-12 rounded-2xl bg-slate-800 text-emerald-400 border border-slate-700 flex items-center justify-center font-black text-sm shrink-0"
                             style="background-color: #1E293B !important; color: #10B981 !important;">
                            {{ $topReboundStat ? strtoupper(substr($topReboundStat->player->nama ?? 'BT', 0, 2)) : 'BT' }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-white text-sm sm:text-base leading-snug" style="color: #FFFFFF !important;">
                                {{ $topReboundStat->player->nama ?? 'Bagas Triadi' }}
                            </h4>
                            <p class="text-xs text-slate-400 font-normal">
                                {{ $topReboundStat->player->team->nama_tim ?? 'SMK Wikrama Hawks' }} #{{ $topReboundStat->player->no_punggung ?? '33' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stat Footer -->
                <div class="grid grid-cols-2 gap-2 pt-4 border-t border-slate-800 text-left">
                    <div>
                        <div class="text-xl font-black text-emerald-400" style="color: #10B981 !important;">
                            {{ $topReboundStat->total_stat ?? 16 }} <span class="text-xs text-slate-400 font-semibold">REB</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">TOTAL AKUMULASI</div>
                    </div>
                    <div>
                        <div class="text-xl font-black text-white" style="color: #FFFFFF !important;">
                            {{ $topReboundStat ? round($topReboundStat->total_stat / max($topReboundStat->gp, 1), 1) : 16 }} <span class="text-xs text-slate-400 font-semibold">RPG</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider font-bold">RATA-RATA / GAME</div>
                    </div>
                </div>
            </div>

        </div>

    </section>

</div>
@endsection
