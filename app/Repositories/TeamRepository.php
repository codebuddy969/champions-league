<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    public function all(): \Illuminate\Support\Collection
    {
        return Team::all();
    }

    public function find(int $id): ?Team
    {
        return Team::find($id);
    }

    public function create(array $data): Team
    {
        return Team::create($data);
    }

    public function update(Team $team, array $data): bool
    {
        return $team->update($data);
    }

    public function delete(Team $team): bool
    {
        return $team->delete();
    }
}
