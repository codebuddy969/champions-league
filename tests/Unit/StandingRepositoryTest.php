<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\Standing;
use App\Repositories\StandingRepository;

class StandingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected StandingRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new StandingRepository();

        Team::insert([
            ['id' => 1, 'name' => 'Team A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Team B', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Team C', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Standing::insert([
            ['team_id' => 1, 'played' => 3, 'won' => 3, 'draw' => 0, 'lose' => 0, 'goal_difference' => 5, 'points' => 9],
            ['team_id' => 2, 'played' => 3, 'won' => 2, 'draw' => 1, 'lose' => 0, 'goal_difference' => 3, 'points' => 7],
            ['team_id' => 3, 'played' => 3, 'won' => 2, 'draw' => 1, 'lose' => 0, 'goal_difference' => 4, 'points' => 7],
        ]);
    }

    public function testAllReturnsStandingsSortedProperly()
    {
        $standings = $this->repo->all();

        $this->assertCount(3, $standings);
        $this->assertEquals(1, $standings[0]->team_id); // 9 points
        $this->assertEquals(3, $standings[1]->team_id); // 7 pts, GD 4
        $this->assertEquals(2, $standings[2]->team_id); // 7 pts, GD 3
    }

    public function testAllIncludesTeamRelation()
    {
        $standings = $this->repo->all();

        foreach ($standings as $standing) {
            $this->assertTrue($standing->relationLoaded('team'));
            $this->assertNotNull($standing->team->name);
        }
    }
}
