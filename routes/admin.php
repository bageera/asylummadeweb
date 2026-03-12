<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\WaiverController;
use App\Http\Controllers\Admin\RegistrationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for league administrators and officials.
| Requires super_user or admin role.
|
*/

Route::middleware(['auth', 'role:super_user,admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Seasons CRUD
    Route::resource('seasons', SeasonController::class)->except(['show', 'destroy']);

    // Events CRUD
    Route::resource('events', EventController::class)->except(['show']);

    // Teams CRUD
    Route::resource('teams', TeamController::class);

    // Drivers (Athletes) CRUD
    Route::resource('drivers', DriverController::class);

    // Users CRUD
    Route::resource('users', UserController::class)->except(['show']);

    // Sponsors CRUD
    Route::resource('sponsors', SponsorController::class)->except(['show']);

    // Waivers CRUD
    Route::resource('waivers', WaiverController::class)->except(['show']);
    Route::get('waivers/{waiver}/signed', [WaiverController::class, 'signedWaivers'])->name('waivers.signed');
    Route::get('waivers/{waiver}/export', [WaiverController::class, 'export'])->name('waivers.export');

    // Registrations CRUD
    Route::resource('registrations', RegistrationController::class)->except(['create', 'store', 'show']);
    Route::get('registrations/event/{event}', [RegistrationController::class, 'event'])->name('registrations.event');
    Route::post('registrations/{registration}/approve', [RegistrationController::class, 'approve'])->name('registrations.approve');
    Route::post('registrations/{registration}/check-in', [RegistrationController::class, 'checkIn'])->name('registrations.check-in');
    Route::post('registrations/{registration}/withdraw', [RegistrationController::class, 'withdraw'])->name('registrations.withdraw');
    Route::post('registrations/{registration}/mark-paid', [RegistrationController::class, 'markPaid'])->name('registrations.mark-paid');
    Route::post('registrations/{registration}/assign-car-number', [RegistrationController::class, 'assignCarNumber'])->name('registrations.assign-car-number');
    Route::get('registrations/export/{event}', [RegistrationController::class, 'export'])->name('registrations.export');

});