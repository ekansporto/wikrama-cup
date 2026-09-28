<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'ms_teams';
    protected $primaryKey = 'id_team';

    protected $fillable = [
        'nama_tim',
        'logo',
    ];

    public function players()
    {
        return $this->hasMany(Player::class, 'id_team', 'id_team')->orderBy('no_punggung', 'asc');
    }

    public function matchesAsTeamA()
    {
        return $this->hasMany(MatchModel::class, 'team_a_id', 'id_team');
    }

    public function matchesAsTeamB()
    {
        return $this->hasMany(MatchModel::class, 'team_b_id', 'id_team');
    }

    public function getLogoUrlAttribute(): string
    {
        if ($this->logo && file_exists(public_path('storage/' . $this->logo))) {
            return asset('storage/' . $this->logo);
        }
        if ($this->logo && file_exists(public_path($this->logo))) {
            return asset($this->logo);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama_tim) . '&background=0f172a&color=ea580c&size=200&bold=true';
    }
}
