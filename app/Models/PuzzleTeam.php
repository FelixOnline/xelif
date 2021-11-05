<?php

namespace App\Models;


use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PuzzleTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('points');
    }

}
