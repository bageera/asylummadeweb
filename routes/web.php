<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Static, content-driven pages for nocturnalinc.com
| Blade-first, no controller indirection required.
|--------------------------------------------------------------------------
*/

Route::view('/', 'pages.home')->name('home');

Route::view('/services', 'pages.services')->name('services');

Route::view('/about', 'pages.about')->name('about');

Route::view('/contact', 'pages.contact')->name('contact');

Route::view('/privacy', 'pages.privacy')->name('privacy');

Route::view('/terms', 'pages.terms')->name('terms');
