<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Legacy Routes
|--------------------------------------------------------------------------
| URL redirects and preserved paths from previous versions
| or external references. All legacy behavior lives here.
|--------------------------------------------------------------------------
*/

// Example legacy redirects (safe placeholders)

Route::redirect('/events', '/schedule', 301);
Route::redirect('/rules-and-classes', '/rules', 301);
Route::redirect('/sign-up', '/registration', 301);
