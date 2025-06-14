<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'home_team', 'away_team', 'home_team_goal', 'away_team_goal', 'week_id', 'status'
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team');
    }

    public function week()
    {
        return $this->belongsTo(Week::class);
    }
}
