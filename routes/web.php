<?php

use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [SolicitudController::class, 'card'])->name('dashboard');

    Route::resource('solicituds', SolicitudController::class);

});


Route::get('/facturas', function () {
    return view('prueba.facturas');
});

Route::get('/cotizaciones', function () {
    return view('prueba.cotizaciones');
});


