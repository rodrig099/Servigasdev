<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:Admin.usuarios.index')->only('index');
        $this->middleware('can:Admin.usuarios.create')->only('create');
        $this->middleware('can:Admin.usuarios.edit')->only('edit');
        $this->middleware('can:Admin.usuarios.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roles = Role::all();

        return view('usuario.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->roles()->sync($request->roles);

        return redirect()->route('usuario.user.edit', $user)->with('info', 'Se asigno los roles Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}