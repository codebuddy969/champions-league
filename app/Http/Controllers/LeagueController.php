<?php

namespace App\Http\Controllers;

use App\Repositories\StandingRepository;
use App\Repositories\TeamRepository;
use App\Services\PredictionService;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Week;

class LeagueController extends BaseController
{
    protected TeamRepository $teamRepo;
    protected StandingRepository $standingRepo;
    protected PredictionService $predictionService;

    public function __construct(
        TeamRepository $teamRepo,
        StandingRepository $standingRepo,
        PredictionService $predictionService
    ) {
        $this->teamRepo = $teamRepo;
        $this->standingRepo = $standingRepo;
        $this->predictionService = $predictionService;
    }

    public function index()
    {
        return view('league.index', [
            'teams' => $this->teamRepo->all(),
            'standings' => $this->standingRepo->all(),
            'predictions' => $this->predictionService->getChampionshipPredictions(),
            'weeklyResults' => Week::with(['games.homeTeam', 'games.awayTeam'])->orderBy('number')->get(),
        ]);
    }
}
