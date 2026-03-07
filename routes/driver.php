<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Driver\DashboardController;
use App\Http\Controllers\Driver\ProfileController as DriverProfileController;

/*
|--------------------------------------------------------------------------
| Driver Portal Routes
|--------------------------------------------------------------------------
|
| Routes for drivers to view their profile, history, and standings.
| Requires driver role or higher.
|
*/

Route::middleware(['auth', 'role:admin,driver,team_manager'])->prefix('driver')->name('driver.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('profile', [DriverProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [DriverProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/photo', [DriverProfileController::class, 'updatePhoto'])->name('profile.photo');

    // History
    Route::get('history', [DashboardController::class, 'history'])->name('history');

    // Standings
    Route::get('standings', [DashboardController::class, 'standings'])->name('standings');
});