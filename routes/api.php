<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/{cedula}', function($cedula) {
    $user = User::where('cedula', $cedula)->first();
    if ($user) {
        return response()->json([
            'id' => $user->id,
            'nombre' => $user->name,
            'apellidos' => $user->apellidos,
            'direccion' => $user->direccion,
            'barrio' => $user->barrio,
            'ciudad' => $user->ciudad,
            'departamento' => $user->departamento,
        ]);
    } else {
        return response()->json(null, 404);
    }
});
