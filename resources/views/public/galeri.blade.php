@extends('layouts.app')

@section('title', 'Galeri Pertandingan — WIKCUP Basketball')

@section('content')
<div class="relative bg-gradient-to-b from-white via-orange-50/20 to-[#F8FAFC] py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 border border-orange-200/70 text-orange-600 text-xs font-bold mb-3 uppercase tracking-wider shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#FF5722] animate-pulse"></span>
            Photo Gallery
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B]">Galeri Pertandingan</h1>
        <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl font-normal">Momen aksi dan dokumentasi seru dari gelaran Wikrama Cup Basketball</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
                    <div class="relative overflow-hidden cursor-pointer" onclick="openLightbox('{{ $gallery->foto_url }}', '{{ addslashes($gallery->caption) }}', '{{ $gallery->formatted_date }}')">
                        <img src="{{ $gallery->foto_url }}" alt="{{ $gallery->caption }}" class="w-full h-60 object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-200 flex items-end p-4">
                            <span class="text-xs font-bold text-white flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                                Klik untuk Perbesar
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                        <p class="text-sm font-medium text-slate-800 leading-relaxed">
                            {{ $gallery->caption ?: 'Dokumentasi kegiatan WikCup Basketball' }}
                        </p>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>{{ $gallery->formatted_date }}</span>
                            @if($gallery->match)
                                <a href="{{ route('result.show', $gallery->match->id_match) }}" class="font-bold text-orange-600 hover:text-orange-700 truncate max-w-[160px]">
                                    🏀 {{ $gallery->match->teamA->nama_tim }} vs {{ $gallery->match->teamB->nama_tim }}
                                </a>
                            @else
                                <span class="text-slate-400 font-semibold">Event WikCup</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $galleries->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 text-slate-500">
            Belum ada dokumentasi foto galeri.
        </div>
    @endif
</div>

<!-- LIGHTBOX MODAL -->
<div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="relative max-w-4xl w-full bg-slate-900 rounded-3xl overflow-hidden border border-slate-800 shadow-2xl">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-slate-800/80 hover:bg-rose-600 text-white flex items-center justify-center transition focus:outline-none">
            ✕
        </button>
        <div class="p-2">
            <img id="lightbox-img" src="" alt="" class="w-full max-h-[75vh] object-contain rounded-2xl">
        </div>
        <div class="p-6 bg-slate-900 border-t border-slate-800 text-white">
            <p id="lightbox-caption" class="text-base font-semibold leading-relaxed"></p>
            <p id="lightbox-date" class="text-xs text-orange-400 font-medium mt-1"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(url, caption, date) {
        document.getElementById('lightbox-img').src = url;
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox-date').innerText = date;
        const modal = document.getElementById('lightbox-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('lightbox-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>
@endpush
@endsection
