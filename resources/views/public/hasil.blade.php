@extends('layouts.app')

@section('title', 'Hasil Pertandingan — WIKCUP Basketball')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-gradient-to-b from-white via-orange-50/20 to-[#F8FAFC] py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/70 text-orange-600 text-xs font-bold mb-3 uppercase tracking-wider shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#FF5722] animate-pulse"></span>
            Match Results
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B]">Hasil Pertandingan</h1>
        <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl font-normal">Skor akhir dan rekap pertandingan resmi Wikrama Cup Basketball</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($results->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($results as $result)
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition flex flex-col justify-between">
                    <div>
                        <!-- Match Header -->
                        <div class="flex items-center justify-between text-xs text-slate-500 pb-3.5 border-b border-slate-100">
                            <span class="font-extrabold px-3 py-1 rounded-full bg-slate-100 text-slate-700 uppercase tracking-wider text-[11px]">
                                Full Time
                            </span>
                            <div class="flex items-center gap-1.5 font-bold text-slate-500">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $result->formatted_date }} • {{ $result->lokasi }}
                            </div>
                        </div>

                        <!-- Teams and Scores -->
                        <div class="grid grid-cols-7 items-center my-6">
                            <!-- Team A -->
                            <div class="col-span-3 flex items-center gap-3">
                                <img src="{{ $result->teamA->logo_url }}" alt="{{ $result->teamA->nama_tim }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover border border-slate-200 flex-shrink-0 bg-slate-50">
                                <div>
                                    <a href="{{ route('team.show', $result->teamA->id_team) }}" class="font-extrabold text-[#0B132B] text-sm sm:text-base hover:text-orange-600 transition block {{ $result->skor_tim_a > $result->skor_tim_b ? 'text-[#FF5722] font-black' : '' }}">
                                        {{ $result->teamA->nama_tim }}
                                    </a>
                                    @if($result->skor_tim_a > $result->skor_tim_b)
                                        <span class="inline-block mt-0.5 px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-black rounded-md uppercase tracking-wider">Menang</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Score Center -->
                            <div class="col-span-1 text-center font-black text-2xl sm:text-3xl tracking-tight">
                                <span class="{{ $result->skor_tim_a > $result->skor_tim_b ? 'text-[#FF5722]' : 'text-slate-800' }}">{{ $result->skor_tim_a }}</span>
                                <span class="text-slate-300 mx-0.5">-</span>
                                <span class="{{ $result->skor_tim_b > $result->skor_tim_a ? 'text-[#FF5722]' : 'text-slate-800' }}">{{ $result->skor_tim_b }}</span>
                            </div>

                            <!-- Team B -->
                            <div class="col-span-3 flex items-center justify-end gap-3 text-right">
                                <div>
                                    <a href="{{ route('team.show', $result->teamB->id_team) }}" class="font-extrabold text-[#0B132B] text-sm sm:text-base hover:text-orange-600 transition block {{ $result->skor_tim_b > $result->skor_tim_a ? 'text-[#FF5722] font-black' : '' }}">
                                        {{ $result->teamB->nama_tim }}
                                    </a>
                                    @if($result->skor_tim_b > $result->skor_tim_a)
                                        <span class="inline-block mt-0.5 px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-black rounded-md uppercase tracking-wider">Menang</span>
                                    @endif
                                </div>
                                <img src="{{ $result->teamB->logo_url }}" alt="{{ $result->teamB->nama_tim }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover border border-slate-200 flex-shrink-0 bg-slate-50">
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400 font-medium">Box Score & Detail Pemain</span>
                        <a href="{{ route('result.show', $result->id_match) }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#0B132B] hover:bg-[#FF5722] transition group shadow-sm">
                            Lihat Statistik Pertandingan
                            <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $results->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm">
            <span class="text-4xl mb-3 inline-block">🏆</span>
            <h3 class="text-lg font-black text-[#0B132B]">Belum ada hasil pertandingan</h3>
            <p class="text-sm text-slate-500 mt-1">Hasil pertandingan akan muncul di sini setelah pertandingan diselesaikan.</p>
        </div>
    @endif
</div>
@endsection

