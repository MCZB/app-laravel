<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/import', [MovieController::class, 'importData']);
Route::get('/', [MovieController::class, 'showPopular']);
Route::get('/movies/popular', [MovieController::class, 'showPopular']);
Route::get('/movies/top_rated', [MovieController::class, 'showTopRated']);
Route::get('/movies/upcoming', [MovieController::class, 'showUpcoming']);
Route::get('/movies/now_playing', [MovieController::class, 'showNowPlaying']);
Route::get('/movies/{posterPath}', [MovieController::class, 'showPoster']);
Route::get('/movies/{type}/{id}', [MovieController::class, 'showDetails']);
Route::get('/home',[MovieController::class, 'showPopular']);
Route::get('/movies/{id}',[MovieController::class, 'show']);

