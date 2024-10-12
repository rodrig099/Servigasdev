<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();

        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']); // Hash de la contraseña

        User::create($validatedData);

        return Redirect::route('users.index')
            ->with('success', 'Usuario creado con Exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->filled('password')) {
            // Si la contraseña se proporciona, la hasheamos y la actualizamos
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Mantener la contraseña actual si no se proporciona una nueva
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return Redirect::route('users.index')
            ->with('success', 'Usuario Actualizado con Exito.');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        return Redirect::route('users.index')
            ->with('success', 'Usuario Eliminado del Sistema.');
    }
}