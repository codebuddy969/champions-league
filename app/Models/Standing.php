<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $fillable = [
        'team_id', 'played', 'won', 'draw', 'lose', 'goal_difference', 'points'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
