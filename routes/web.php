<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', SearchController::class);
Route::get('/blogs', function () {
    return view('blogs');
});
