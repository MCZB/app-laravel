<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/import', [MovieController::class, 'importData']);
Route::get('/', [MovieController::class, 'showHome'])->name('home');
Route::get('/movies/popular', [MovieController::class, 'showPopular']);
Route::get('/movies/top_rated', [MovieController::class, 'showTopRated']);
Route::get('/movies/upcoming', [MovieController::class, 'showUpcoming']);
Route::get('/movies/now_playing', [MovieController::class, 'showNowPlaying']);
Route::get('/movies/genre/{genreId}',[MovieController::class, 'filterMoviesByGenre']);
Route::get('/movies/{posterPath}', [MovieController::class, 'showPoster']);
Route::get('/movies/{type}/{id}', [MovieController::class, 'showDetails']); 
Route::get('/home/{type}/{id}',[MovieController::class, 'showDetails']); 
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Rotas para o registro de usuários
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rotas para o login de usuários
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Rota para logout de usuários
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');








