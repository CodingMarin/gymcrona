<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

/**
 * Enpoint protegido por defecto
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/**
 * Endpoints
 */

Route::middleware(['auth'])->group(function () {
    // Route::resource('users', UserController::class)->only([
    //     'index'
    // ]);
});
