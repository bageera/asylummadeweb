<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Static, content-driven pages for asylummadetrack.com
| Blade-first rendering with no controller indirection.
|--------------------------------------------------------------------------
*/

// --------------------------------------------------
// Core pages
// --------------------------------------------------
Route::view('/', 'pages.home')->name('home');

Route::view('/schedule', 'pages.schedule')->name('schedule');

Route::view('/rules', 'pages.rules')->name('rules');

Route::view('/services', 'pages.services')->name('operations');

Route::view('/registration', 'pages.registration')->name('registration');

Route::view('/about', 'pages.about')->name('about');

Route::view('/contact', 'pages.contact')->name('contact');

// --------------------------------------------------
// Legal / informational
// --------------------------------------------------
Route::view('/privacy', 'pages.privacy')->name('privacy');

Route::view('/terms', 'pages.terms')->name('terms');

// --------------------------------------------------
// Route includes
// --------------------------------------------------
require __DIR__ . '/legacy.php';
require __DIR__ . '/season.php';

// --------------------------------------------------
// Fallback (404)
// --------------------------------------------------
Route::fallback(function () {
    return response()
        ->view('errors.404', [], 404);
});
