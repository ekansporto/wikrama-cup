@extends('layouts.app')

@section('title', $team->nama_tim . ' — Skuad & Pemain — WIKCUP')

@section('content')
<!-- Team Header Banner -->
<div class="bg-[#0B132B] text-white py-14 border-b border-[#1E2D5A] relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-orange-600/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('team.index') }}" class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-orange-400 transition mb-6">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Tim
        </a>

        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <img src="{{ $team->logo_url }}" alt="{{ $team->nama_tim }}" class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl object-cover bg-[#111C38] border-2 border-[#1E2D5A] shadow-xl shrink-0">
            <div class="space-y-2 text-center sm:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/20 text-orange-400 text-xs font-extrabold uppercase tracking-wider border border-orange-500/30">
                    Official WikCup Roster
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">{{ $team->nama_tim }}</h1>
                <p class="text-sm text-slate-400 font-medium">Total {{ $team->players->count() }} pemain terdaftar dalam turnamen ini.</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-black text-[#0B132B] flex items-center gap-2.5">
                <span class="w-2.5 h-6 bg-[#FF5722] rounded-full inline-block"></span>
                Daftar Pemain (Roster)
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Susunan pemain lengkap dan profil individu</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($team->players as $player)
            <a href="{{ route('player.show', $player->id_player) }}" class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-orange-200 transition group flex flex-col justify-between">
                <div>
                    <!-- Player Image & Jersey Number -->
                    <div class="relative mb-4">
                        <img src="{{ $player->foto_url }}" alt="{{ $player->nama }}" class="w-full h-52 rounded-2xl object-cover bg-slate-100 border border-slate-200 group-hover:scale-[1.02] transition duration-200">
                        <span class="absolute top-2.5 left-2.5 bg-[#0B132B]/90 backdrop-blur text-white text-xs font-black px-2.5 py-1 rounded-xl shadow border border-slate-700">
                            #{{ $player->no_punggung }}
                        </span>
                        @if($player->is_captain)
                            <span class="absolute top-2.5 right-2.5 bg-amber-400 text-slate-950 text-[10px] font-black px-2 py-0.5 rounded-lg shadow uppercase tracking-wider">
                                CAPTAIN
                            </span>
                        @endif
                    </div>

                    <!-- Player Name & Position -->
                    <div class="space-y-1">
                        <div class="text-[11px] font-extrabold uppercase tracking-wider text-orange-600">
                            {{ $player->posisi }}
                        </div>
                        <h3 class="font-black text-base text-[#0B132B] group-hover:text-orange-600 transition leading-snug">
                            {{ $player->nama }}
                        </h3>
                        @if($player->kelas_program)
                            <p class="text-xs text-slate-500 font-medium">{{ $player->kelas_program }}</p>
                        @endif
                    </div>
                </div>

                <!-- Stats summary mini bar -->
                <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-400 font-semibold">{{ $player->tinggi_badan ? $player->tinggi_badan . ' cm' : '' }}</span>
                    <span class="font-bold text-orange-600 group-hover:translate-x-1 transition flex items-center gap-0.5">
                        Lihat Profil →
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-4 bg-white rounded-3xl p-12 text-center border border-slate-200 text-slate-500 shadow-sm">
                Belum ada data pemain untuk tim ini.
            </div>
        @endforelse
    </div>
</div>
@endsection

