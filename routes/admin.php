<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TeamController;
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

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

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

});