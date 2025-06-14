<?php

namespace App\Repositories;

use App\Models\Game;

class MatchRepository
{
    public function create(array $data): Game
    {
        return Game::create($data);
    }

    public function update(Game $game, array $data): bool
    {
        return $game->update($data);
    }

    public function all(): \Illuminate\Support\Collection
    {
        return Game::all();
    }

    public function isEmpty(): bool
    {
        return Game::count() === 0;
    }
}
