@extends('layouts.admin')

@section('title', 'Edit Statistik Pemain — WIKCUP Admin')
@section('header_title', 'Edit Statistik Pemain')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h2 class="text-xl font-extrabold text-slate-900">Edit Box Score Pemain</h2>
        <p class="text-xs text-slate-500 mt-0.5">{{ $statistic->player->nama ?? 'Pemain' }} • {{ $statistic->match->teamA->nama_tim ?? '' }} vs {{ $statistic->match->teamB->nama_tim ?? '' }}</p>
    </div>

    <form action="{{ route('admin.statistics.update', $statistic->id_statistic) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- MATCH & PLAYER SELECTION -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 p-5 rounded-2xl bg-slate-50 border border-slate-200">
            <!-- Pilih Pertandingan -->
            <div>
                <label for="id_match" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pertandingan</label>
                <select name="id_match" id="id_match" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                    @foreach($matches as $m)
                        <option value="{{ $m->id_match }}" {{ old('id_match', $statistic->id_match) == $m->id_match ? 'selected' : '' }}>
                            {{ $m->teamA->nama_tim }} vs {{ $m->teamB->nama_tim }} ({{ $m->formatted_date }})
                        </option>
                    @endforeach
                </select>
                @error('id_match')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Pemain -->
            <div>
                <label for="id_player" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pemain</label>
                <select name="id_player" id="id_player" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition outline-none bg-white">
                    @foreach($players as $p)
                        <option value="{{ $p->id_player }}" {{ old('id_player', $statistic->id_player) == $p->id_player ? 'selected' : '' }}>
                            {{ $p->nama }} (#{{ $p->no_punggung }} - {{ $p->team->nama_tim ?? 'Tanpa Tim' }})
                        </option>
                    @endforeach
                </select>
                @error('id_player')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- GROUP 1: Waktu, Poin & +/- -->
        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-orange-600 mb-3 flex items-center gap-1.5">
                <span>⏱️</span> Waktu Bermain & Total Poin
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="minutes" class="block text-xs font-bold text-slate-700 mb-1">Menit Bermain (MIN)</label>
                    <input type="text" name="minutes" id="minutes" value="{{ old('minutes', $statistic->minutes) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="poin" class="block text-xs font-bold text-slate-700 mb-1">Total Poin (PTS)</label>
                    <input type="number" name="poin" id="poin" min="0" value="{{ old('poin', $statistic->poin) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm font-bold text-orange-600 outline-none">
                </div>
                <div>
                    <label for="plus_minus" class="block text-xs font-bold text-slate-700 mb-1">Plus/Minus (+/-)</label>
                    <input type="number" name="plus_minus" id="plus_minus" value="{{ old('plus_minus', $statistic->plus_minus) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
            </div>
        </div>

        <!-- GROUP 2: Rebound, Assist, Turnover -->
        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-amber-600 mb-3 flex items-center gap-1.5">
                <span>🛡️</span> Rebounds, Assists & Turnovers
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label for="rebound" class="block text-xs font-bold text-slate-700 mb-1">Total Rebound</label>
                    <input type="number" name="rebound" id="rebound" min="0" value="{{ old('rebound', $statistic->rebound) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="defensive_rebound" class="block text-xs font-medium text-slate-700 mb-1">Def. Rebound</label>
                    <input type="number" name="defensive_rebound" id="defensive_rebound" min="0" value="{{ old('defensive_rebound', $statistic->defensive_rebound) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="assist" class="block text-xs font-bold text-slate-700 mb-1">Assist (AST)</label>
                    <input type="number" name="assist" id="assist" min="0" value="{{ old('assist', $statistic->assist) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="turnover" class="block text-xs font-bold text-slate-700 mb-1">Turnover (TO)</label>
                    <input type="number" name="turnover" id="turnover" min="0" value="{{ old('turnover', $statistic->turnover) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
            </div>
        </div>

        <!-- GROUP 3: Defense & Fouls -->
        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-3 flex items-center gap-1.5">
                <span>🔒</span> Defense & Pelanggaran
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="steal" class="block text-xs font-bold text-slate-700 mb-1">Steal (STL)</label>
                    <input type="number" name="steal" id="steal" min="0" value="{{ old('steal', $statistic->steal) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="block" class="block text-xs font-bold text-slate-700 mb-1">Block (BLK)</label>
                    <input type="number" name="block" id="block" min="0" value="{{ old('block', $statistic->block) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="foul" class="block text-xs font-bold text-slate-700 mb-1">Fouls (FOL)</label>
                    <input type="number" name="foul" id="foul" min="0" value="{{ old('foul', $statistic->foul) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
            </div>
        </div>

        <!-- GROUP 4: Shooting Accuracies -->
        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-sky-600 mb-3 flex items-center gap-1.5">
                <span>🎯</span> Akurasi Tembakan (Made & Attempt)
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <!-- Field Goals -->
                <div>
                    <label for="fgm" class="block text-xs font-bold text-slate-700 mb-1">FGM (Made)</label>
                    <input type="number" name="fgm" id="fgm" min="0" value="{{ old('fgm', $statistic->fgm) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="fga" class="block text-xs font-bold text-slate-700 mb-1">FGA (Attempt)</label>
                    <input type="number" name="fga" id="fga" min="0" value="{{ old('fga', $statistic->fga) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>

                <!-- 3 Pointers -->
                <div>
                    <label for="three_point_made" class="block text-xs font-bold text-slate-700 mb-1">3PT Made</label>
                    <input type="number" name="three_point_made" id="three_point_made" min="0" value="{{ old('three_point_made', $statistic->three_point_made) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="three_point_attempted" class="block text-xs font-bold text-slate-700 mb-1">3PT Attempt</label>
                    <input type="number" name="three_point_attempted" id="three_point_attempted" min="0" value="{{ old('three_point_attempted', $statistic->three_point_attempted) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>

                <!-- 2 Pointers -->
                <div>
                    <label for="two_point_made" class="block text-xs font-bold text-slate-700 mb-1">2PT Made</label>
                    <input type="number" name="two_point_made" id="two_point_made" min="0" value="{{ old('two_point_made', $statistic->two_point_made) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="two_point_attempted" class="block text-xs font-bold text-slate-700 mb-1">2PT Attempt</label>
                    <input type="number" name="two_point_attempted" id="two_point_attempted" min="0" value="{{ old('two_point_attempted', $statistic->two_point_attempted) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>

                <!-- Free Throws -->
                <div>
                    <label for="free_throw_made" class="block text-xs font-bold text-slate-700 mb-1">FT Made</label>
                    <input type="number" name="free_throw_made" id="free_throw_made" min="0" value="{{ old('free_throw_made', $statistic->free_throw_made) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
                <div>
                    <label for="free_throw_attempted" class="block text-xs font-bold text-slate-700 mb-1">FT Attempt</label>
                    <input type="number" name="free_throw_attempted" id="free_throw_attempted" min="0" value="{{ old('free_throw_attempted', $statistic->free_throw_attempted) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 text-sm outline-none">
                </div>
            </div>
        </div>

        <!-- Submit & Cancel -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.statistics.index', ['match_id' => $statistic->id_match]) }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-orange-600 hover:bg-orange-500 shadow-md shadow-orange-600/30 transition">
                Perbarui Statistik
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const threePtMade = document.getElementById('three_point_made');
        const threePtAtt = document.getElementById('three_point_attempted');
        const twoPtMade = document.getElementById('two_point_made');
        const twoPtAtt = document.getElementById('two_point_attempted');
        const ftMade = document.getElementById('free_throw_made');
        const ftAtt = document.getElementById('free_throw_attempted');
        const poinInput = document.getElementById('poin');
        const fgmInput = document.getElementById('fgm');
        const fgaInput = document.getElementById('fga');

        function recalculateShooting() {
            const m3 = parseInt(threePtMade.value) || 0;
            const a3 = parseInt(threePtAtt.value) || 0;
            const m2 = parseInt(twoPtMade.value) || 0;
            const a2 = parseInt(twoPtAtt.value) || 0;
            const mFt = parseInt(ftMade.value) || 0;

            // Auto calculate Total Points = 3*3PM + 2*2PM + 1*FTM
            poinInput.value = (m3 * 3) + (m2 * 2) + mFt;
            // Auto calculate FGM = 3PM + 2PM
            fgmInput.value = m3 + m2;
            // Auto calculate FGA = 3PA + 2PA
            fgaInput.value = a3 + a2;
        }

        [threePtMade, threePtAtt, twoPtMade, twoPtAtt, ftMade].forEach(el => {
            if (el) {
                el.addEventListener('input', recalculateShooting);
            }
        });
    });
</script>
@endpush
@endsection
