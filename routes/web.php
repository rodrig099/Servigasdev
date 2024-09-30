<?php

use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SolicitudeController;
use App\Http\Controllers\TiposolicitudeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [SolicitudeController::class, 'card'])->name('dashboard');
    Route::get('/solicitude', function () {
        return view('solicitude.show');
    })->name('solicitude');
    Route::resource('facturas', FacturaController::class);
    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])->name('usuario.user.edit')->middleware('auth');
    Route::get('/usuarios/{user}/update', [UsuarioController::class, 'update'])->name('usuario.user.update')->middleware('auth');
    Route::resource('tiposolicitudes', TiposolicitudeController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('solicitudes', SolicitudeController::class);
    Route::resource('users', UserController::class);
});

use App\Http\Controllers\PaymentController;

Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', function () {
    return 'pago exitoso!';
})->name('payment.success');
Route::get('/payment-failed', function () {
    return 'Payment failed. Please try again.';
})->name('payment.failed');

