<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WIKCUP — Wikrama Cup Basketball')</title>
    <meta name="description" content="Website informasi turnamen bola basket SMK Wikrama Bogor. Jadwal pertandingan, hasil skor, profil pemain, dan statistik turnamen lengkap.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-900 min-h-screen flex flex-col font-sans selection:bg-[#FF5722] selection:text-white">

    <!-- PUBLIC NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 py-3">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-orange-600 via-orange-500 to-amber-400 flex items-center justify-center text-white font-extrabold shadow-md shadow-orange-500/30 group-hover:scale-105 transition duration-200">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2c1.78 0 3.42.59 4.75 1.58-1.57 2.05-3.8 3.51-6.38 4.07C9.64 6.77 8.35 4.5 6.8 2.8 8.39 2.3 10.14 2 12 2zm-7.07 3.33c1.47 1.63 2.68 3.79 3.37 6.4-2.8.6-5.26 2.05-6.85 4.1C1.16 14.54 1 13.3 1 12c0-2.45.88-4.7 2.36-6.46.2-.07.39-.14.57-.21zM12 22c-1.84 0-3.56-.5-5.05-1.37 1.57-1.95 3.9-3.32 6.55-3.87.67 2.67 1.94 4.89 3.48 6.46C15.5 23.63 13.8 24 12 24zm6.65-3.08c-1.46-1.5-2.67-3.62-3.34-6.17 2.76-.56 5.17-1.94 6.76-3.92.59 1.55.93 3.24.93 5.02 0 1.91-.4 3.73-1.12 5.37-.41-.1-.82-.2-1.23-.3zM12 14.75c-2.31 0-4.43-.88-6.04-2.34 2.37-.49 4.38-1.8 5.75-3.62 1.45 1.77 3.55 3.03 6.03 3.54-1.55 1.5-3.68 2.42-5.74 2.42z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-tight text-[#0B132B]">WIKCUP</span>
                        <span class="text-[10px] uppercase tracking-widest text-orange-600 font-bold -mt-1">Basketball</span>
                    </div>
                </a>

                <!-- Nav Links Desktop -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-1.5 bg-slate-100/80 p-1.5 rounded-2xl border border-slate-200/60">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('home') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Home</a>
                    <a href="{{ route('schedule.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('schedule.*') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Jadwal</a>
                    <a href="{{ route('result.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('result.*') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Hasil</a>
                    <a href="{{ route('team.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('team.*') || request()->routeIs('player.*') && !request()->routeIs('player.profile*') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Tim & Pemain</a>
                    <a href="{{ route('statistic.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('statistic.*') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Statistik</a>
                    <a href="{{ route('gallery.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-bold transition {{ request()->routeIs('gallery.*') ? 'bg-[#FF5722] text-white shadow-sm shadow-orange-500/30' : 'text-slate-600 hover:text-[#0B132B] hover:bg-white/80' }}">Galeri</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-2.5">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold rounded-xl bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 text-white hover:from-orange-500 hover:to-amber-400 shadow-md shadow-orange-500/30 hover:shadow-orange-500/50 transition">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login
                        </a>
                    @else
                        @if(Auth::user()->isPlayer())
                            <a href="{{ route('player.profile') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-bold rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-200 shadow-sm transition">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                Profil Saya
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-bold rounded-xl bg-[#0B132B] hover:bg-slate-800 text-amber-400 border border-slate-700 transition shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                                </svg>
                                Admin Panel
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-2 text-sm font-semibold text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition" title="Logout">
                                Logout
                            </button>
                        </form>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-4 space-y-1 shadow-lg">
            <a href="{{ route('home') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('home') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Home</a>
            <a href="{{ route('schedule.index') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('schedule.*') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Jadwal</a>
            <a href="{{ route('result.index') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('result.*') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Hasil</a>
            <a href="{{ route('team.index') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('team.*') || request()->routeIs('player.*') && !request()->routeIs('player.profile*') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Tim & Pemain</a>
            <a href="{{ route('statistic.index') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('statistic.*') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Statistik</a>
            <a href="{{ route('gallery.index') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('gallery.*') ? 'bg-[#FF5722] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">Galeri</a>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    @if(session('success') || session('error') || session('info') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 w-full">
            @if(session('success'))
                <div class="p-4 mb-3 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-3 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold">{{ session('error') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="p-4 mb-3 rounded-2xl bg-cyan-50 border border-cyan-200 text-cyan-800 flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-cyan-500 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold">{{ session('info') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 mb-3 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
                    <div class="font-bold text-sm mb-1.5 flex items-center gap-2">
                        <span>⚠️</span> Perhatian:
                    </div>
                    <ul class="list-disc list-inside text-xs sm:text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- PUBLIC FOOTER -->
    <footer class="bg-[#0B132B] text-slate-400 border-t border-[#1E2D5A] mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Info Turnamen -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center text-white font-extrabold shadow-md shadow-orange-500/30">
                            🏀
                        </div>
                        <span class="text-xl font-black text-white tracking-tight">WIKCUP 2026</span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-md leading-relaxed">
                        Turnamen bola basket antarkelas dan jurusan SMK Wikrama Bogor. Menyajikan aksi kompetitif, jadwal akurat, serta analisis statistik pemain turnamen terlengkap.
                    </p>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#111C38] border border-[#1E2D5A] text-xs font-bold text-orange-400">
                        <span>MATCH</span>
                        <span class="text-slate-500">→</span>
                        <span>PLAYER</span>
                        <span class="text-slate-500">→</span>
                        <span class="text-cyan-400">STATISTICS</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-200 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-3.5 bg-orange-500 rounded-full inline-block"></span>
                        Menu Utama
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-400 transition font-medium">Beranda</a></li>
                        <li><a href="{{ route('schedule.index') }}" class="hover:text-orange-400 transition font-medium">Jadwal Pertandingan</a></li>
                        <li><a href="{{ route('result.index') }}" class="hover:text-orange-400 transition font-medium">Hasil Pertandingan</a></li>
                        <li><a href="{{ route('team.index') }}" class="hover:text-orange-400 transition font-medium">Tim & Pemain</a></li>
                        <li><a href="{{ route('statistic.index') }}" class="hover:text-orange-400 transition font-medium">Statistik Pemain</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-orange-400 transition font-medium">Galeri Foto</a></li>
                    </ul>
                </div>

                <!-- Info Kontak & Lokasi -->
                <div>
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-200 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-3.5 bg-cyan-500 rounded-full inline-block"></span>
                        Lokasi Turnamen
                    </h4>
                    <p class="text-sm text-slate-400 leading-relaxed mb-3">
                        Lapangan Basket Utama SMK Wikrama Bogor<br>
                        Jl. Raya Wangun No. 246, Sindangsari, Bogor Timur
                    </p>
                    <div class="text-xs text-slate-400 pt-3 border-t border-[#1E2D5A] font-semibold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Official Wikrama Basketball League
                    </div>
                </div>
            </div>

            <div class="border-t border-[#1E2D5A] mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-3">
                <p>&copy; {{ date('Y') }} WIKCUP — Wikrama Cup Basketball. All rights reserved.</p>
                <p class="text-slate-400 font-medium">Fokus pada Sportivitas & Data Statistik Terpercaya</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Nav Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

