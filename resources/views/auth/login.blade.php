@extends('layouts.app')

@section('title', 'Login Pemain & Admin — WIKCUP')

@section('content')
<div class="min-h-[78vh] flex items-center py-10 lg:py-16 relative overflow-hidden bg-white">
    <!-- Abstract Blurred Circles Background (Samain persis design) -->
    <div class="absolute -top-24 right-1/4 w-[420px] h-[420px] rounded-full bg-orange-300/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute top-1/3 left-10 w-[380px] h-[380px] rounded-full bg-cyan-200/45 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-20 right-10 w-[400px] h-[400px] rounded-full bg-amber-200/40 blur-[110px] pointer-events-none"></div>
    <div class="absolute bottom-10 left-1/3 w-[320px] h-[320px] rounded-full bg-emerald-200/35 blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- LEFT COLUMN: Headline & Features -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Tag Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/80 text-orange-600 text-xs font-bold uppercase tracking-wider shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    PORTAL RESMI WIKRAMA CUP 2026
                </div>

                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-[#0B132B] leading-[1.15]">
                    Akses & Kelola Portal<br>
                    <span style="color: #00A7B5 !important;">Turnamen Basket</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Pusat kendali operasional kejuaraan bola basket SMK Wikrama. Masuk untuk mengelola data roster pemain antarkelas, jadwal tanding, dan update statistik pertandingan real-time.
                </p>

                <!-- 3 Horizontal Mini Feature Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 pt-2">
                    
                    <!-- Feature 1 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-slate-200/90 shadow-sm hover:border-orange-300 transition text-center lg:text-left">
                        <div class="w-9 h-9 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg mb-2.5 mx-auto lg:mx-0 shadow-sm">
                            🏀
                        </div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm">Official Roster</h4>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">9+ Tim Resmi</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-slate-200/90 shadow-sm hover:border-cyan-300 transition text-center lg:text-left">
                        <div class="w-9 h-9 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg mb-2.5 mx-auto lg:mx-0 shadow-sm">
                            📊
                        </div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm">Live Statistics</h4>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">PTS, REB, AST, EFF</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-slate-200/90 shadow-sm hover:border-amber-300 transition text-center lg:text-left">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg mb-2.5 mx-auto lg:mx-0 shadow-sm">
                            🏆
                        </div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm">Standings 2026</h4>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Klasemen & Poin</p>
                    </div>

                </div>

                <!-- Bottom Verification Note -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 text-xs font-semibold shadow-sm">
                    <span class="text-sm">🍃</span>
                    <span>Terhubung langsung dengan server pencatatan statistik panitia resmi Wikrama Basketball Championship.</span>
                </div>

            </div>


            <!-- RIGHT COLUMN: Login Form Card -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end">
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
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Login ke WIKCUP</h2>
                        <p class="text-xs text-slate-500 mt-1 font-normal">Masuk untuk mengelola profil pemain atau dashboard turnamen</p>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-[11px] font-black uppercase tracking-wider text-slate-700 mb-1.5">
                                EMAIL
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', 'admin@wikcup.id') }}" required autofocus
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm"
                                   placeholder="nama@email.com">
                            @error('email')
                                <p class="text-xs text-rose-600 mt-1 font-semibold flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-[11px] font-black uppercase tracking-wider text-slate-700">
                                    PASSWORD
                                </label>
                                <a href="#" onclick="alert('Silakan hubungi panitia turnamen untuk reset password akun Anda.'); return false;" class="text-[11px] font-bold text-cyan-600 hover:text-cyan-700">
                                    Lupa Password?
                                </a>
                            </div>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-sm font-medium bg-slate-50/50 focus:bg-white outline-none transition shadow-sm"
                                   placeholder="supersecretpassword">
                            @error('password')
                                <p class="text-xs text-rose-600 mt-1 font-semibold flex items-center gap-1"><span>⚠</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox & SSL Security -->
                        <div class="flex items-center justify-between text-xs pt-1">
                            <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none font-medium">
                                <input type="checkbox" name="remember" class="rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                                <span>Ingat Saya</span>
                            </label>
                            <span class="text-[11px] text-emerald-600 font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                SSL Terenkripsi
                            </span>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full py-3.5 px-4 rounded-xl font-extrabold text-xs sm:text-sm text-white shadow-lg shadow-orange-600/30 transition duration-200 transform hover:-translate-y-0.5 hover:opacity-95 mt-2"
                                style="background: linear-gradient(135deg, #EA580C, #F97316) !important; color: #FFFFFF !important;">
                            Masuk Sekarang →
                        </button>
                    </form>

                    <!-- Bottom Link to Register -->
                    <div class="pt-5 mt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                        Belum punya akun pemain?
                        <a href="{{ route('register') }}" class="font-extrabold text-orange-600 hover:text-orange-700 hover:underline ml-1">
                            Daftar sebagai Pemain
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
