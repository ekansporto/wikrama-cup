<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WIKCUP — Wikrama Cup Basketball')</title>
    <meta name="description" content="Website turnamen resmi bola basket SMK Wikrama Bogor. Jadwal pertandingan, hasil skor, profil pemain, serta performa statistik turnamen terlengkap.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-white text-slate-900 min-h-screen flex flex-col font-sans selection:bg-orange-500 selection:text-white">

    <!-- PUBLIC NAVBAR -->
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Left Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-wikcup.png') }}" alt="WikCup Logo" class="h-11 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-200">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-orange-600 font-extrabold leading-none">OFFICIAL TOURNAMENT</span>
                        <span class="text-sm sm:text-base font-black tracking-tight text-slate-900 mt-0.5">SMK Wikrama Bogor</span>
                    </div>
                </a>

                <!-- Center Nav Pills (Desktop) -->
                <nav class="hidden lg:flex items-center gap-1.5 bg-slate-100/90 p-1.5 rounded-full border border-slate-200">
                    <a href="{{ route('home') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('home') ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('home')) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Home
                    </a>
                    <a href="{{ route('schedule.index') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('schedule.*') ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('schedule.*')) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Jadwal
                    </a>
                    <a href="{{ route('result.index') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('result.*') ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('result.*')) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Hasil
                    </a>
                    <a href="{{ route('team.index') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('team.*') || (request()->routeIs('player.*') && !request()->routeIs('player.profile*')) ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('team.*') || (request()->routeIs('player.*') && !request()->routeIs('player.profile*'))) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Tim & Pemain
                    </a>
                    <a href="{{ route('statistic.index') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('statistic.*') ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('statistic.*')) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Statistik
                    </a>
                    <a href="{{ route('gallery.index') }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200 {{ request()->routeIs('gallery.*') ? 'shadow-sm text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-white' }}"
                       @if(request()->routeIs('gallery.*')) style="background-color: #EA580C !important; color: #FFFFFF !important;" @endif>
                        Galeri
                    </a>
                </nav>

                <!-- Right Auth Area -->
                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 rounded-full text-white text-xs font-bold shadow-md shadow-orange-600/20 transition-all duration-200 hover:opacity-90"
                           style="background: linear-gradient(135deg, #EA580C, #F97316) !important; color: #FFFFFF !important;">
                            Masuk / Login
                        </a>
                    @else
                        @if(Auth::user()->isPlayer())
                            <a href="{{ route('player.profile') }}" 
                               class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 hover:border-slate-300 text-slate-700 text-xs font-bold shadow-sm transition">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Profil Saya
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-white text-xs font-extrabold shadow-md shadow-orange-500/30 transition hover:opacity-90"
                               style="background: linear-gradient(135deg, #EA580C, #F97316) !important; color: #FFFFFF !important;">
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                Admin Panel
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-slate-500 hover:text-rose-600 transition-colors ml-1">
                                Logout
                            </button>
                        </form>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-600 hover:text-slate-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 px-4 py-3 space-y-1 shadow-md">
            <a href="{{ route('home') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('home') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Home</a>
            <a href="{{ route('schedule.index') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('schedule.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Jadwal</a>
            <a href="{{ route('result.index') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('result.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Hasil</a>
            <a href="{{ route('team.index') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('team.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Tim & Pemain</a>
            <a href="{{ route('statistic.index') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('statistic.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Statistik</a>
            <a href="{{ route('gallery.index') }}" class="block px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('gallery.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-700 hover:bg-slate-50' }}">Galeri</a>
        </div>
    </header>

    <!-- FLASH NOTIFICATIONS (Toast Style with Smooth Dismiss) -->
    @if(session('success') || session('error') || session('info') || (isset($errors) && $errors->any()))
        <div class="fixed top-24 right-4 sm:right-8 z-50 max-w-md w-full space-y-3 pointer-events-none px-4 sm:px-0">
            @if(session('success'))
                <div id="flash-toast-success" class="pointer-events-auto bg-emerald-600 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3 border border-emerald-400/40 animate-bounce-short">
                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center font-bold text-sm shrink-0">✓</div>
                    <div class="text-xs sm:text-sm font-bold flex-1 leading-snug">{{ session('success') }}</div>
                    <button onclick="document.getElementById('flash-toast-success').remove()" class="text-white/80 hover:text-white text-lg leading-none font-bold px-1">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div id="flash-toast-error" class="pointer-events-auto bg-rose-600 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3 border border-rose-400/40 animate-bounce-short">
                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center font-bold text-sm shrink-0">⚠</div>
                    <div class="text-xs sm:text-sm font-bold flex-1 leading-snug">{{ session('error') }}</div>
                    <button onclick="document.getElementById('flash-toast-error').remove()" class="text-white/80 hover:text-white text-lg leading-none font-bold px-1">&times;</button>
                </div>
            @endif
            @if(session('info'))
                <div id="flash-toast-info" class="pointer-events-auto bg-blue-600 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3 border border-blue-400/40 animate-bounce-short">
                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center font-bold text-sm shrink-0">ℹ</div>
                    <div class="text-xs sm:text-sm font-bold flex-1 leading-snug">{{ session('info') }}</div>
                    <button onclick="document.getElementById('flash-toast-info').remove()" class="text-white/80 hover:text-white text-lg leading-none font-bold px-1">&times;</button>
                </div>
            @endif
            @if(isset($errors) && $errors->any())
                <div id="flash-toast-errors" class="pointer-events-auto bg-rose-600 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3 border border-rose-400/40 animate-bounce-short">
                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center font-bold text-sm shrink-0">⚠</div>
                    <div class="text-xs sm:text-sm flex-1">
                        <p class="font-extrabold mb-1">Terjadi kesalahan pengisian form:</p>
                        <ul class="list-disc pl-4 space-y-0.5 text-xs font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="document.getElementById('flash-toast-errors').remove()" class="text-white/80 hover:text-white text-lg leading-none font-bold px-1">&times;</button>
                </div>
            @endif
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="flex-grow bg-white">
        @yield('content')
    </main>

    <!-- PUBLIC FOOTER (Dark Navy) -->
    <footer class="text-slate-400 mt-24 border-t border-slate-800" style="background-color: #0B132B !important; color: #94A3B8 !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                
                <!-- Brand & Tagline -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-wikcup.png') }}" alt="WikCup Logo" class="h-12 w-auto object-contain">
                        <span class="text-2xl font-black text-white tracking-tight">WIKCUP 2026</span>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-400 max-w-md leading-relaxed font-normal">
                        Turnamen basket antarsekolah resmi SMK Wikrama Bogor. Menyajikan skor kompetitif, jadwal akurat, serta analisis statistik pemain turnamen.
                    </p>

                    <div class="flex items-center gap-3 text-xs font-extrabold tracking-widest pt-2">
                        <span class="text-orange-500">MATCH</span>
                        <span class="text-slate-600">—</span>
                        <span class="text-cyan-400">PLAYER</span>
                        <span class="text-slate-600">—</span>
                        <span class="text-amber-400">STATISTICS</span>
                    </div>
                </div>

                <!-- Menu Utama -->
                <div>
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-4">MENU UTAMA</h4>
                    <ul class="space-y-2.5 text-xs font-semibold">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('schedule.index') }}" class="hover:text-orange-400 transition-colors">Jadwal Pertandingan</a></li>
                        <li><a href="{{ route('result.index') }}" class="hover:text-orange-400 transition-colors">Hasil Pertandingan</a></li>
                        <li><a href="{{ route('team.index') }}" class="hover:text-orange-400 transition-colors">Tim & Pemain</a></li>
                        <li><a href="{{ route('statistic.index') }}" class="hover:text-orange-400 transition-colors">Statistik Turnamen</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-orange-400 transition-colors">Galeri Foto</a></li>
                    </ul>
                </div>

                <!-- Lokasi Turnamen -->
                <div>
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-4">LOKASI TURNAMEN</h4>
                    <p class="text-xs text-slate-300 font-semibold leading-relaxed mb-2">
                        Lapangan Basket Utama SMK Wikrama Bogor
                    </p>
                    <p class="text-xs text-slate-400 leading-relaxed mb-3">
                        Jl. Raya Wangun No. 246, Sindangsari, Bogor Timur
                    </p>
                    <a href="https://maps.google.com" target="_blank" class="text-xs font-bold text-cyan-400 hover:text-cyan-300 underline inline-block">
                        Official Wikrama Basketball Championship
                    </a>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="border-t border-slate-800/80 mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center text-[11px] text-slate-500 gap-2">
                <p>&copy; 2026 WIKCUP — Wikrama Cup Basketball. Dibuat untuk Pengembangan PPLG SMK Wikrama.</p>
                <p class="font-bold text-slate-400">Fokus pada Sportivitas & Data Statistik</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Nav Toggle & Auto-Dismiss Toast Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }

            // Auto dismiss flash toasts after 5 seconds
            ['flash-toast-success', 'flash-toast-error', 'flash-toast-info'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    setTimeout(() => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(-10px)';
                        el.style.transition = 'all 0.5s ease';
                        setTimeout(() => el.remove(), 500);
                    }, 5000);
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
