<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use App\Models\Tiposolicitude;
use App\Http\Requests\SolicitudeRequest;

/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */
class SolicitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = Solicitude::paginate();

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