<?php

namespace App\Services;

class MatchResultGenerator
{
    public function generateGoals(int $homeStrength, int $awayStrength): array
    {
        $homeGoals = $this->biasedRandomGoals($homeStrength);
        $awayGoals = $this->biasedRandomGoals($awayStrength);

        return [$homeGoals, $awayGoals];
    }

    private function biasedRandomGoals(int $strength): int
    {
        $base = rand(0, 2);

        if ($strength > 75) {
            return $base + rand(1, 3);
        } elseif ($strength > 50) {
            return $base + rand(0, 2);
        } elseif ($strength > 25) {
            return $base;
        }

        return rand(0, 1);
    }
}
