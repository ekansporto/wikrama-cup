@extends('layouts.app')

@section('title', 'Tim & Pemain — WIKCUP Basketball')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-gradient-to-b from-white via-orange-50/20 to-[#F8FAFC] py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/70 text-orange-600 text-xs font-bold mb-3 uppercase tracking-wider shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#FF5722] animate-pulse"></span>
            Teams & Rosters
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B]">Tim & Pemain</h1>
        <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl font-normal">Daftar tim basket resmi yang bertanding di turnamen Wikrama Cup Basketball</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($teams as $team)
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-orange-200 transition duration-200 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <img src="{{ $team->logo_url }}" alt="{{ $team->nama_tim }}" class="w-16 h-16 rounded-2xl object-contain bg-slate-50 border border-slate-200 group-hover:scale-105 transition duration-200 shadow-sm shrink-0">
                        <div>
                            <h3 class="font-black text-lg text-[#0B132B] group-hover:text-orange-600 transition leading-snug">
                                {{ $team->nama_tim }}
                            </h3>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 mt-1.5">
                                🏀 {{ $team->players_count }} Pemain
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-400 font-semibold">Roster & Profil</span>
                    <a href="{{ route('team.show', $team->id_team) }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#0B132B] group-hover:bg-[#FF5722] transition shadow-sm">
                        Lihat Tim
                        <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200 text-slate-500 shadow-sm">
                Belum ada data tim yang terdaftar.
            </div>
        @endforelse
    </div>
</div>
@endsection

