@extends('layouts.admin')

@section('title', 'Kelola Statistik Pemain — WIKCUP Admin')
@section('header_title', 'Kelola Statistik Pemain (Box Score)')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Catatan Statistik Pertandingan</h2>
            <p class="text-xs text-slate-500 mt-0.5">Input performa statistik individual pemain per laga turnamen</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Filter by Match -->
            <form action="{{ route('admin.statistics.index') }}" method="GET" class="flex items-center gap-2">
                <select name="match_id" onchange="this.form.submit()" 
                        class="px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 bg-white outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">-- Semua Pertandingan --</option>
                    @foreach($matches as $m)
                        <option value="{{ $m->id_match }}" {{ $matchId == $m->id_match ? 'selected' : '' }}>
                            {{ $m->teamA->nama_tim }} vs {{ $m->teamB->nama_tim }} ({{ $m->formatted_date }})
                        </option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('admin.statistics.create', ['match_id' => $matchId]) }}" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition whitespace-nowrap">
                + Input Statistik Pemain
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-xs tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4">Pertandingan</th>
                    <th class="px-6 py-4">Pemain</th>
                    <th class="px-6 py-4">Tim</th>
                    <th class="px-4 py-4 text-center">MIN</th>
                    <th class="px-4 py-4 text-center text-orange-600">PTS</th>
                    <th class="px-4 py-4 text-center">REB</th>
                    <th class="px-4 py-4 text-center">AST</th>
                    <th class="px-4 py-4 text-center">STL</th>
                    <th class="px-4 py-4 text-center">BLK</th>
                    <th class="px-4 py-4 text-center">EFF</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                @forelse($statistics as $stat)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-xs">
                            @if($stat->match)
                                <span class="font-bold text-slate-900 block">{{ $stat->match->teamA->nama_tim }} vs {{ $stat->match->teamB->nama_tim }}</span>
                                <span class="text-slate-400">{{ $stat->match->formatted_date }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($stat->player)
                                <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                    <span>{{ $stat->player->nama }}</span>
                                    <span class="text-xs text-slate-400 font-normal">#{{ $stat->player->no_punggung }}</span>
                                </div>
                                <span class="text-xs text-slate-500">{{ $stat->player->posisi }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs font-semibold text-slate-600">
                            {{ $stat->player->team->nama_tim ?? '-' }}
                        </td>
                        <td class="px-4 py-4 text-center text-xs text-slate-500">{{ $stat->minutes }}</td>
                        <td class="px-4 py-4 text-center font-black text-orange-600 text-base">{{ $stat->poin }}</td>
                        <td class="px-4 py-4 text-center font-bold">{{ $stat->rebound }}</td>
                        <td class="px-4 py-4 text-center font-bold">{{ $stat->assist }}</td>
                        <td class="px-4 py-4 text-center text-slate-600">{{ $stat->steal }}</td>
                        <td class="px-4 py-4 text-center text-slate-600">{{ $stat->block }}</td>
                        <td class="px-4 py-4 text-center font-extrabold text-slate-900">{{ $stat->eff }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.statistics.edit', $stat->id_statistic) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">
                                Edit
                            </a>
                            <form action="{{ route('admin.statistics.destroy', $stat->id_statistic) }}" method="POST" class="inline" onsubmit="return confirm('Hapus statistik pemain ini dari pertandingan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-6 py-8 text-center text-slate-400">Belum ada data statistik pemain.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $statistics->links() }}
    </div>
</div>
@endsection
