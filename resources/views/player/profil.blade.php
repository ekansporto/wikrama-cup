@extends('layouts.app')

@section('title', 'Profil & Statistik Pemain Saya — WIKCUP')

@section('content')
<div class="bg-[#0B132B] text-white py-12 border-b border-[#1E2D5A] relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-orange-600/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-64 h-64 rounded-full bg-cyan-600/5 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Akun Pemain Aktif</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight mt-1">Profil Pemain Saya</h1>
        <p class="text-slate-400 mt-2 text-sm sm:text-base">Kelola data identitas dan statistik permainan Anda di Wikrama Cup Basketball</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    <!-- SECTION 1: EDIT FORM -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <div class="border-b border-slate-100 pb-4 mb-6">
            <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                <span class="w-2.5 h-5 bg-orange-600 rounded-full inline-block"></span>
                Informasi Data Pemain
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">Pilih tim yang sudah dibuat oleh admin dan lengkapi data fisik/posisi bermain Anda</p>
        </div>

        <form action="{{ route('player.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Foto Preview & Upload -->
                <div class="md:col-span-4 text-center space-y-4">
                    <div class="relative w-40 h-40 mx-auto">
                        <img src="{{ $player ? $player->foto_url : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1e293b&color=f97316&size=200' }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full rounded-3xl object-cover border-2 border-orange-500/50 shadow-md bg-slate-100">
                    </div>

                    <div>
                        <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Ganti Foto Profil</label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-1">Maksimal 2MB (JPG, PNG, WebP)</p>
                    </div>
                </div>

                <!-- Profile Fields -->
                <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama -->
                    <div class="sm:col-span-2">
                        <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $player->nama ?? $user->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none">
                    </div>

                    <!-- Pilihan Tim (Dari ms_teams) -->
                    <div>
                        <label for="id_team" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tim (Pilihan Admin)</label>
                        <select name="id_team" id="id_team" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                            <option value="">-- Pilih Tim Resmi --</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id_team }}" {{ old('id_team', $player->id_team ?? '') == $team->id_team ? 'selected' : '' }}>
                                    {{ $team->nama_tim }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">Tim dibuat dan dikelola oleh Administrator.</p>
                    </div>

                    <!-- Nomor Punggung -->
                    <div>
                        <label for="no_punggung" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nomor Punggung (#)</label>
                        <input type="number" name="no_punggung" id="no_punggung" min="0" max="99" value="{{ old('no_punggung', $player->no_punggung ?? 0) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                               placeholder="Contoh: 7">
                    </div>

                    <!-- Posisi Bermain -->
                    <div>
                        <label for="posisi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Posisi Bermain</label>
                        <select name="posisi" id="posisi" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Point Guard (PG)" {{ old('posisi', $player->posisi ?? '') == 'Point Guard (PG)' ? 'selected' : '' }}>Point Guard (PG)</option>
                            <option value="Shooting Guard (SG)" {{ old('posisi', $player->posisi ?? '') == 'Shooting Guard (SG)' ? 'selected' : '' }}>Shooting Guard (SG)</option>
                            <option value="Small Forward (SF)" {{ old('posisi', $player->posisi ?? '') == 'Small Forward (SF)' ? 'selected' : '' }}>Small Forward (SF)</option>
                            <option value="Power Forward (PF)" {{ old('posisi', $player->posisi ?? '') == 'Power Forward (PF)' ? 'selected' : '' }}>Power Forward (PF)</option>
                            <option value="Center (C)" {{ old('posisi', $player->posisi ?? '') == 'Center (C)' ? 'selected' : '' }}>Center (C)</option>
                        </select>
                    </div>

                    <!-- Divisi / Gender -->
                    <div>
                        <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Divisi / Kategori</label>
                        <select name="gender" id="gender" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                            <option value="Boys" {{ old('gender', $player->gender ?? 'Boys') == 'Boys' ? 'selected' : '' }}>Boys (Putra)</option>
                            <option value="Girls" {{ old('gender', $player->gender ?? '') == 'Girls' ? 'selected' : '' }}>Girls (Putri)</option>
                        </select>
                    </div>

                    <!-- Kelas & Program -->
                    <div>
                        <label for="kelas_program" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kelas & Program Keahlian</label>
                        <input type="text" name="kelas_program" id="kelas_program" value="{{ old('kelas_program', $player->kelas_program ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                               placeholder="Contoh: XII PPLG 1">
                    </div>

                    <!-- Tinggi Badan -->
                    <div>
                        <label for="tinggi_badan" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" name="tinggi_badan" id="tinggi_badan" value="{{ old('tinggi_badan', $player->tinggi_badan ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                               placeholder="Contoh: 178">
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label for="berat_badan" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="berat_badan" id="berat_badan" value="{{ old('berat_badan', $player->berat_badan ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none"
                               placeholder="Contoh: 68">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 shadow-md shadow-orange-600/30 transition">
                    Simpan Profil Pemain
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION 2: STATISTIK SAYA -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <div class="border-b border-slate-100 pb-4 mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                    <span class="w-2.5 h-5 bg-amber-500 rounded-full inline-block"></span>
                    Statistik Saya
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Akumulasi performa Anda sepanjang turnamen WikCup Basketball</p>
            </div>
            @if($player)
                <a href="{{ route('player.show', $player->id_player) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">
                    Lihat Tampilan Publik Profil →
                </a>
            @endif
        </div>

        @if($player)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Total PTS -->
                <div class="bg-gradient-to-b from-orange-50 to-white rounded-2xl p-5 border border-orange-200 text-center">
                    <div class="text-xs font-bold uppercase tracking-wider text-orange-600">Total Points</div>
                    <div class="text-3xl font-black text-orange-600 mt-1">{{ $player->total_points }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $player->ppg }} PPG</div>
                </div>

                <!-- Total REB -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-center">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Rebound</div>
                    <div class="text-3xl font-black text-slate-800 mt-1">{{ $player->total_rebounds }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $player->rpg }} RPG</div>
                </div>

                <!-- Total AST -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-center">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Assist</div>
                    <div class="text-3xl font-black text-slate-800 mt-1">{{ $player->total_assists }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $player->apg }} APG</div>
                </div>

                <!-- Total STL -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-center">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Steal</div>
                    <div class="text-3xl font-black text-slate-800 mt-1">{{ $player->total_steals }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $player->spg }} SPG</div>
                </div>

                <!-- Total BLK -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-center">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Block</div>
                    <div class="text-3xl font-black text-slate-800 mt-1">{{ $player->total_blocks }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $player->bpg }} BPG</div>
                </div>
            </div>
        @else
            <div class="bg-slate-50 rounded-2xl p-8 text-center border border-slate-200 text-slate-500 text-sm">
                Lengkapi profil pemain Anda di atas untuk mulai menghubungkan statistik pertandingan turnamen.
            </div>
        @endif
    </div>
</div>
@endsection
