<?php

use App\Http\Controllers\SolicitudeController;
use App\Http\Controllers\TiposolicitudeController;
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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('solicitudes', SolicitudeController::class);
Route::resource('tiposolicitudes', TiposolicitudeController::class);

Route::get('/facturas', function () {
    return view('prueba.facturas');
});

Route::get('/cotizaciones', function () {
    return view('prueba.cotizaciones');
});