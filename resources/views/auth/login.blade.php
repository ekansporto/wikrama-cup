@extends('layouts.app')

@section('title', 'Login Pemain / Admin — WIKCUP')

@section('content')
<div class="min-h-[80vh] flex items-stretch">
    <!-- Left Dark Panel -->
    <div class="hidden lg:flex lg:w-5/12 auth-dark-panel flex-col justify-center items-start px-14 py-16">
        <div class="relative z-10 space-y-8">
            <div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center text-3xl shadow-xl shadow-orange-500/30 mb-6">
                    🏀
                </div>
                <h2 class="text-3xl font-black text-white leading-tight tracking-tight">
                    Akses & Kelola Portal<br>
                    <span class="text-gradient-orange">Turnamen Basket</span>
                </h2>
                <p class="text-slate-400 mt-3 text-sm leading-relaxed max-w-xs">
                    Login sebagai pemain untuk mengelola profil statistikmu, atau sebagai admin untuk mengatur turnamen.
                </p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-orange-500/20 flex items-center justify-center text-orange-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Profil & statistik pemain lengkap</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-orange-500/20 flex items-center justify-center text-orange-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Jadwal & hasil pertandingan real-time</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-cyan-500/20 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Dashboard admin pengelolaan turnamen</span>
                </div>
            </div>

            <div class="pt-6 border-t border-[#1E2D5A]">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider">
                    <span class="text-orange-400">MATCH</span>
                    <span>→</span>
                    <span class="text-amber-400">PLAYER</span>
                    <span>→</span>
                    <span class="text-cyan-400">STATISTICS</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="flex-1 flex items-center justify-center px-6 py-14 bg-[#F8FAFC]">
        <div class="w-full max-w-md space-y-7">
            <!-- Mobile logo -->
            <div class="lg:hidden text-center">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center mx-auto text-2xl shadow-lg shadow-orange-500/30 mb-3">🏀</div>
                <h1 class="text-xl font-black text-[#0B132B]">Login ke WIKCUP</h1>
            </div>

            <div class="hidden lg:block">
                <h1 class="text-2xl font-black text-[#0B132B] tracking-tight">Login Pemain Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Masuk untuk mengelola profil atau dashboard turnamen</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-sm font-medium bg-white outline-none transition"
                           placeholder="nama@email.com">
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-sm font-medium bg-white outline-none transition"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                        <span class="font-medium">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm text-white transition duration-200 shadow-md shadow-orange-600/30"
                        style="background: linear-gradient(135deg, #FF5722, #F59E0B);">
                    Masuk Sekarang →
                </button>
            </form>

            <!-- Register Link -->
            <div class="pt-5 border-t border-slate-200 text-center text-sm text-slate-500">
                Belum punya akun pemain?
                <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-700 ml-1">
                    Daftar sebagai Pemain
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
