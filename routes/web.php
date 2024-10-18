<?php

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
use App\Http\Controllers\FileController;
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

    Route::middleware(['auth'])->group(function () {
        Route::get('/files', [FileController::class, 'index'])->name('files.index');
        Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
        Route::post('/files', [FileController::class, 'store'])->name('files.store');
        Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');
        Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
        Route::get('/files/folder/{folder_name}', [FileController::class, 'show'])->name('files.show');
        Route::get('/files/{file}', [FileController::class, 'show'])->name('files.show');
        Route::get('/files/{id}', [FileController::class, 'getFile'])->name('files.getFile');
        Route::delete('/folders/{id}', [FileController::class, 'destroyFolder'])->name('folders.destroy');
        Route::patch('/folders/{id}/rename', [FileController::class, 'renameFolder'])->name('folders.rename');
        Route::post('/files/create-folder', [FileController::class, 'createFolder'])->name('files.create.folder');
        Route::post('/files/upload/{folderName}/{subfolderName}', [FileController::class, 'uploadFile'])->name('files.upload');
        Route::get('/files/folder/{folder_name}', [FileController::class, 'showFolderContents'])->name('files.showFolder');
    });

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