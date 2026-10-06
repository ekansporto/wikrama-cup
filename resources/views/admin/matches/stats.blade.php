@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Input Statistik Sekaligus</h1>
        <p class="text-slate-500 dark:text-slate-400">Pertandingan: {{ $match->teamA->nama_tim }} vs {{ $match->teamB->nama_tim }}</p>
    </div>
    <a href="{{ route('admin.matches.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-medium transition-colors">
        Kembali
    </a>
</div>

<div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-xl mb-6 flex items-start space-x-3">
    <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <div>
        <p class="font-semibold">Info Panitia</p>
        <p class="text-sm">Silakan ketik angka pada kolom di bawah ini. Skor tim akan otomatis terhitung dari total Poin pemain. Pastikan klik "Simpan Semua Statistik" di paling bawah setelah selesai.</p>
    </div>
</div>

<form action="{{ route('admin.matches.stats.update', $match->id_match) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- TIM A -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 mb-8 overflow-hidden">
        <div class="bg-slate-50 dark:bg-slate-900/50 p-5 border-b border-slate-200 dark:border-slate-700 flex items-center gap-4">
            <img src="{{ $match->teamA->logo_url }}" class="w-12 h-12 object-contain rounded-full bg-white p-1 border">
            <div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-white">Tim A: {{ $match->teamA->nama_tim }}</h2>
                <p class="text-sm text-slate-500">Isi statistik pemain dari tim ini</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-600 bg-slate-100/50 dark:bg-slate-800 dark:text-slate-300 uppercase">
                    <tr>
                        <th class="px-4 py-3 font-semibold whitespace-nowrap sticky left-0 bg-slate-100/50 dark:bg-slate-800">Pemain</th>
                        <th class="px-3 py-3 font-semibold text-center text-orange-600">PTS</th>
                        <th class="px-3 py-3 font-semibold text-center">REB</th>
                        <th class="px-3 py-3 font-semibold text-center">AST</th>
                        <th class="px-3 py-3 font-semibold text-center">STL</th>
                        <th class="px-3 py-3 font-semibold text-center">BLK</th>
                        <th class="px-3 py-3 font-semibold text-center">3PM</th>
                        <th class="px-3 py-3 font-semibold text-center">3PA</th>
                        <th class="px-3 py-3 font-semibold text-center">FGM</th>
                        <th class="px-3 py-3 font-semibold text-center">FGA</th>
                        <th class="px-3 py-3 font-semibold text-center">FTM</th>
                        <th class="px-3 py-3 font-semibold text-center">FTA</th>
                        <th class="px-3 py-3 font-semibold text-center">TO</th>
                        <th class="px-3 py-3 font-semibold text-center">FOUL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($match->teamA->players as $player)
                        @php $s = $statsMap->get($player->id_player); @endphp
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 font-medium text-slate-800 dark:text-slate-200 shadow-[1px_0_0_0_#e2e8f0] dark:shadow-[1px_0_0_0_#334155]">
                                #{{ $player->no_punggung }} - {{ $player->name }}
                            </td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][poin]" value="{{ $s->poin ?? 0 }}" class="w-16 text-center rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 font-bold text-orange-600"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][rebound]" value="{{ $s->rebound ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][assist]" value="{{ $s->assist ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][steal]" value="{{ $s->steal ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][block]" value="{{ $s->block ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            
                            <!-- 3 Points -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_made]" value="{{ $s->three_point_made ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-blue-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_attempted]" value="{{ $s->three_point_attempted ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>
                            
                            <!-- Field Goals -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][fgm]" value="{{ $s->fgm ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-green-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][fga]" value="{{ $s->fga ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>

                            <!-- Free Throws -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_made]" value="{{ $s->free_throw_made ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-yellow-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_attempted]" value="{{ $s->free_throw_attempted ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>

                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][turnover]" value="{{ $s->turnover ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500 text-red-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][foul]" value="{{ $s->foul ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500 text-red-500"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- TIM B -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 mb-8 overflow-hidden">
        <div class="bg-slate-50 dark:bg-slate-900/50 p-5 border-b border-slate-200 dark:border-slate-700 flex items-center gap-4">
            <img src="{{ $match->teamB->logo_url }}" class="w-12 h-12 object-contain rounded-full bg-white p-1 border">
            <div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-white">Tim B: {{ $match->teamB->nama_tim }}</h2>
                <p class="text-sm text-slate-500">Isi statistik pemain dari tim ini</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-600 bg-slate-100/50 dark:bg-slate-800 dark:text-slate-300 uppercase">
                    <tr>
                        <th class="px-4 py-3 font-semibold whitespace-nowrap sticky left-0 bg-slate-100/50 dark:bg-slate-800">Pemain</th>
                        <th class="px-3 py-3 font-semibold text-center text-orange-600">PTS</th>
                        <th class="px-3 py-3 font-semibold text-center">REB</th>
                        <th class="px-3 py-3 font-semibold text-center">AST</th>
                        <th class="px-3 py-3 font-semibold text-center">STL</th>
                        <th class="px-3 py-3 font-semibold text-center">BLK</th>
                        <th class="px-3 py-3 font-semibold text-center">3PM</th>
                        <th class="px-3 py-3 font-semibold text-center">3PA</th>
                        <th class="px-3 py-3 font-semibold text-center">FGM</th>
                        <th class="px-3 py-3 font-semibold text-center">FGA</th>
                        <th class="px-3 py-3 font-semibold text-center">FTM</th>
                        <th class="px-3 py-3 font-semibold text-center">FTA</th>
                        <th class="px-3 py-3 font-semibold text-center">TO</th>
                        <th class="px-3 py-3 font-semibold text-center">FOUL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($match->teamB->players as $player)
                        @php $s = $statsMap->get($player->id_player); @endphp
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 font-medium text-slate-800 dark:text-slate-200 shadow-[1px_0_0_0_#e2e8f0] dark:shadow-[1px_0_0_0_#334155]">
                                #{{ $player->no_punggung }} - {{ $player->name }}
                            </td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][poin]" value="{{ $s->poin ?? 0 }}" class="w-16 text-center rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 font-bold text-orange-600"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][rebound]" value="{{ $s->rebound ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][assist]" value="{{ $s->assist ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][steal]" value="{{ $s->steal ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][block]" value="{{ $s->block ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500"></td>
                            
                            <!-- 3 Points -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_made]" value="{{ $s->three_point_made ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-blue-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][three_point_attempted]" value="{{ $s->three_point_attempted ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>
                            
                            <!-- Field Goals -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][fgm]" value="{{ $s->fgm ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-green-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][fga]" value="{{ $s->fga ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>

                            <!-- Free Throws -->
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_made]" value="{{ $s->free_throw_made ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm bg-yellow-50"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][free_throw_attempted]" value="{{ $s->free_throw_attempted ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm"></td>

                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][turnover]" value="{{ $s->turnover ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500 text-red-500"></td>
                            <td class="px-2 py-2"><input type="number" min="0" name="stats[{{ $player->id_player }}][foul]" value="{{ $s->foul ?? 0 }}" class="w-14 text-center rounded-md border-slate-300 shadow-sm focus:border-slate-500 text-red-500"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sticky Bottom Action Bar -->
    <div class="sticky bottom-0 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 p-4 rounded-t-2xl shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] flex justify-end gap-3 z-50">
        <button type="reset" class="px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-medium transition-colors">
            Batal
        </button>
        <button type="submit" class="px-6 py-2.5 bg-orange-600 text-white rounded-lg hover:bg-orange-700 font-semibold shadow-lg shadow-orange-500/30 transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Simpan Semua Statistik
        </button>
    </div>
</form>

@endsection
