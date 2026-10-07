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
<body class="bg-slate-50 text-slate-900 min-h-screen flex font-sans selection:bg-orange-500 selection:text-white">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between min-h-screen sticky top-0 z-30">
        <div>
            <!-- Brand -->
            <div class="h-16 flex items-center px-6 bg-slate-950 border-b border-slate-800 gap-3">
                <img src="{{ asset('images/logo-wikcup.png') }}" alt="WIKCUP Logo" class="h-9 w-auto object-contain">
                <div>
                    <div class="font-black text-sm tracking-tight text-white leading-none">WIKCUP ADMIN</div>
                    <div class="text-[10px] text-orange-500 font-bold uppercase tracking-wider mt-0.5">Turnamen Basket</div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="py-4 space-y-1 text-sm font-bold">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-6 py-3 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white border-l-4 border-orange-600' : 'text-slate-400 hover:text-white hover:bg-slate-800 border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.teams.index') }}" 
                   class="flex items-center gap-3 px-6 py-3 transition-colors {{ request()->routeIs('admin.teams.*') ? 'bg-slate-800 text-white border-l-4 border-orange-600' : 'text-slate-400 hover:text-white hover:bg-slate-800 border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Tim & Pemain
                </a>

                <a href="{{ route('admin.matches.index') }}" 
                   class="flex items-center gap-3 px-6 py-3 transition-colors {{ request()->routeIs('admin.matches.*') ? 'bg-slate-800 text-white border-l-4 border-orange-600' : 'text-slate-400 hover:text-white hover:bg-slate-800 border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Jadwal & Skor
                </a>

                <a href="{{ route('admin.statistics.index') }}" 
                   class="flex items-center gap-3 px-6 py-3 transition-colors {{ request()->routeIs('admin.statistics.*') ? 'bg-slate-800 text-white border-l-4 border-orange-600' : 'text-slate-400 hover:text-white hover:bg-slate-800 border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Box Score & Statistik
                </a>

                <a href="{{ route('admin.galleries.index') }}" 
                   class="flex items-center gap-3 px-6 py-3 transition-colors {{ request()->routeIs('admin.galleries.*') ? 'bg-slate-800 text-white border-l-4 border-orange-600' : 'text-slate-400 hover:text-white hover:bg-slate-800 border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri Foto
                </a>
            </nav>
        </div>

        <!-- User & Logout -->
        <div class="bg-slate-950 border-t border-slate-800 p-4">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-orange-600 flex items-center justify-center font-bold text-white text-sm">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div class="text-xs text-slate-500 font-bold uppercase mt-0.5">Panitia</div>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-3 border-t border-slate-800">
                <a href="{{ route('home') }}" target="_blank" class="text-slate-400 hover:text-white font-bold transition-colors">
                    Lihat Web &rarr;
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-orange-500 hover:text-orange-400 font-bold transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">
            <div>
                <h1 class="font-black text-xl text-slate-900 tracking-tight">
                    @yield('header_title', 'Dashboard')
                </h1>
            </div>

            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold transition-colors">
                    Website Publik
                </a>
            </div>
        </header>

        <!-- FLASH NOTIFICATIONS -->
        @if(session('success') || session('error') || (isset($errors) && $errors->any()))
            <div class="px-8 pt-6">
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm font-bold rounded-xl">
                        {{ session('error') }}
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm rounded-xl">
                        <div class="font-bold mb-2">Terjadi Kesalahan:</div>
                        <ul class="list-disc pl-5 space-y-1 font-medium">
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
