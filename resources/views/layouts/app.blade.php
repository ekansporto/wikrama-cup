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
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans selection:bg-orange-500 selection:text-white">

    <!-- PUBLIC NAVBAR -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-orange-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2c1.78 0 3.42.59 4.75 1.58-1.57 2.05-3.8 3.51-6.38 4.07C9.64 6.77 8.35 4.5 6.8 2.8 8.39 2.3 10.14 2 12 2zm-7.07 3.33c1.47 1.63 2.68 3.79 3.37 6.4-2.8.6-5.26 2.05-6.85 4.1C1.16 14.54 1 13.3 1 12c0-2.45.88-4.7 2.36-6.46.2-.07.39-.14.57-.21zM12 22c-1.84 0-3.56-.5-5.05-1.37 1.57-1.95 3.9-3.32 6.55-3.87.67 2.67 1.94 4.89 3.48 6.46C15.5 23.63 13.8 24 12 24zm6.65-3.08c-1.46-1.5-2.67-3.62-3.34-6.17 2.76-.56 5.17-1.94 6.76-3.92.59 1.55.93 3.24.93 5.02 0 1.91-.4 3.73-1.12 5.37-.41-.1-.82-.2-1.23-.3zM12 14.75c-2.31 0-4.43-.88-6.04-2.34 2.37-.49 4.38-1.8 5.75-3.62 1.45 1.77 3.55 3.03 6.03 3.54-1.55 1.5-3.68 2.42-5.74 2.42z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-tight text-slate-900 leading-none">WIKCUP</span>
                        <span class="text-[10px] uppercase tracking-widest text-orange-600 font-bold mt-0.5">Basketball</span>
                    </div>
                </a>

                <!-- Nav Links Desktop -->
                <nav class="hidden md:flex h-full space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('home') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Home</a>
                    <a href="{{ route('schedule.index') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('schedule.*') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Jadwal</a>
                    <a href="{{ route('result.index') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('result.*') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Hasil</a>
                    <a href="{{ route('team.index') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('team.*') || request()->routeIs('player.*') && !request()->routeIs('player.profile*') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Tim & Pemain</a>
                    <a href="{{ route('statistic.index') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('statistic.*') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Statistik</a>
                    <a href="{{ route('gallery.index') }}" class="inline-flex items-center h-full px-1 pt-1 border-b-2 text-sm font-bold transition-colors {{ request()->routeIs('gallery.*') ? 'border-orange-600 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">Galeri</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold transition-colors">
                            Login
                        </a>
                    @else
                        @if(Auth::user()->isPlayer())
                            <a href="{{ route('player.profile') }}" class="px-4 py-2 bg-slate-100 border border-slate-200 hover:bg-slate-200 text-slate-800 text-sm font-bold transition-colors">
                                Profil Saya
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold transition-colors">
                                Admin Panel
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-slate-500 hover:text-orange-600 transition-colors">
                                Logout
                            </button>
                        </form>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-500 hover:text-slate-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 px-4 py-2 space-y-1 shadow-sm">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('home') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Home</a>
            <a href="{{ route('schedule.index') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('schedule.*') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Jadwal</a>
            <a href="{{ route('result.index') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('result.*') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Hasil</a>
            <a href="{{ route('team.index') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('team.*') || request()->routeIs('player.*') && !request()->routeIs('player.profile*') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Tim & Pemain</a>
            <a href="{{ route('statistic.index') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('statistic.*') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Statistik</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2 text-sm font-bold {{ request()->routeIs('gallery.*') ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Galeri</a>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    @if(session('success') || session('error') || session('info') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
                <div class="p-4 mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 bg-rose-50 border border-rose-200 text-rose-800 font-medium text-sm">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="p-4 mb-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                    <p class="font-bold mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc pl-5 space-y-1">
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
    <footer class="bg-slate-900 text-slate-400 mt-20 border-t-4 border-orange-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Info Turnamen -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-orange-600 flex items-center justify-center text-white">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2c1.78 0 3.42.59 4.75 1.58-1.57 2.05-3.8 3.51-6.38 4.07C9.64 6.77 8.35 4.5 6.8 2.8 8.39 2.3 10.14 2 12 2zm-7.07 3.33c1.47 1.63 2.68 3.79 3.37 6.4-2.8.6-5.26 2.05-6.85 4.1C1.16 14.54 1 13.3 1 12c0-2.45.88-4.7 2.36-6.46.2-.07.39-.14.57-.21zM12 22c-1.84 0-3.56-.5-5.05-1.37 1.57-1.95 3.9-3.32 6.55-3.87.67 2.67 1.94 4.89 3.48 6.46C15.5 23.63 13.8 24 12 24zm6.65-3.08c-1.46-1.5-2.67-3.62-3.34-6.17 2.76-.56 5.17-1.94 6.76-3.92.59 1.55.93 3.24.93 5.02 0 1.91-.4 3.73-1.12 5.37-.41-.1-.82-.2-1.23-.3zM12 14.75c-2.31 0-4.43-.88-6.04-2.34 2.37-.49 4.38-1.8 5.75-3.62 1.45 1.77 3.55 3.03 6.03 3.54-1.55 1.5-3.68 2.42-5.74 2.42z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-black text-white tracking-tight leading-none">WIKCUP 2026</span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-sm leading-relaxed mb-4">
                        Turnamen bola basket antarkelas dan jurusan SMK Wikrama Bogor. Menyajikan aksi kompetitif, jadwal akurat, serta analisis statistik pemain turnamen terlengkap.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-3 text-sm font-medium">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('schedule.index') }}" class="hover:text-orange-500 transition-colors">Jadwal Pertandingan</a></li>
                        <li><a href="{{ route('result.index') }}" class="hover:text-orange-500 transition-colors">Hasil Pertandingan</a></li>
                        <li><a href="{{ route('statistic.index') }}" class="hover:text-orange-500 transition-colors">Statistik Pemain</a></li>
                    </ul>
                </div>

                <!-- Info Kontak & Lokasi -->
                <div>
                    <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">Lokasi Turnamen</h4>
                    <p class="text-sm text-slate-400 leading-relaxed mb-3">
                        Lapangan Basket Utama SMK Wikrama Bogor<br>
                        Jl. Raya Wangun No. 246, Sindangsari
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-xs">
                <p>&copy; {{ date('Y') }} WIKCUP Basketball. Hak Cipta Dilindungi.</p>
                <p class="mt-2 md:mt-0 font-bold text-slate-500">SPORTIVITAS & STATISTIK</p>
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
