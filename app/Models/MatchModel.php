<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;

    protected $table = 'tr_matches';
    protected $primaryKey = 'id_match';

    protected $fillable = [
        'team_a_id',
        'team_b_id',
        'tanggal',
        'jam',
        'lokasi',
        'skor_tim_a',
        'skor_tim_b',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'skor_tim_a' => 'integer',
        'skor_tim_b' => 'integer',
    ];

    public function teamA()
    {
        return $this->belongsTo(Team::class, 'team_a_id', 'id_team');
    }

    public function teamB()
    {
        return $this->belongsTo(Team::class, 'team_b_id', 'id_team');
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class, 'id_match', 'id_match');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'id_match', 'id_match');
    }

    public function getIsFinishedAttribute(): bool
    {
        return !is_null($this->skor_tim_a) && !is_null($this->skor_tim_b);
    }

    public function getIsTodayAttribute(): bool
    {
        return $this->tanggal ? $this->tanggal->isToday() : false;
    }

    public function getIsUpcomingAttribute(): bool
    {
        return !$this->is_finished && $this->tanggal && $this->tanggal->gte(Carbon::today());
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->translatedFormat('d F Y') : '-';
    }

    public function getFormattedTimeAttribute(): string
    {
        return $this->jam ? Carbon::parse($this->jam)->format('H:i') . ' WIB' : '-';
    }

    public function getWinnerAttribute(): ?Team
    {
        if (!$this->is_finished) return null;
        if ($this->skor_tim_a > $this->skor_tim_b) return $this->teamA;
        if ($this->skor_tim_b > $this->skor_tim_a) return $this->teamB;
        return null;
    }
}
