@extends('layouts.admin')

@section('title', 'Kelola Galeri — WIKCUP Admin')
@section('header_title', 'Kelola Dokumentasi Galeri')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Daftar Foto Dokumentasi</h2>
            <p class="text-xs text-slate-500 mt-0.5">Upload momen aksi pertandingan dan kegiatan Wikrama Cup</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-bold text-xs shadow-sm transition">
            + Upload Foto Baru
        </a>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galleries as $g)
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex flex-col justify-between">
                    <img src="{{ $g->foto_url }}" alt="" class="w-full h-44 object-cover">
                    
                    <div class="p-4 flex-grow flex flex-col justify-between space-y-2">
                        <p class="text-xs text-slate-700 font-medium line-clamp-2">
                            {{ $g->caption ?: 'Tanpa keterangan foto' }}
                        </p>

                        <div class="text-[11px] text-slate-400">
                            {{ $g->formatted_date }}
                        </div>
                    </div>

                    <div class="p-3 bg-white border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                        <a href="{{ route('admin.galleries.edit', $g->id_gallery) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                        <form action="{{ route('admin.galleries.destroy', $g->id_gallery) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-700">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-4 py-12 text-center text-slate-400">
                    Belum ada foto galeri yang diunggah.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection
