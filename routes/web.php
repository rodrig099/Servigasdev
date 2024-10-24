<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CotizacioneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SolicitudeController;
use App\Http\Controllers\TiposolicitudeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TarjetaproController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileManagerController;

use App\Http\Controllers\FileController;
//use App\Models\Cotizacione;
//use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;





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
    //Facturas
    Route::resource('facturas', FacturaController::class)->middleware('auth');
    //Cotizaciones
    Route::resource('cotizaciones', CotizacioneController::class)->middleware('auth');
    //Certificaciones
    Route::resource('certifications', CertificationController::class)->middleware('auth');
    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])->name('usuario.user.edit')->middleware('auth');
    Route::get('/usuarios/{user}/update', [UsuarioController::class, 'update'])->name('usuario.user.update')->middleware('auth');
    Route::get('/usuarios/{user}/index', [UsuarioController::class, 'index'])->name('usuario.user.index')->middleware('auth');



    Route::resource('tiposolicitudes', TiposolicitudeController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('solicitudes', SolicitudeController::class);
    Route::resource('users', UserController::class);

    Route::get('/users/{id}/details', [TarjetaproController::class, 'getUserDetails'])->middleware('auth');
    Route::resource('tiposolicitudes', TiposolicitudeController::class)->middleware('auth');
    Route::resource('usuarios', UsuarioController::class)->middleware('auth');
    Route::resource('solicitudes', SolicitudeController::class)->middleware('auth');
    Route::resource('users', UserController::class)->middleware('auth');
    Route::resource('tarjetapros', TarjetaproController::class)->middleware('auth');


    ////gestor Archivos/////
    Route::get('/file-manager', [FileManagerController::class, 'index'])->name('file.manager');
    Route::get('/folders', [FileManagerController::class, 'index'])->name('folders.index');
    Route::post('/folders/create', [FileManagerController::class, 'createFolder'])->name('folders.create');
    Route::post('/folders/{folderId}/upload', [FileManagerController::class, 'uploadFile'])->name('files.upload');
    Route::get('/files/download/{id}', [FileManagerController::class, 'download'])->name('files.download');
    Route::delete('/files/{id}', [FileManagerController::class, 'deleteFile'])->name('files.delete');
    Route::delete('/folders/{id}', [FileManagerController::class, 'deleteFolder'])->name('folders.delete');
    Route::get('/folders/{id}', [FileManagerController::class, 'show'])->name('folders.show');
    Route::post('/folders/{id}/rename', [FileManagerController::class, 'renameFolder'])->name('folders.rename');


    Route::get('/roles-permissions', function () {
        $roles = Role::all();
        $permissions = Permission::all();
        return response()->json(['roles' => $roles, 'permissions' => $permissions]);
    });


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


Route::post('/payment-confirmation', [PaymentController::class, 'confirmPayment'])->name('payment.confirmation');
Route::get('/facturas/{id}/check-payment', [FacturaController::class, 'checkPaymentStatus']);