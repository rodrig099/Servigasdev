<?php

namespace App\Http\Controllers;

use App\Models\Cotizacione;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CotizacioneRequest;
use App\Models\CotizacioneDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CotizacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener las facturas del usuario autenticado y paginarlas
        $cotizaciones = $user->cotizaciones()->with('detalles')->paginate(10);

        // Devolver la vista con las facturas
        return view('cotizacione.index', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = \App\Models\User::all();
        $cotizacione = new Cotizacione();

        return view('cotizacione.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'detalles' => 'required|array',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.descripcion' => 'required|string',
            'detalles.*.precio_unitario' => 'required|string', // Lo tomamos como string para procesar
        ]);

        // Crear la factura
        $cotizacione = Cotizacione::create([
            'user_id' => $request->input('user_id'),
            'fecha' => $request->input('fecha'),
            'nota' => $request->input('nota'),
            'total' => 0, // Esto se actualizará más tarde
        ]);

        // Crear los detalles de la factura
        $total = 0;
        $detalles = $request->input('detalles', []);

        foreach ($detalles as $detalle) {
            $cantidad = $detalle['cantidad'] ?? 0;
            // Convertir el precio unitario a float eliminando puntos
            $precioUnitario = (float)str_replace('.', '', $detalle['precio_unitario'] ?? 0);
            $precioTotal = $cantidad * $precioUnitario;
            $total += $precioTotal;

            CotizacioneDetalle::create([
                'factura_id' => $cotizacione->id,
                'cantidad' => $cantidad,
                'descripcion' => $detalle['descripcion'] ?? '',
                'precio_unitario' => $precioUnitario,
                'precio_total' => $precioTotal,
            ]);
        }

        // Actualizar el total de la factura
        $cotizacione->update(['total' => (int)$total]);

        return redirect()->route('cotizacione.index', $cotizacione->id)->with('success', 'Cotización creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $cotizacione = Cotizacione::find($id);

        return view('cotizacione.show', compact('cotizacione'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $cotizacione = Cotizacione::find($id);

        return view('cotizacione.edit', compact('cotizacione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CotizacioneRequest $request, Cotizacione $cotizacione): RedirectResponse
    {
        $cotizacione->update($request->validated());

        return Redirect::route('cotizaciones.index')
            ->with('success', 'Cotizacione updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Cotizacione::find($id)->delete();

        return Redirect::route('cotizaciones.index')
            ->with('success', 'Cotizacione deleted successfully');
    }
}
