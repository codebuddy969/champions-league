<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SimulationController;

Route::get('/', [LeagueController::class, 'index'])->name('league.index');

Route::prefix('simulate')->group(function () {
    Route::post('/week/{weekId}', [SimulationController::class, 'simulateWeek'])->name('simulate.week');
    Route::post('/all', [SimulationController::class, 'simulateAll'])->name('simulate.all');
    Route::post('/reset', [SimulationController::class, 'resetLeague'])->name('simulate.reset');
});
