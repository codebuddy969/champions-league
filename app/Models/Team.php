<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team');
    }

    public function standing()
    {
        return $this->hasOne(Standing::class);
    }
}
