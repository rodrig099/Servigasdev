<?php

use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SolicitudeController;
use App\Http\Controllers\TiposolicitudeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware([
// 'auth:sanctum',
//config('jetstream.auth_session'),
//'verified',
//])->group(function () {

//  Route::get('/dashboard', [SolicitudeController::class, 'card'])->name('dashboard');



//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [SolicitudeController::class, 'card'])->name('dashboard');

    Route::resource('solicitudes', SolicitudeController::class);
    Route::resource('tiposolicitudes', TiposolicitudeController::class);
    Route::resource('facturas', FacturaController::class);
    Route::resource('users', UserController::class);
});




Route::get('/cotizaciones', function () {
    return view('prueba.cotizaciones.index');
});

Route::get('/acta', function () {
    return view('actadeentrega');
});


