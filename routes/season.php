<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Season Routes
|--------------------------------------------------------------------------
| Future-facing routes for season-specific content.
| Currently static placeholders.
|--------------------------------------------------------------------------
*/

Route::prefix('season')->group(function () {

    // Example:
    // /season/2025/schedule
    Route::view('{year}/schedule', 'pages.schedule')
        ->whereNumber('year')
        ->name('season.schedule');

    // /season/2025/results
    Route::view('{year}/results', 'pages.schedule')
        ->whereNumber('year')
        ->name('season.results');

});
