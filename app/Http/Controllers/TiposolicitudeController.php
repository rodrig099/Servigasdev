<?php

namespace App\Http\Controllers;

use App\Models\Tiposolicitude;
use App\Http\Requests\TiposolicitudeRequest;
use App\Http\Controllers\Tiposolicitude\middleware;


/**
 * Class TiposolicitudeController
 * @package App\Http\Controllers
 */
class TiposolicitudeController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposolicitudes = Tiposolicitude::paginate();

        return view('tiposolicitude.index', compact('tiposolicitudes'))
            ->with('i', (request()->input('page', 1) - 1) * $tiposolicitudes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposolicitude = new Tiposolicitude();
        return view('tiposolicitude.create', compact('tiposolicitude'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposolicitudeRequest $request)
    {
        Tiposolicitude::create($request->validated());

        return redirect()->route('tiposolicitudes.index')
            ->with('success', 'Tiposolicitude created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tiposolicitude = Tiposolicitude::find($id);

        return view('tiposolicitude.show', compact('tiposolicitude'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tiposolicitude = Tiposolicitude::find($id);

        return view('tiposolicitude.edit', compact('tiposolicitude'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiposolicitudeRequest $request, Tiposolicitude $tiposolicitude)
    {
        $tiposolicitude->update($request->validated());

        return redirect()->route('tiposolicitudes.index')
            ->with('success', 'Tiposolicitude updated successfully');
    }

    public function destroy($id)
    {
        Tiposolicitude::find($id)->delete();

        return redirect()->route('tiposolicitudes.index')
            ->with('success', 'Tiposolicitude deleted successfully');
    }
}