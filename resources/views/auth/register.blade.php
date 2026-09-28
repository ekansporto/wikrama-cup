@extends('layouts.app')

@section('title', 'Daftar Akun Pemain — WIKCUP Basketball')

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
                    Daftarkan Dirimu & Raih<br>
                    Prestasimu di <span class="text-gradient-orange">WikraCup</span>
                </h2>
                <p class="text-slate-400 mt-3 text-sm leading-relaxed max-w-xs">
                    Buat akun pemain dan tampilkan statistik terbaikmu di hadapan seluruh komunitas basket Wikrama.
                </p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-orange-500/20 flex items-center justify-center text-orange-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Profil pemain lengkap dengan foto</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-orange-500/20 flex items-center justify-center text-orange-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Statistik & performa setiap pertandingan</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-cyan-500/20 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span>Papan peringkat turnamen resmi</span>
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
                <h1 class="text-xl font-black text-[#0B132B]">Registrasi Pemain</h1>
            </div>

            <div class="hidden lg:block">
                <h1 class="text-2xl font-black text-[#0B132B] tracking-tight">Registrasi Pemain</h1>
                <p class="text-slate-500 text-sm mt-1">Daftarkan akun untuk mencatat profil dan statistik turnamen</p>
            </div>

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-sm font-medium bg-white outline-none transition"
                           placeholder="Contoh: Rizky Pratama">
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
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
                           placeholder="Minimal 6 karakter">
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-sm font-medium bg-white outline-none transition"
                           placeholder="Ulangi password">
                </div>

                <!-- Notice -->
                <div class="p-3.5 rounded-xl bg-orange-50 border border-orange-200/80 text-xs text-orange-800 flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">ℹ️</span>
                    <span>Akun yang didaftarkan otomatis berstatus sebagai <strong>Pemain</strong>.</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm text-white transition duration-200 shadow-md shadow-orange-600/30"
                        style="background: linear-gradient(135deg, #FF5722, #F59E0B);">
                    Daftar Akun Pemain →
                </button>
            </form>

            <!-- Login Link -->
            <div class="pt-5 border-t border-slate-200 text-center text-sm text-slate-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 ml-1">
                    Login Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
