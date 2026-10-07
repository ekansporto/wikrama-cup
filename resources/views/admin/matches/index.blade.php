@extends('layouts.admin')

@section('title', 'Kelola Jadwal & Hasil — WIKCUP Admin')
@section('header_title', 'Kelola Jadwal & Hasil Pertandingan')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Jadwal & Hasil Pertandingan</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola tanggal, jam, venue, serta update skor hasil pertandingan</p>
        </div>
        <a href="{{ route('admin.matches.create') }}" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition">
            + Tambah Jadwal Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-xs tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4">Waktu & Tanggal</th>
                    <th class="px-6 py-4">Tim A</th>
                    <th class="px-6 py-4 text-center">Skor Akhir</th>
                    <th class="px-6 py-4">Tim B</th>
                    <th class="px-6 py-4">Lokasi</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                @forelse($matches as $m)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-xs text-slate-500">
                            {{ $m->formatted_date }} <br>
                            <span class="font-bold text-slate-700">{{ $m->formatted_time }}</span>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">
                            <div class="flex items-center gap-2">
                                <img src="{{ $m->teamA->logo_url }}" alt="" class="w-7 h-7 rounded-lg object-contain bg-slate-100 border border-slate-200">
                                <span>{{ $m->teamA->nama_tim }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-black text-base">
                            @if($m->is_finished)
                                <span class="px-3 py-1 rounded-xl bg-slate-900 text-orange-400 border border-slate-800">{{ $m->skor_tim_a }} - {{ $m->skor_tim_b }}</span>
                            @else
                                <span class="text-xs text-slate-400 font-normal">Belum ada skor</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">
                            <div class="flex items-center gap-2">
                                <img src="{{ $m->teamB->logo_url }}" alt="" class="w-7 h-7 rounded-lg object-contain bg-slate-100 border border-slate-200">
                                <span>{{ $m->teamB->nama_tim }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-600">
                            {{ $m->lokasi }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($m->is_finished)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                            @elseif($m->is_today)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">Hari Ini</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">Mendatang</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.matches.edit', $m->id_match) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">
                                Edit
                            </a>
                            <form action="{{ route('admin.matches.destroy', $m->id_match) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pertandingan ini? Seluruh statistik box score pertandingan ini juga akan dihapus.');">
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
                        <td colspan="7" class="px-6 py-8 text-center text-slate-400">Belum ada jadwal pertandingan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $matches->links() }}
    </div>
</div>
@endsection
