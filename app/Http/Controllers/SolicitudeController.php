<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use App\Models\Tiposolicitude;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitudeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */
class SolicitudeController extends Controller
{
    public function card()
    {
        $solicitudCount = Solicitude::count(); // Contar los registros
        return view('dashboard', compact('solicitudCount')); // Pasar el conteo a la vista
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Cargar las solicitudes junto con su tipo de solicitud usando `with`
        $solicituds = Solicitude::with('tiposolicitude')->paginate();
        return view('solicitude.index', compact('solicituds'))
            ->with('i', ($request->input('page', 1) - 1) * $solicituds->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $solicitude = new Solicitude();
        $tiposolicitude = Tiposolicitude::all('nombreTipo', 'id');
        return view('solicitude.create', compact('solicitude', 'tiposolicitude'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudeRequest $request)
    {
        Solicitude::create($request->validated());

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
}
