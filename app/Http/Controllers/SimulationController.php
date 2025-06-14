<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Services\LeagueSimulator;
use App\Repositories\MatchRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;

class SimulationController extends BaseController
{
    protected $matchRepo;
    protected $simulator;

    public function __construct(MatchRepository $matchRepo, LeagueSimulator $simulator)
    {
        $this->matchRepo = $matchRepo;
        $this->simulator = $simulator;
    }

    public function simulateWeek(int $weekId): RedirectResponse
    {
        $this->simulator->simulateWeek($weekId);
        return redirect()->back()->with('success', "Week {$weekId} simulated.");
    }

    public function simulateAll(): RedirectResponse
    {
        if ($this->matchRepo->isEmpty()) {
            $this->simulator->generateFixtures();
        }

        $weeks = Week::all();
        foreach ($weeks as $week) {
            $this->simulator->simulateWeek($week->id);
        }
        return redirect()->back()->with('success', 'All weeks simulated.');
    }

    public function resetLeague(): RedirectResponse
    {
        $this->simulator->resetLeague();
        return redirect()->back()->with('success', 'League has been reset.');
    }
}
