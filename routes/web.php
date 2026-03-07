<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Static, content-driven pages for asylummadetrack.com
| Plus dynamic routes for track league management.
|--------------------------------------------------------------------------
*/

// --------------------------------------------------
// Core pages (static Blade views)
// --------------------------------------------------
Route::view('/', 'pages.home')->name('home');
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
// Legacy redirects
// --------------------------------------------------
require __DIR__ . '/legacy.php';

// --------------------------------------------------
// Dynamic public routes (schedule, results, standings)
// --------------------------------------------------
require __DIR__ . '/public.php';

// --------------------------------------------------
// Authentication routes (Laravel Breeze/Fortify style)
// --------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::view('forgot-password', 'auth.forgot-password')->name('password.request');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// --------------------------------------------------
// Portal routes (require authentication + roles)
// --------------------------------------------------
require __DIR__ . '/admin.php';
require __DIR__ . '/team.php';
require __DIR__ . '/driver.php';

// --------------------------------------------------
// Fallback (404)
// --------------------------------------------------
Route::fallback(function () {
    return response()
        ->view('errors.404', [], 404);
});
