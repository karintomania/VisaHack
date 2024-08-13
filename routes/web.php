<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobPost;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class);
Route::get('/search', SearchController::class);
Route::get('/jobs/{id}', JobPost::class);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{slug}', [BlogController::class, 'article']);
