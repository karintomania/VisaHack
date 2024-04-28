<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));
Route::get('/search', SearchController::class);
Route::get('/blogs', function () {
    return view('blogs');
});
