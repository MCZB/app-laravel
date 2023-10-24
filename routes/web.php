<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/import', [MovieController::class, 'importData']);

Route::get('/', [MovieController::class, 'index']);

Route::get('/movies/popular', [MovieController::class, 'showPopular']);
Route::get('/movies/top_rated', [MovieController::class, 'showTopRated']);
Route::get('/movies/upcoming', [MovieController::class, 'showUpcoming']);
Route::get('/movies/now_playing', [MovieController::class, 'showNowPlaying']);
Route::get('/movies/{posterPath}', [MovieController::class, 'showPoster']);
Route::get('/movies/{type}/{id}', [MovieController::class, 'showDetails']);





