<?php

use App\Http\Controllers\CategoriaServicio\CategoriaServicioController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Inscripcion\InscripcionController;
use App\Http\Controllers\MetodoPago\MetodoPagoController;
use App\Http\Controllers\PromocionServicio\PromocionServicioController;
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
     Route::resource('users', UserController::class)->only([
         'index'
     ]);

    Route::resource('cliente', ClienteController::class)->only([
        'index'
    ]);

    Route::resource('categoria', CategoriaServicioController::class)->only([
        'index'
    ]);

    Route::resource('metodo_pago', MetodoPagoController::class)->only([
        'index'
    ]);

    Route::resource('promocion', PromocionServicioController::class)->only([
        'index'
    ]);
    
    Route::resource('inscripcion', InscripcionController::class)->only([
        'index'
    ]);
});
