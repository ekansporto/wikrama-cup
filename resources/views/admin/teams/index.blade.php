@extends('layouts.admin')

@section('title', 'Kelola Tim — WIKCUP Admin')
@section('header_title', 'Kelola Data Tim')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Daftar Tim Turnamen</h2>
            <p class="text-xs text-slate-500 mt-0.5">Admin membuat dan mengelola seluruh tim resmi yang bertanding</p>
        </div>
        <a href="{{ route('admin.teams.create') }}" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition">
            + Tambah Tim Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-xs tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 w-16">Logo</th>
                    <th class="px-6 py-4">Nama Tim</th>
                    <th class="px-6 py-4 text-center">Jumlah Pemain</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                @forelse($teams as $team)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <img src="{{ $team->logo_url }}" alt="{{ $team->nama_tim }}" class="w-12 h-12 rounded-xl object-contain bg-slate-100 border border-slate-200">
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900 text-base">
                            {{ $team->nama_tim }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                🏀 {{ $team->players_count }} Pemain
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.teams.edit', $team->id_team) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">
                                Edit
                            </a>
                            <form action="{{ route('admin.teams.destroy', $team->id_team) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus tim {{ $team->nama_tim }}? Seluruh pemain dan statistik terkait tim ini akan terhapus.');">
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
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada tim yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $teams->links() }}
    </div>
</div>
@endsection
