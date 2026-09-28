<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard — WIKCUP')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F6F9] text-slate-900 min-h-screen flex font-sans selection:bg-[#FF5722] selection:text-white">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0B132B] text-white flex-shrink-0 flex flex-col justify-between border-r border-[#1E2D5A] min-h-screen sticky top-0 shadow-xl z-30">
        <div>
            <!-- Brand -->
            <div class="h-20 flex items-center px-6 border-b border-[#1E2D5A] gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center font-bold text-white text-base shadow-md shadow-orange-500/30">
                    🏀
                </div>
                <div>
                    <div class="font-black text-sm tracking-tight text-white">WIKCUP ADMIN</div>
                    <div class="text-[10px] text-orange-400 font-extrabold uppercase tracking-wider">Turnamen Basket</div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-sm font-semibold">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.teams.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.teams.*') ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Tim
                </a>

                <a href="{{ route('admin.matches.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.matches.*') ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Jadwal & Hasil
                </a>

                <a href="{{ route('admin.statistics.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.statistics.*') ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistik
                </a>

                <a href="{{ route('admin.galleries.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-[#FF5722] text-white shadow-md shadow-orange-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri
                </a>
            </nav>
        </div>

        <!-- User & Logout -->
        <div class="p-4 border-t border-[#1E2D5A] space-y-3">
            <div class="flex items-center gap-3 px-2 py-1">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center font-bold text-white text-xs shadow-md shadow-orange-500/30">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div class="text-[10px] text-slate-400 font-medium">Admin Panitia</div>
                </div>
            </div>

            <div class="pt-2 border-t border-[#1E2D5A] flex items-center justify-between text-xs px-2">
                <a href="{{ route('home') }}" target="_blank" class="text-slate-400 hover:text-white transition flex items-center gap-1 font-semibold">
                    <span>Lihat Web</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-rose-400 hover:text-rose-300 font-bold transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-slate-200/80 px-8 flex items-center justify-between shadow-sm sticky top-0 z-20">
            <div>
                <h1 class="font-black text-lg sm:text-xl text-[#0B132B] tracking-tight">
                    @yield('header_title', 'Dashboard Panel')
                </h1>
                <p class="text-xs text-slate-400 font-medium hidden sm:block">Panel Pengelolaan Turnamen Wikrama Cup Basketball</p>
            </div>

            <div class="flex items-center gap-3 text-xs">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold border border-slate-200 shadow-sm transition">
                    <span>🌐 Buka Website Publik</span>
                </a>
            </div>
        </header>

        <!-- FLASH NOTIFICATIONS -->
        @if(session('success') || session('error') || $errors->any())
            <div class="px-8 pt-6">
                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
                        <span class="w-7 h-7 rounded-lg bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shrink-0">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
                        <span class="w-7 h-7 rounded-lg bg-rose-500 text-white flex items-center justify-center font-bold text-xs shrink-0">✕</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-sm">
                        <div class="font-bold mb-1.5">Periksa kembali form Anda:</div>
                        <ul class="list-disc list-inside space-y-0.5 text-xs">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <!-- MAIN BODY -->
        <main class="p-8 flex-grow">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

