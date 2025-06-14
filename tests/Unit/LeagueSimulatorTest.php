<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\Week;
use App\Models\Game;
use App\Models\Standing;
use App\Services\LeagueSimulator;

class LeagueSimulatorTest extends TestCase
{
    use RefreshDatabase;

    protected LeagueSimulator $simulator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->simulator = new LeagueSimulator();

        Team::insert([
            ['id' => 1, 'name' => 'Team A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Team B', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Team C', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Team D', 'created_at' => now(), 'updated_at' => now()],
        ]);

        for ($i = 1; $i <= 6; $i++) {
            Week::create([
                'id' => $i,
                'title' => "Week $i",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function testGenerateFixturesCreatesGames()
    {
        $this->simulator->generateFixtures();

        $games = Game::all();
        $this->assertCount(12, $games);

        $sampleGame = $games->first();
        $this->assertNotNull($sampleGame->home_team);
        $this->assertNotNull($sampleGame->away_team);
        $this->assertEquals(false, $sampleGame->status);
        $this->assertEquals(0, $sampleGame->home_team_goal);
        $this->assertEquals(0, $sampleGame->away_team_goal);
    }

    public function testSimulateWeekUpdatesGameStatusAndGoals()
    {
        $this->simulator->generateFixtures();
        $week = Week::first();
        $this->simulator->simulateWeek($week->id);

        $games = Game::where('week_id', $week->id)->get();

        foreach ($games as $game) {
            $this->assertEquals(true, $game->status);
            $this->assertIsInt($game->home_team_goal);
            $this->assertIsInt($game->away_team_goal);
        }
    }

    public function testSimulateWeekUpdatesStandings()
    {
        $this->simulator->generateFixtures();
        $week = Week::first();
        $this->simulator->simulateWeek($week->id);

        $standings = Standing::all();
        $this->assertGreaterThan(0, $standings->count());

        foreach ($standings as $standing) {
            $this->assertGreaterThanOrEqual(0, $standing->played);
            $this->assertGreaterThanOrEqual(0, $standing->points);
            $this->assertIsInt($standing->goal_difference);
        }
    }
}
