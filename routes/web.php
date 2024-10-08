<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SolicitudeController;
use App\Http\Controllers\TiposolicitudeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
<<<<<<< HEAD
=======
use App\Http\Controllers\TarjetaproController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



>>>>>>> 0b1774de607c08dea464bbeda3b431df0df03edd
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('facturas/pdf', [FacturaController::class, 'pdf'])->name('facturas.pdf')->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'card'])->name('dashboard');
    Route::get('/solicitude', function () {
        return view('solicitude.show');
    })->name('solicitude');
    Route::resource('facturas', FacturaController::class)->middleware('auth');
    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])->name('usuario.user.edit')->middleware('auth');
    Route::get('/usuarios/{user}/update', [UsuarioController::class, 'update'])->name('usuario.user.update')->middleware('auth');
<<<<<<< HEAD
    Route::resource('tiposolicitudes', TiposolicitudeController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('solicitudes', SolicitudeController::class);
    Route::resource('users', UserController::class);
=======
    Route::get('/users/{id}/details', [TarjetaproController::class, 'getUserDetails'])->middleware('auth');
    Route::resource('tiposolicitudes', TiposolicitudeController::class)->middleware('auth');
    Route::resource('usuarios', UsuarioController::class)->middleware('auth');
    Route::resource('solicitudes', SolicitudeController::class)->middleware('auth');
    Route::resource('users', UserController::class)->middleware('auth');
    Route::resource('tarjetapros', TarjetaproController::class)->middleware('auth');



    Route::get('/roles-permissions', function () {
        $roles = Role::all();
        $permissions = Permission::all();
        return response()->json(['roles' => $roles, 'permissions' => $permissions]);
    });

>>>>>>> 0b1774de607c08dea464bbeda3b431df0df03edd
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

