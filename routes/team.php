<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Team\DashboardController;
use App\Http\Controllers\Team\ProfileController;
use App\Http\Controllers\Team\DriverController as TeamDriverController;
use App\Http\Controllers\Team\RegistrationController as TeamRegistrationController;

/*
|--------------------------------------------------------------------------
| Team Portal Routes
|--------------------------------------------------------------------------
|
| Routes for team managers to manage their team, drivers, and registrations.
| Requires team_manager role or admin.
|
*/

Route::middleware(['auth', 'role:admin,team_manager'])->prefix('team')->name('team.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Team Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/logo', [ProfileController::class, 'updateLogo'])->name('profile.logo');

    // Drivers (team's drivers)
    Route::get('drivers', [TeamDriverController::class, 'index'])->name('drivers.index');
    Route::get('drivers/create', [TeamDriverController::class, 'create'])->name('drivers.create');
    Route::post('drivers', [TeamDriverController::class, 'store'])->name('drivers.store');
    Route::get('drivers/{driver}/edit', [TeamDriverController::class, 'edit'])->name('drivers.edit');
    Route::put('drivers/{driver}', [TeamDriverController::class, 'update'])->name('drivers.update');
    Route::delete('drivers/{driver}', [TeamDriverController::class, 'destroy'])->name('drivers.destroy');

    // Event Registrations
    Route::get('registrations', [TeamRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('events', [TeamRegistrationController::class, 'events'])->name('events');
    Route::get('events/{event}', [TeamRegistrationController::class, 'eventDetail'])->name('events.show');
    Route::get('events/{event}/register', [TeamRegistrationController::class, 'registerForm'])->name('events.register');
    Route::post('events/{event}/register', [TeamRegistrationController::class, 'register'])->name('events.register.submit');
    Route::delete('registrations/{registration}', [TeamRegistrationController::class, 'withdraw'])->name('registrations.withdraw');

    // Results & Standings
    Route::get('results', [DashboardController::class, 'results'])->name('results');
    Route::get('standings', [DashboardController::class, 'standings'])->name('standings');
});