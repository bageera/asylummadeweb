<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\WaiverController;

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

    // Users CRUD
    Route::resource('users', UserController::class)->except(['show']);

    // Sponsors CRUD
    Route::resource('sponsors', SponsorController::class)->except(['show']);

    // Waivers CRUD
    Route::resource('waivers', WaiverController::class)->except(['show']);
    Route::get('waivers/{waiver}/signed', [WaiverController::class, 'signedWaivers'])->name('waivers.signed');
    Route::get('waivers/{waiver}/export', [WaiverController::class, 'export'])->name('waivers.export');

});