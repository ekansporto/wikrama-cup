<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'ms_players';
    protected $primaryKey = 'id_player';

    protected $fillable = [
        'id_user',
        'id_team',
        'nama',
        'no_punggung',
        'posisi',
        'gender',
        'foto',
        'tinggi_badan',
        'berat_badan',
        'kelas_program',
        'is_captain',
    ];

    protected $casts = [
        'is_captain' => 'boolean',
        'tinggi_badan' => 'float',
        'berat_badan' => 'float',
        'no_punggung' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'id_team', 'id_team');
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class, 'id_player', 'id_player');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        if ($this->foto && file_exists(public_path($this->foto))) {
            return asset($this->foto);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=1e293b&color=f97316&size=200&bold=true';
    }

    // Dynamic Tournament Totals
    public function getTotalPointsAttribute(): int
    {
        return (int) $this->statistics->sum('poin');
    }

    public function getTotalReboundsAttribute(): int
    {
        return (int) $this->statistics->sum('rebound');
    }

    public function getTotalAssistsAttribute(): int
    {
        return (int) $this->statistics->sum('assist');
    }

    public function getTotalStealsAttribute(): int
    {
        return (int) $this->statistics->sum('steal');
    }

    public function getTotalBlocksAttribute(): int
    {
        return (int) $this->statistics->sum('block');
    }

    public function getTotalTurnoversAttribute(): int
    {
        return (int) $this->statistics->sum('turnover');
    }

    public function getTotalFgmAttribute(): int
    {
        return (int) $this->statistics->sum('fgm');
    }

    public function getTotalFgaAttribute(): int
    {
        return (int) $this->statistics->sum('fga');
    }

    public function getTotalThreePointMadeAttribute(): int
    {
        return (int) $this->statistics->sum('three_point_made');
    }

    public function getTotalThreePointAttemptedAttribute(): int
    {
        return (int) $this->statistics->sum('three_point_attempted');
    }

    public function getTotalTwoPointMadeAttribute(): int
    {
        return (int) $this->statistics->sum('two_point_made');
    }

    public function getTotalTwoPointAttemptedAttribute(): int
    {
        return (int) $this->statistics->sum('two_point_attempted');
    }

    public function getTotalFreeThrowMadeAttribute(): int
    {
        return (int) $this->statistics->sum('free_throw_made');
    }

    public function getTotalFreeThrowAttemptedAttribute(): int
    {
        return (int) $this->statistics->sum('free_throw_attempted');
    }

    // Aliases for stat calculation consistency
    public function getTotalFtmAttribute(): int
    {
        return $this->total_free_throw_made;
    }

    public function getTotalFtaAttribute(): int
    {
        return $this->total_free_throw_attempted;
    }

    public function getTotal3pmAttribute(): int
    {
        return $this->total_three_point_made;
    }

    public function getTotal3paAttribute(): int
    {
        return $this->total_three_point_attempted;
    }

    public function getTotal2pmAttribute(): int
    {
        return $this->total_two_point_made;
    }

    public function getTotal2paAttribute(): int
    {
        return $this->total_two_point_attempted;
    }

    public function getGamesPlayedAttribute(): int
    {
        return (int) $this->statistics->count();
    }

    // Tournament Averages Per Game
    public function getPpgAttribute(): float
    {
        $gp = $this->games_played;
        return $gp > 0 ? round($this->total_points / $gp, 1) : 0.0;
    }

    public function getRpgAttribute(): float
    {
        $gp = $this->games_played;
        return $gp > 0 ? round($this->total_rebounds / $gp, 1) : 0.0;
    }

    public function getApgAttribute(): float
    {
        $gp = $this->games_played;
        return $gp > 0 ? round($this->total_assists / $gp, 1) : 0.0;
    }

    public function getSpgAttribute(): float
    {
        $gp = $this->games_played;
        return $gp > 0 ? round($this->total_steals / $gp, 1) : 0.0;
    }

    public function getBpgAttribute(): float
    {
        $gp = $this->games_played;
        return $gp > 0 ? round($this->total_blocks / $gp, 1) : 0.0;
    }

    public function getEffAttribute(): float
    {
        $gp = $this->games_played;
        if ($gp === 0) return 0.0;

        $pts = $this->total_points;
        $reb = $this->total_rebounds;
        $ast = $this->total_assists;
        $stl = $this->total_steals;
        $blk = $this->total_blocks;
        $missedFg = $this->total_fga - $this->total_fgm;
        $missedFt = $this->total_free_throw_attempted - $this->total_free_throw_made;
        $to = $this->total_turnovers;

        $effSum = ($pts + $reb + $ast + $stl + $blk) - ($missedFg + $missedFt + $to);
        return round($effSum / $gp, 1);
    }

    // Dynamic Percentages
    public function getFgPercentageAttribute(): float
    {
        return $this->total_fga > 0 ? round(($this->total_fgm / $this->total_fga) * 100, 1) : 0.0;
    }

    public function getThreePtPercentageAttribute(): float
    {
        return $this->total_three_point_attempted > 0 ? round(($this->total_three_point_made / $this->total_three_point_attempted) * 100, 1) : 0.0;
    }

    public function getTwoPtPercentageAttribute(): float
    {
        return $this->total_two_point_attempted > 0 ? round(($this->total_two_point_made / $this->total_two_point_attempted) * 100, 1) : 0.0;
    }

    public function getFtPercentageAttribute(): float
    {
        return $this->total_free_throw_attempted > 0 ? round(($this->total_free_throw_made / $this->total_free_throw_attempted) * 100, 1) : 0.0;
    }
}
