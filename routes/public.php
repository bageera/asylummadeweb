<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ScheduleController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\ResultsController;
use App\Http\Controllers\Public\StandingsController;
use App\Http\Controllers\Public\TeamController as PublicTeamController;
use App\Http\Controllers\Public\DriverController as PublicDriverController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Public-facing routes for schedule, results, standings, and profiles.
| No authentication required.
|
*/

// Schedule
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/schedule/{season}', [ScheduleController::class, 'season'])->name('schedule.season');

// Events
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Results
Route::get('/results', [ResultsController::class, 'index'])->name('results');
Route::get('/results/{season}', [ResultsController::class, 'season'])->name('results.season');
Route::get('/results/{season}/{event}', [ResultsController::class, 'event'])->name('results.event');
Route::get('/results/{season}/{event}/{class}', [ResultsController::class, 'eventClass'])->name('results.event.class');

// Standings
Route::get('/standings', [StandingsController::class, 'index'])->name('standings');
Route::get('/standings/{season}', [StandingsController::class, 'season'])->name('standings.season');
Route::get('/standings/{season}/{class}', [StandingsController::class, 'class'])->name('standings.class');

// Teams
Route::get('/teams', [PublicTeamController::class, 'index'])->name('teams');
Route::get('/teams/{team}', [PublicTeamController::class, 'show'])->name('teams.show');

// Drivers
Route::get('/drivers', [PublicDriverController::class, 'index'])->name('drivers');
Route::get('/drivers/{driver}', [PublicDriverController::class, 'show'])->name('drivers.show');