<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class);
Route::get('/search', SearchController::class);
Route::get('/blogs', function () {
    return view('blogs');
});
