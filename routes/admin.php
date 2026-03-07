<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\VehicleClassController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for league administrators and officials.
| Requires admin or official role.
|
*/

Route::middleware(['auth', 'role:admin,official'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Seasons
    Route::resource('seasons', SeasonController::class);
    Route::post('seasons/{season}/set-current', [SeasonController::class, 'setCurrent'])->name('seasons.set-current');

    // Events
    Route::resource('events', EventController::class);
    Route::get('events/{event}/classes', [EventController::class, 'classes'])->name('events.classes');
    Route::post('events/{event}/classes', [EventController::class, 'addClass'])->name('events.classes.add');
    Route::delete('events/{event}/classes/{class}', [EventController::class, 'removeClass'])->name('events.classes.remove');
    Route::post('events/{event}/open-registration', [EventController::class, 'openRegistration'])->name('events.open-registration');
    Route::post('events/{event}/close-registration', [EventController::class, 'closeRegistration'])->name('events.close-registration');

    // Vehicle Classes
    Route::resource('classes', VehicleClassController::class)->parameter('classes', 'vehicleClass');
    Route::post('classes/reorder', [VehicleClassController::class, 'reorder'])->name('classes.reorder');

    // Registrations
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('events/{event}/registrations', [RegistrationController::class, 'eventRegistrations'])->name('events.registrations');
    Route::post('events/{event}/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::put('registrations/{registration}', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::post('registrations/{registration}/checkin', [RegistrationController::class, 'checkin'])->name('registrations.checkin');
    Route::post('registrations/{registration}/withdraw', [RegistrationController::class, 'withdraw'])->name('registrations.withdraw');
    Route::post('registrations/{registration}/mark-paid', [RegistrationController::class, 'markPaid'])->name('registrations.mark-paid');

    // Results
    Route::get('results', [ResultController::class, 'index'])->name('results.index');
    Route::get('events/{event}/results', [ResultController::class, 'eventResults'])->name('events.results');
    Route::post('events/{event}/results', [ResultController::class, 'store'])->name('results.store');
    Route::put('results/{result}', [ResultController::class, 'update'])->name('results.update');
    Route::delete('results/{result}', [ResultController::class, 'destroy'])->name('results.destroy');
    Route::post('events/{event}/results/import', [ResultController::class, 'import'])->name('results.import');
    Route::post('events/{event}/results/publish', [ResultController::class, 'publish'])->name('results.publish');
    Route::post('events/{event}/results/calculate-points', [ResultController::class, 'calculatePoints'])->name('results.calculate-points');

    // Teams
    Route::resource('teams', TeamController::class)->except(['create', 'store']);
    Route::post('teams/{team}/activate', [TeamController::class, 'activate'])->name('teams.activate');
    Route::post('teams/{team}/deactivate', [TeamController::class, 'deactivate'])->name('teams.deactivate');

    // Drivers
    Route::resource('drivers', DriverController::class)->except(['create', 'store']);
    Route::post('drivers/{driver}/activate', [DriverController::class, 'activate'])->name('drivers.activate');
    Route::post('drivers/{driver}/deactivate', [DriverController::class, 'deactivate'])->name('drivers.deactivate');

    // Users (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
        Route::put('users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    });
});