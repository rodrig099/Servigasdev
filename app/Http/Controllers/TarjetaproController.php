<?php

namespace App\Http\Controllers;

use App\Models\Tarjetapro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TarjetaproRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TarjetaproController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tarjetapros = Tarjetapro::paginate();
        $users = \App\Models\User::all();

        return view('tarjetapro.index', compact('tarjetapros'))
            ->with('i', ($request->input('page', 1) - 1) * $tarjetapros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tarjetapro = new Tarjetapro();
        $users = \App\Models\User::all();

        return view('tarjetapro.create', compact('tarjetapro', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TarjetaproRequest $request): RedirectResponse
    {
        Tarjetapro::create($request->validated());

        return Redirect::route('tarjetapros.index')
            ->with('success', 'Tecnico Creado con Exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tarjetapro = Tarjetapro::find($id);

        return view('tarjetapro.show', compact('tarjetapro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tarjetapro = Tarjetapro::find($id);
        $users = \App\Models\User::all();

        return view('tarjetapro.edit', compact('tarjetapro', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TarjetaproRequest $request, Tarjetapro $tarjetapro): RedirectResponse
    {
        //$tarjetapro->update($request->validated());
        $tarjetapro->update($request->validated() + ['user_id' => $request->user_id]);

        return Redirect::route('tarjetapros.index')
            ->with('success', 'Tecnico Actualizado con exito.');
    }

    public function destroy($id): RedirectResponse
    {
        Tarjetapro::find($id)->delete();

        return Redirect::route('tarjetapros.index')
            ->with('success', 'Registro Eliminado con exito.');
    }

    public function getUserDetails($id)
    {
        $user = \App\Models\User::find($id);

        if ($user) {
            return response()->json([
                'name' => $user->name,
                'apellidos' => $user->apellidos,
                'cedula' => $user->cedula,
                'telefono' => $user->telefono
            ]);
        }

        return response()->json([], 404); // Si no encuentra el usuario
    }
}