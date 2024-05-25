<?php

use App\Http\Controllers\CategoriaServicio\CategoriaServicioController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Inscripcion\InscripcionController;
use App\Http\Controllers\MetodoPago\MetodoPagoController;
use App\Http\Controllers\Pago\PagoController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\PromocionServicio\PromocionServicioController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Venta\VentaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Notifications\NotificationsController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Activar o desactivar la vista de registro
 */
Auth::routes(['register' => true]);

/**
 * Enpoint protegido por defecto
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get(
    'notifications/get',
    [NotificationsController::class, 'getNotificationsData']
)->name('notifications.get');

/**
 * Endpoints
 */
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->only(['index']);
    Route::resource('inscripcion-ingresos', PagoController::class)->only(['index']);
    Route::resource('cliente', ClienteController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('categoria', CategoriaServicioController::class)->only(['index', 'store', 'destroy', 'edit', 'update']);
    Route::resource('metodo-pago', MetodoPagoController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('promocion', PromocionServicioController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('inscripcion', InscripcionController::class)->only(['index', 'store', 'edit', 'update', 'create']);
    Route::resource('producto', ProductoController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('venta', VentaController::class)->only(['index', 'store', 'create']);
    Route::get('clientes/exportar', [ClienteController::class, 'export'])->name('cliente.export');
    Route::get('/inscripcion/{inscripcion}/generar-voucher', [InscripcionController::class, 'printTicket'])->name('generar_ticket');
});
