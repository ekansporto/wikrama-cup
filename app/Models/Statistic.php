<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'tr_statistics';
    protected $primaryKey = 'id_statistic';

    protected $fillable = [
        'id_player',
        'id_match',
        'minutes',
        'poin',
        'rebound',
        'assist',
        'steal',
        'block',
        'turnover',
        'fgm',
        'fga',
        'three_point_made',
        'three_point_attempted',
        'two_point_made',
        'two_point_attempted',
        'free_throw_made',
        'free_throw_attempted',
        'defensive_rebound',
        'foul',
        'plus_minus',
    ];

    protected $casts = [
        'poin' => 'integer',
        'rebound' => 'integer',
        'assist' => 'integer',
        'steal' => 'integer',
        'block' => 'integer',
        'turnover' => 'integer',
        'fgm' => 'integer',
        'fga' => 'integer',
        'three_point_made' => 'integer',
        'three_point_attempted' => 'integer',
        'two_point_made' => 'integer',
        'two_point_attempted' => 'integer',
        'free_throw_made' => 'integer',
        'free_throw_attempted' => 'integer',
        'defensive_rebound' => 'integer',
        'foul' => 'integer',
        'plus_minus' => 'integer',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'id_player', 'id_player');
    }

    public function match()
    {
        return $this->belongsTo(MatchModel::class, 'id_match', 'id_match');
    }

    public function getFgPercentageAttribute(): float
    {
        return $this->fga > 0 ? round(($this->fgm / $this->fga) * 100, 1) : 0.0;
    }

    public function getThreePtPercentageAttribute(): float
    {
        return $this->three_point_attempted > 0 ? round(($this->three_point_made / $this->three_point_attempted) * 100, 1) : 0.0;
    }

    public function getTwoPtPercentageAttribute(): float
    {
        return $this->two_point_attempted > 0 ? round(($this->two_point_made / $this->two_point_attempted) * 100, 1) : 0.0;
    }

    public function getFtPercentageAttribute(): float
    {
        return $this->free_throw_attempted > 0 ? round(($this->free_throw_made / $this->free_throw_attempted) * 100, 1) : 0.0;
    }

    public function getEffAttribute(): int
    {
        $pts = $this->poin;
        $reb = $this->rebound;
        $ast = $this->assist;
        $stl = $this->steal;
        $blk = $this->block;
        $missedFg = $this->fga - $this->fgm;
        $missedFt = $this->free_throw_attempted - $this->free_throw_made;
        $to = $this->turnover;

        return ($pts + $reb + $ast + $stl + $blk) - ($missedFg + $missedFt + $to);
    }
}
