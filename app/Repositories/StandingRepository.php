<?php

namespace App\Repositories;

use App\Models\Standing;

class StandingRepository
{
    public function all(): \Illuminate\Support\Collection
    {
        return Standing::with('team')
            ->orderByDesc('points')
            ->orderByDesc('goal_difference')
            ->orderByDesc('team_id')
            ->get();
    }
}
