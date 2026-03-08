<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Team\TeamController;

/*
|--------------------------------------------------------------------------
| Team Portal Routes
|--------------------------------------------------------------------------
|
| Routes for team managers to manage their team, athletes, and registrations.
| Requires team_manager role.
|
*/

Route::middleware(['auth', 'role:team_manager'])->prefix('team')->name('team.')->group(function () {

    // Dashboard
    Route::get('/', [TeamController::class, 'index'])->name('dashboard');

    // Team Profile
    Route::get('edit', [TeamController::class, 'edit'])->name('edit');
    Route::put('update', [TeamController::class, 'update'])->name('update');

    // Athletes Management
    Route::get('athletes', [TeamController::class, 'athletes'])->name('athletes');
    Route::get('athletes/create', [TeamController::class, 'createAthlete'])->name('athletes.create');
    Route::post('athletes', [TeamController::class, 'storeAthlete'])->name('athletes.store');
    Route::delete('athletes/{athlete}', [TeamController::class, 'removeAthlete'])->name('athletes.destroy');

});