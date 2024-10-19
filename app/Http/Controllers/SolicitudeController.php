<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use App\Models\Tiposolicitude;
use App\Models\User;
use App\Http\Requests\SolicitudeRequest;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */

class SolicitudeController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:Admin.solicitudes.index')->only('create');
        //$this->middleware('can:Admin.tiposolicitudes.edit')->only('edit');
        $this->middleware('can:Tecnico.solicitudes.edit')->only('edit');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        if ($user->hasRole('Admin') || $user->hasRole('Tecnico')) {

            $solicitudes = Solicitude::orderByRaw("FIELD(estatus, 'pendiente') DESC")->paginate();
        } else {

            $solicitudes = Solicitude::where('users_id', $user->id)
                ->orderByRaw("FIELD(estatus, 'pendiente', 'en proceso') DESC")
                ->paginate();
        }

        return view('solicitude.index', compact('solicitudes'))
            ->with('i', (request()->input('page', 1) - 1) * $solicitudes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $solicitude = new Solicitude();
        $tiposolicitude = Tiposolicitude::all('nombreTipo', 'id');

        $user = User::all('name', 'id');
        $tecnicos = User::role('Tecnico')->get(['name', 'id']);

        return view('solicitude.create', compact('solicitude', 'tiposolicitude', 'user', 'tecnicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudeRequest $request)
    {
        /*$tecnico = User::role('Tecnico')->first();

        // Crea la solicitud y asigna el técnico encontrado
        Solicitude::create(array_merge($request->validated(), ['tecnico_id' => $tecnico->id]));

        //Solicitude::create($request->validated());*/
        $tecnicos = User::role('Tecnico')->get(['name', 'id']);

        // Verificar si hay técnicos disponibles
        if ($tecnicos->isEmpty()) {
            return redirect()->route('solicitudes.index')
                ->with('error', 'No hay técnicos disponibles para asignar. De momento no podemos atender tu solicitud.');
        }

        // Seleccionar un técnico aleatorio
        $tecnico = $tecnicos->random();

        // Crea la solicitud y asigna el técnico encontrado
        Solicitude::create(array_merge($request->validated(), ['tecnico_id' => $tecnico->id]));


        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $solicitude = Solicitude::find($id);

        return view('solicitude.show', compact('solicitude'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $solicitude = Solicitude::find($id);
        $tiposolicitude = Tiposolicitude::all('nombreTipo', 'id');
        return view('solicitude.edit', compact('solicitude', 'tiposolicitude'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolicitudeRequest $request, Solicitude $solicitude)
    {
        $solicitude->update($request->validated());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude updated successfully');
    }

    public function destroy($id)
    {
        Solicitude::find($id)->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude deleted successfully');
    }
    public function card()
    {
        $solicitudCount = Solicitude::count(); // Contar los registros
        return view('dashboard', compact('solicitudCount')); // Pasar el conteo a la vista
    }

}