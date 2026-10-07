@extends('layouts.app')

@section('title', 'Registrasi Pemain — WIKCUP Basketball')

@section('content')
<div class="min-h-[78vh] flex items-center py-10 lg:py-16 relative overflow-hidden bg-white">
    <!-- Abstract Blurred Circles Background (Samain persis design) -->
    <div class="absolute -top-20 left-10 w-[420px] h-[420px] rounded-full bg-orange-300/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute top-1/3 right-1/4 w-[380px] h-[380px] rounded-full bg-cyan-200/45 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-20 left-1/4 w-[400px] h-[400px] rounded-full bg-amber-200/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-[320px] h-[320px] rounded-full bg-emerald-200/35 blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- LEFT COLUMN: Registration Form Card (Samain persis design) -->
            <div class="lg:col-span-5 flex justify-center lg:justify-start order-2 lg:order-1">
                <div class="w-full max-w-md bg-white rounded-3xl p-7 sm:p-9 border border-slate-200/90 shadow-2xl relative overflow-hidden">
                    
                    <!-- Decorative Glow Background -->
                    <div class="absolute -top-12 -right-12 w-36 h-36 rounded-full bg-orange-400/10 blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-12 -left-12 w-36 h-36 rounded-full bg-cyan-400/10 blur-2xl pointer-events-none"></div>

                    <!-- Header Logo Icon -->
                    <div class="text-center pb-5 mb-5 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white mx-auto shadow-md shadow-orange-500/25 mb-3"
                             style="background: linear-gradient(135deg, #F97316, #EA580C) !important; color: #FFFFFF !important;">
                            <span class="text-2xl">🏀</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Registrasi Pemain</h2>
                        <p class="text-xs text-slate-500 mt-1 font-normal">Daftarkan akun Anda untuk mencatat profil dan statistik turnamen</p>
                    </div>

                    <!-- Register Form -->
                    <form action="{{ route('register') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-[11px] font-black uppercase tracking-wider text-slate-700 mb-1.5">
                                NAMA LENGKAP
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm"
                                   placeholder="Contoh: Rizky Pratama">
                            @error('name')
                                <p class="text-xs text-rose-600 mt-1 font-semibold flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[11px] font-black uppercase tracking-wider text-slate-700 mb-1.5">
                                EMAIL
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm"
                                   placeholder="nama@email.com">
                            @error('email')
                                <p class="text-xs text-rose-600 mt-1 font-semibold flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-[11px] font-black uppercase tracking-wider text-slate-700 mb-1.5">
                                PASSWORD
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm pr-10"
                                       placeholder="Minimal 8 karakter (kombinasi)">
                                <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                    👁
                                </button>
                            </div>
                            <!-- Password Strength Criteria Hint -->
                            <div class="mt-2 p-2.5 rounded-xl bg-slate-50 border border-slate-200 text-[11px] text-slate-600 space-y-1">
                                <p class="font-bold text-slate-700 text-[11px]">Syarat Keamanan Password:</p>
                                <div class="grid grid-cols-2 gap-1 text-[10px]">
                                    <span class="flex items-center gap-1 text-slate-500">✔ Min. 8 Karakter</span>
                                    <span class="flex items-center gap-1 text-slate-500">✔ Huruf Besar (A-Z)</span>
                                    <span class="flex items-center gap-1 text-slate-500">✔ Huruf Kecil (a-z)</span>
                                    <span class="flex items-center gap-1 text-slate-500">✔ Angka & Simbol (!@#$)</span>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-[11px] font-black uppercase tracking-wider text-slate-700 mb-1.5">
                                KONFIRMASI PASSWORD
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm pr-10"
                                       placeholder="Ulangi password di atas">
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                    👁
                                </button>
                            </div>
                        </div>

                        <!-- Role Info Notice -->
                        <div class="p-3 rounded-xl bg-orange-50/80 border border-orange-200/80 text-[11px] text-orange-900 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-orange-200/70 text-orange-700 flex items-center justify-center font-bold shrink-0 text-[10px]">ℹ</span>
                            <span>Akun yang didaftarkan otomatis berstatus sebagai <strong>Pemain</strong>.</span>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full py-3.5 px-4 rounded-xl font-extrabold text-xs sm:text-sm text-white shadow-lg shadow-orange-600/30 transition duration-200 transform hover:-translate-y-0.5 hover:opacity-95 mt-2"
                                style="background: linear-gradient(135deg, #EA580C, #F97316) !important; color: #FFFFFF !important;">
                            Daftar Akun Pemain →
                        </button>
                    </form>

                    <!-- Bottom Link to Login -->
                    <div class="pt-5 mt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-extrabold text-orange-600 hover:text-orange-700 hover:underline ml-1">
                            Login Sekarang
                        </a>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Headline & 3 Vertical Feature Cards -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left order-1 lg:order-2">
                
                <!-- Tag Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/80 text-orange-600 text-xs font-bold uppercase tracking-wider shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    PENDAFTARAN RESMI PEMAIN WIKCUP 2026
                </div>

                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B] leading-[1.15]">
                    Daftarkan Dirimu & Raih<br>
                    Prestasi di <span style="color: #00A7B5 !important;">Wikrama Cup</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Daftarkan akun pemain Anda untuk mencatat profil atlet, rekap statistik pertandingan individu, dan pantau performa bersama tim terbaik SMK Wikrama Bogor.
                </p>

                <!-- 3 Vertical Feature Cards -->
                <div class="space-y-3.5 max-w-xl mx-auto lg:mx-0 pt-2">
                    
                    <!-- Card 1 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-sm flex items-start gap-4 hover:border-orange-300 transition text-left">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg shrink-0 shadow-sm">
                            👤
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm sm:text-base">Profil & Jersey Eksklusif</h4>
                            <p class="text-xs text-slate-500 font-normal mt-0.5 leading-relaxed">
                                Pencatatan nomor punggung, posisi bermain, dan foto tim resmi turnamen.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-sm flex items-start gap-4 hover:border-cyan-300 transition text-left">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg shrink-0 shadow-sm">
                            📊
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm sm:text-base">Tracking Statistik Lengkap</h4>
                            <p class="text-xs text-slate-500 font-normal mt-0.5 leading-relaxed">
                                Rekap data poin, assist, rebound, dan akurasi tembakan secara real-time.
                            </p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-sm flex items-start gap-4 hover:border-emerald-300 transition text-left">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0 shadow-sm">
                            🛡️
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm sm:text-base">Verifikasi Cepat & Aman</h4>
                            <p class="text-xs text-slate-500 font-normal mt-0.5 leading-relaxed">
                                Terdaftar resmi di bawah naungan Panitia & Wasit Wikrama Basketball Championship.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Bottom Verification Note -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 text-xs font-semibold shadow-sm">
                    <span class="text-sm">✅</span>
                    <span>Data pemain diverifikasi otomatis untuk validitas pertandingan resmi.</span>
                </div>

            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePasswordVisibility(fieldId) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
@endpush
@endsection
