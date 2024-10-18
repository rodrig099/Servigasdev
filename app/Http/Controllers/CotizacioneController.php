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
                'cotizacione_id' => $cotizacione->id,
                'cantidad' => $cantidad,
                'descripcion' => $detalle['descripcion'] ?? '',
                'precio_unitario' => $precioUnitario,
                'precio_total' => $precioTotal,
            ]);
        }

        // Actualizar el total de la factura
        $cotizacione->update(['total' => (int)$total]);

        return redirect()->route('cotizaciones.index', $cotizacione->id)->with('success', 'Cotización creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cotizacione $cotizacione): View
    {
        $cotizacione->load('detalles');
        $users = \App\Models\User::all();
        return view('cotizacione.show', compact('cotizacione', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotizacione $cotizacione): View
    {
        // Eager load the detalles relationship
        $cotizacione->load('detalles');
        $users = \App\Models\User::all(); // Obtener todos los usuarios
        return view('cotizacione.edit', compact('cotizacione', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CotizacioneRequest $request, Cotizacione $cotizacione)
    {
        // Validación de datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'detalles' => 'required|array',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.descripcion' => 'required|string',
            'detalles.*.precio_unitario' => 'required|string',
        ]);

        // Actualizar la factura
        $cotizacione->update([
            'user_id' => $request->input('user_id'),
            'fecha' => $request->input('fecha'),
            'nota' => $request->input('nota'),
        ]);

        // Eliminar detalles existentes
        $cotizacione->detalles()->delete();

        // Crear nuevos detalles
        $total = 0;
        $detalles = $request->input('detalles', []);

        foreach ($detalles as $detalle) {
            $cantidad = $detalle['cantidad'] ?? 0;
            $precioUnitario = (float)str_replace('.', '', $detalle['precio_unitario'] ?? 0);
            $precioTotal = $cantidad * $precioUnitario;
            $total += $precioTotal;

            CotizacioneDetalle::create([
                'cotizacione_id' => $cotizacione->id,
                'cantidad' => $cantidad,
                'descripcion' => $detalle['descripcion'] ?? '',
                'precio_unitario' => $precioUnitario,
                'precio_total' => $precioTotal,
            ]);
        }

        // Actualizar el total de la cotizacion
        $cotizacione->update(['total' => (int)$total]);

        return redirect()->route('cotizaciones.index')->with('success', 'cotización actualizada exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Cotizacione::find($id)->delete();

        return Redirect::route('cotizaciones.index')
            ->with('success', 'Cotizacione deleted successfully');
    }
}
