<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Week extends Model
{
    protected $fillable = ['title'];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
