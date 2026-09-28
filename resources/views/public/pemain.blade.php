@extends('layouts.app')

@section('title', $player->nama . ' — Profil & Statistik Pemain — WIKCUP')

@section('content')
<!-- Player Banner Header -->
<div class="bg-[#0B132B] text-white py-14 border-b border-[#1E2D5A] relative overflow-hidden">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-orange-600/15 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('team.show', $player->id_team) }}" class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-orange-400 transition mb-6">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Tim {{ $player->team->nama_tim ?? 'Pemain' }}
        </a>

        <!-- Player Card Header -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Player Image -->
            <div class="lg:col-span-4 flex justify-center lg:justify-start">
                <div class="relative">
                    <img src="{{ $player->foto_url }}" alt="{{ $player->nama }}" class="w-48 sm:w-56 h-48 sm:h-56 rounded-3xl object-cover bg-slate-800 border-2 border-orange-500/50 shadow-2xl">
                    <span class="absolute -bottom-3 -right-3 bg-gradient-to-tr from-orange-600 via-orange-500 to-amber-500 text-white text-lg font-black px-4 py-1.5 rounded-2xl shadow-lg border-2 border-[#0B132B]">
                        #{{ $player->no_punggung }}
                    </span>
                </div>
            </div>

            <!-- Player Details -->
            <div class="lg:col-span-8 space-y-4 text-center lg:text-left">
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2">
                    <span class="px-3.5 py-1 rounded-full bg-orange-500/20 text-orange-400 text-xs font-extrabold uppercase tracking-wider border border-orange-500/30">
                        {{ $player->posisi }}
                    </span>
                    <a href="{{ route('team.show', $player->id_team) }}" class="px-3.5 py-1 rounded-full bg-[#111C38] text-slate-300 hover:text-white text-xs font-bold border border-[#1E2D5A] transition">
                        🏀 {{ $player->team->nama_tim ?? 'Tim' }}
                    </a>
                    @if($player->is_captain)
                        <span class="px-3.5 py-1 rounded-full bg-amber-400 text-slate-950 text-xs font-black tracking-wide uppercase shadow">
                            👑 Team Captain
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white">
                    {{ $player->nama }}
                </h1>

                <!-- Physical & Academic Info -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2 max-w-xl mx-auto lg:mx-0">
                    <div class="bg-[#111C38] rounded-2xl p-3.5 border border-[#1E2D5A] text-center">
                        <div class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Tinggi</div>
                        <div class="text-lg font-black text-white mt-0.5">{{ $player->tinggi_badan ? $player->tinggi_badan . ' cm' : '-' }}</div>
                    </div>
                    <div class="bg-[#111C38] rounded-2xl p-3.5 border border-[#1E2D5A] text-center">
                        <div class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Berat</div>
                        <div class="text-lg font-black text-white mt-0.5">{{ $player->berat_badan ? $player->berat_badan . ' kg' : '-' }}</div>
                    </div>
                    <div class="bg-[#111C38] rounded-2xl p-3.5 border border-[#1E2D5A] text-center col-span-2">
                        <div class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Kelas & Program</div>
                        <div class="text-sm font-bold text-orange-400 mt-0.5 truncate">{{ $player->kelas_program ?: 'SMK Wikrama Bogor' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- SECTION: RATA-RATA TURNAMEN -->
    <div>
        <h2 class="text-2xl font-black text-[#0B132B] mb-6 flex items-center gap-2.5">
            <span class="w-2.5 h-6 bg-[#FF5722] rounded-full inline-block"></span>
            Rata-Rata Turnamen
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <!-- PPG -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm text-center">
                <div class="text-xs font-black uppercase tracking-wider text-slate-400">PPG</div>
                <div class="text-3xl font-black text-[#FF5722] mt-1">{{ $player->ppg }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Points / Game</div>
            </div>

            <!-- RPG -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm text-center">
                <div class="text-xs font-black uppercase tracking-wider text-slate-400">RPG</div>
                <div class="text-3xl font-black text-[#0B132B] mt-1">{{ $player->rpg }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Rebounds / Game</div>
            </div>

            <!-- APG -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm text-center">
                <div class="text-xs font-black uppercase tracking-wider text-slate-400">APG</div>
                <div class="text-3xl font-black text-[#0B132B] mt-1">{{ $player->apg }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Assists / Game</div>
            </div>

            <!-- SPG -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm text-center">
                <div class="text-xs font-black uppercase tracking-wider text-slate-400">SPG</div>
                <div class="text-3xl font-black text-[#0B132B] mt-1">{{ $player->spg }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Steals / Game</div>
            </div>

            <!-- BPG -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm text-center">
                <div class="text-xs font-black uppercase tracking-wider text-slate-400">BPG</div>
                <div class="text-3xl font-black text-[#0B132B] mt-1">{{ $player->bpg }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Blocks / Game</div>
            </div>

            <!-- EFF -->
            <div class="bg-white rounded-3xl p-5 border border-orange-200 shadow-sm text-center bg-gradient-to-b from-orange-50/50 to-white">
                <div class="text-xs font-black uppercase tracking-wider text-orange-600">EFF</div>
                <div class="text-3xl font-black text-[#FF5722] mt-1">{{ $player->eff }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 font-medium">Efficiency Rating</div>
            </div>
        </div>

        <!-- Overall Shooting Accuracy Summary -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
            <div class="bg-[#0B132B] text-white rounded-2xl p-4 flex items-center justify-between border border-[#1E2D5A]">
                <span class="text-xs text-slate-400 font-bold">FG% (Field Goal)</span>
                <span class="text-base sm:text-lg font-black text-amber-400">{{ $player->fg_percentage }}% <span class="text-[10px] text-slate-400 font-normal">({{ $player->total_fgm }}/{{ $player->total_fga }})</span></span>
            </div>
            <div class="bg-[#0B132B] text-white rounded-2xl p-4 flex items-center justify-between border border-[#1E2D5A]">
                <span class="text-xs text-slate-400 font-bold">3PT% (3 Poin)</span>
                <span class="text-base sm:text-lg font-black text-amber-400">{{ $player->three_pt_percentage }}% <span class="text-[10px] text-slate-400 font-normal">({{ $player->total_three_point_made }}/{{ $player->total_three_point_attempted }})</span></span>
            </div>
            <div class="bg-[#0B132B] text-white rounded-2xl p-4 flex items-center justify-between border border-[#1E2D5A]">
                <span class="text-xs text-slate-400 font-bold">2PT% (2 Poin)</span>
                <span class="text-base sm:text-lg font-black text-amber-400">{{ $player->two_pt_percentage }}% <span class="text-[10px] text-slate-400 font-normal">({{ $player->total_two_point_made }}/{{ $player->total_two_point_attempted }})</span></span>
            </div>
            <div class="bg-[#0B132B] text-white rounded-2xl p-4 flex items-center justify-between border border-[#1E2D5A]">
                <span class="text-xs text-slate-400 font-bold">FT% (Free Throw)</span>
                <span class="text-base sm:text-lg font-black text-amber-400">{{ $player->ft_percentage }}% <span class="text-[10px] text-slate-400 font-normal">({{ $player->total_free_throw_made }}/{{ $player->total_free_throw_attempted }})</span></span>
            </div>
        </div>
    </div>

    <!-- SECTION: RIWAYAT PERTANDINGAN -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-[#0B132B] text-white flex items-center justify-between">
            <h3 class="text-base sm:text-lg font-black flex items-center gap-2.5">
                <span class="w-2 h-4 bg-[#FF5722] rounded-full inline-block"></span>
                Riwayat Statistik Pertandingan
            </h3>
            <span class="text-xs text-slate-400 font-semibold">Total {{ $statistics->count() }} Laga Dimainkan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3.5">Pertandingan</th>
                        <th class="px-3 py-3.5 text-center">MIN</th>
                        <th class="px-3 py-3.5 text-center text-[#FF5722] font-black bg-orange-50/50">PTS</th>
                        <th class="px-3 py-3.5 text-center">REB</th>
                        <th class="px-3 py-3.5 text-center">AST</th>
                        <th class="px-3 py-3.5 text-center">STL</th>
                        <th class="px-3 py-3.5 text-center">BLK</th>
                        <th class="px-3 py-3.5 text-center">TO</th>
                        <th class="px-3 py-3.5 text-center">FGM</th>
                        <th class="px-3 py-3.5 text-center">FGA</th>
                        <th class="px-3 py-3.5 text-center">FG%</th>
                        <th class="px-3 py-3.5 text-center">3FGM</th>
                        <th class="px-3 py-3.5 text-center">3FGA</th>
                        <th class="px-3 py-3.5 text-center">3FG%</th>
                        <th class="px-3 py-3.5 text-center">2FGM</th>
                        <th class="px-3 py-3.5 text-center">2FGA</th>
                        <th class="px-3 py-3.5 text-center">2FG%</th>
                        <th class="px-3 py-3.5 text-center">FTM</th>
                        <th class="px-3 py-3.5 text-center">FTA</th>
                        <th class="px-3 py-3.5 text-center">FT%</th>
                        <th class="px-3 py-3.5 text-center">DRB</th>
                        <th class="px-3 py-3.5 text-center">FOL</th>
                        <th class="px-3 py-3.5 text-center">+/-</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                    @forelse($statistics as $stat)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3.5">
                                @if($stat->match)
                                    <a href="{{ route('result.show', $stat->match->id_match) }}" class="font-extrabold text-[#0B132B] hover:text-orange-600 transition block leading-tight">
                                        {{ $stat->match->teamA->nama_tim }} vs {{ $stat->match->teamB->nama_tim }}
                                    </a>
                                    <span class="text-[11px] text-slate-400 font-normal">{{ $stat->match->formatted_date }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-3.5 text-center text-slate-500">{{ $stat->minutes }}</td>
                            <td class="px-3 py-3.5 text-center font-black text-[#FF5722] text-base bg-orange-50/50">{{ $stat->poin }}</td>
                            <td class="px-3 py-3.5 text-center font-bold">{{ $stat->rebound }}</td>
                            <td class="px-3 py-3.5 text-center font-bold">{{ $stat->assist }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->steal }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->block }}</td>
                            <td class="px-3 py-3.5 text-center text-slate-500">{{ $stat->turnover }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->fgm }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->fga }}</td>
                            <td class="px-3 py-3.5 text-center font-semibold text-slate-700">{{ $stat->fg_percentage }}%</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->three_point_made }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->three_point_attempted }}</td>
                            <td class="px-3 py-3.5 text-center font-semibold text-slate-700">{{ $stat->three_pt_percentage }}%</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->two_point_made }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->two_point_attempted }}</td>
                            <td class="px-3 py-3.5 text-center font-semibold text-slate-700">{{ $stat->two_pt_percentage }}%</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->free_throw_made }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->free_throw_attempted }}</td>
                            <td class="px-3 py-3.5 text-center font-semibold text-slate-700">{{ $stat->ft_percentage }}%</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->defensive_rebound }}</td>
                            <td class="px-3 py-3.5 text-center">{{ $stat->foul }}</td>
                            <td class="px-3 py-3.5 text-center font-black {{ $stat->plus_minus >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $stat->plus_minus > 0 ? '+' : '' }}{{ $stat->plus_minus }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="23" class="px-4 py-10 text-center text-slate-400">Pemain belum memiliki catatan riwayat pertandingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

