<?php

namespace App\Services;

use App\Models\Team;
use App\Models\Game;
use App\Models\Standing;
use App\Models\Week;

class LeagueSimulator
{
    public function generateFixtures(): void
    {
        $teams = Team::all();
        $weeks = Week::all();

        $matchups = [];

        foreach ($teams as $home) {
            foreach ($teams as $away) {
                if ($home->id !== $away->id) {
                    $matchups[] = [$home->id, $away->id];
                }
            }
        }

        shuffle($matchups);

        $weekIndex = 0;
        foreach (array_chunk($matchups, 2) as $games) {
            if (!isset($weeks[$weekIndex])) continue;
            foreach ($games as $match) {
                Game::create([
                    'home_team' => $match[0],
                    'away_team' => $match[1],
                    'week_id' => $weeks[$weekIndex]->id,
                ]);
            }
            $weekIndex++;
        }
    }

    public function simulateWeek(int $weekId): void
    {
        $games = Game::where('week_id', $weekId)->where('status', false)->get();

        foreach ($games as $game) {
            $homeGoals = rand(0, 5);
            $awayGoals = rand(0, 5);

            $game->update([
                'home_team_goal' => $homeGoals,
                'away_team_goal' => $awayGoals,
                'status' => true
            ]);

            $this->updateStandings($game->home_team, $game->away_team, $homeGoals, $awayGoals);
        }
    }

    private function updateStandings(int $homeId, int $awayId, int $homeGoals, int $awayGoals): void
    {
        $this->applyResultToTeam($homeId, $homeGoals, $awayGoals);
        $this->applyResultToTeam($awayId, $awayGoals, $homeGoals);
    }

    private function applyResultToTeam(int $teamId, int $goalsFor, int $goalsAgainst): void
    {
        $standing = Standing::firstOrCreate([
            'team_id' => $teamId
        ], [
            'played' => 0,
            'won' => 0,
            'draw' => 0,
            'lose' => 0,
            'goal_difference' => 0,
            'points' => 0,
        ]);

        $standing->played++;
        $standing->goal_difference += ($goalsFor - $goalsAgainst);

        if ($goalsFor > $goalsAgainst) {
            $standing->won++;
            $standing->points += 3;
        } elseif ($goalsFor === $goalsAgainst) {
            $standing->draw++;
            $standing->points += 1;
        } else {
            $standing->lose++;
        }

        $standing->save();
    }

    public function resetLeague(): void
    {
        Game::query()->update([
            'home_team_goal' => 0,
            'away_team_goal' => 0,
            'status' => 0
        ]);

        Standing::query()->update([
            'played' => 0,
            'won' => 0,
            'draw' => 0,
            'lose' => 0,
            'goal_difference' => 0,
            'points' => 0
        ]);
    }

}
