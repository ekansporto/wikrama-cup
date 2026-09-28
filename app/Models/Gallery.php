<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'tr_galleries';
    protected $primaryKey = 'id_gallery';

    protected $fillable = [
        'id_match',
        'foto',
        'caption',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function match()
    {
        return $this->belongsTo(MatchModel::class, 'id_match', 'id_match');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        if ($this->foto && file_exists(public_path($this->foto))) {
            return asset($this->foto);
        }
        if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return $this->foto;
        }
        return asset('images/gallery-placeholder.jpg');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->translatedFormat('d F Y') : '';
    }
}
