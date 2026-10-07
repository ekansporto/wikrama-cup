@extends('layouts.app')

@section('title', 'Jadwal Pertandingan — WIKCUP Basketball')

@section('content')
<!-- Page Header Banner -->
<div class="relative py-14 border-b border-slate-200/80 bg-white overflow-hidden">
    <!-- Abstract Blurred Circles Background (Samain persis design) -->
    <div class="absolute -top-16 left-1/4 w-[420px] h-[420px] rounded-full bg-orange-300/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute top-0 right-10 w-[380px] h-[380px] rounded-full bg-cyan-200/40 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-10 left-10 w-[320px] h-[320px] rounded-full bg-emerald-200/30 blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/70 text-orange-600 text-xs font-bold mb-3 uppercase tracking-wider shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#EA580C] animate-pulse"></span>
            Turnamen Basket Resmi SMK Wikrama Bogor
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B]">Jadwal Pertandingan</h1>
        <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl font-normal">Seluruh jadwal pertandingan turnamen basket SMK Wikrama Bogor. Pantau jadwal tim favorit, dukung jagoanmu, dan jangan lewatkan setiap laga serunya.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2 bg-white p-2 rounded-2xl border border-slate-200/90 shadow-sm max-w-md">
        <a href="{{ route('schedule.index', ['filter' => 'semua']) }}" 
           class="flex-1 text-center py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition {{ $filter === 'semua' ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
            Semua
        </a>
        <a href="{{ route('schedule.index', ['filter' => 'mendatang']) }}" 
           class="flex-1 text-center py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition {{ $filter === 'mendatang' ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
            Mendatang
        </a>
        <a href="{{ route('schedule.index', ['filter' => 'hari_ini']) }}" 
           class="flex-1 text-center py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition {{ $filter === 'hari_ini' ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
            Hari Ini
        </a>
    </div>

    <!-- Match Cards Grid -->
    @if($matches->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($matches as $match)
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-orange-200 transition flex flex-col justify-between">
                    <div>
                        <!-- Header Status & Time -->
                        <div class="flex items-center justify-between pb-3.5 mb-5 border-b border-slate-100 text-xs">
                            <span class="inline-flex items-center px-3 py-1 rounded-full font-extrabold {{ $match->is_today ? 'bg-rose-100 text-rose-700 animate-pulse' : 'bg-orange-50 text-orange-700 border border-orange-200/60' }}">
                                {{ $match->is_today ? '🔥 Hari Ini' : '📅 Mendatang' }}
                            </span>
                            <span class="text-slate-500 font-bold">
                                {{ $match->formatted_date }}
                            </span>
                        </div>

                        <!-- Match Teams Display -->
                        <div class="grid grid-cols-5 items-center my-4">
                            <!-- Team A -->
                            <div class="col-span-2 text-center space-y-2">
                                <img src="{{ $match->teamA->logo_url }}" alt="{{ $match->teamA->nama_tim }}" class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl object-contain shadow-sm bg-slate-50 border border-slate-200">
                                <a href="{{ route('team.show', $match->teamA->id_team) }}" class="font-black text-[#0B132B] text-sm hover:text-orange-600 transition line-clamp-1 block">
                                    {{ $match->teamA->nama_tim }}
                                </a>
                            </div>

                            <!-- VS Badge -->
                            <div class="col-span-1 text-center">
                                <span class="w-9 h-9 rounded-full bg-slate-100 border border-slate-200 inline-flex items-center justify-center font-black text-xs text-[#FF5722] shadow-inner">
                                    VS
                                </span>
                            </div>

                            <!-- Team B -->
                            <div class="col-span-2 text-center space-y-2">
                                <img src="{{ $match->teamB->logo_url }}" alt="{{ $match->teamB->nama_tim }}" class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl object-contain shadow-sm bg-slate-50 border border-slate-200">
                                <a href="{{ route('team.show', $match->teamB->id_team) }}" class="font-black text-[#0B132B] text-sm hover:text-orange-600 transition line-clamp-1 block">
                                    {{ $match->teamB->nama_tim }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Info -->
                    <div class="mt-5 pt-3.5 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                        <div class="flex items-center gap-1.5 font-bold text-slate-700">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $match->formatted_time }} WIB</span>
                        </div>
                        <div class="flex items-center gap-1.5 truncate">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate font-medium">{{ $match->lokasi }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $matches->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm">
            <span class="text-4xl mb-3 inline-block">📅</span>
            <h3 class="text-lg font-black text-[#0B132B]">Tidak ada jadwal pertandingan</h3>
            <p class="text-sm text-slate-500 mt-1">Silakan pilih filter lain atau nantikan pembaruan jadwal dari panitia.</p>
        </div>
    @endif
</div>
@endsection

