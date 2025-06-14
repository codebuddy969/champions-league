<?php

namespace App\Services;

use App\Models\Standing;
use App\Models\Team;

class PredictionService
{
    /**
     * Return predicted championship probabilities as percentage.
     */
    public function getChampionshipPredictions(): array
    {
        $standings = Standing::with('team')->get();

        $scores = [];
        $total = 0;

        foreach ($standings as $standing) {
            $score = ($standing->points * 100) + ($standing->goal_difference * 10);
            $scores[$standing->team->name] = $score;
            $total += $score;
        }

        $predictions = [];
        foreach ($scores as $team => $score) {
            $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
            $predictions[] = [
                'team' => $team,
                'chance' => $percentage,
            ];
        }

        usort($predictions, fn($a, $b) => $b['chance'] <=> $a['chance']);

        return $predictions;
    }
}
