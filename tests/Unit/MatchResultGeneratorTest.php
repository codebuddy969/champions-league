<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\MatchResultGenerator;

class MatchResultGeneratorTest extends TestCase
{
    protected MatchResultGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generator = new MatchResultGenerator();
    }

    public function testGenerateGoalsReturnsTwoIntegers()
    {
        [$homeGoals, $awayGoals] = $this->generator->generateGoals(50, 50);

        $this->assertIsInt($homeGoals);
        $this->assertIsInt($awayGoals);
    }

    public function testStrongerTeamTendsToScoreMore()
    {
        $strongTeamGoals = 0;
        $weakTeamGoals = 0;

        for ($i = 0; $i < 100; $i++) {
            [$home, $away] = $this->generator->generateGoals(90, 10);
            $strongTeamGoals += $home;
            $weakTeamGoals += $away;
        }

        $this->assertGreaterThan($weakTeamGoals, $strongTeamGoals, "Stronger team should score more on average.");
    }

    public function testLowStrengthTeamsScoreLow()
    {
        $totalGoals = 0;

        for ($i = 0; $i < 100; $i++) {
            [$home, $away] = $this->generator->generateGoals(10, 10);
            $totalGoals += $home + $away;
        }

        $this->assertLessThanOrEqual(200, $totalGoals, "Low strength teams should have modest total goals.");
    }

    public function testHighStrengthTeamsScoreHigh()
    {
        $totalGoals = 0;

        for ($i = 0; $i < 100; $i++) {
            [$home, $away] = $this->generator->generateGoals(90, 90);
            $totalGoals += $home + $away;
        }

        $this->assertGreaterThanOrEqual(250, $totalGoals, "High strength teams should score more goals.");
    }
}
