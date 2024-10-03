<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use Illuminate\Support\Facades\Auth;


class FacturaController extends Controller
{
    /**
     * Display a listing of the invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener las facturas del usuario autenticado y paginarlas
        $facturas = $user->facturas()->with('detalles')->paginate(10);

        // Devolver la vista con las facturas
        return view('facturas.index', compact('facturas'));
    }


    /**
     * Show the form for creating a new invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('facturas.create', compact('users'));
    }

    /**
     * Store a newly created invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $factura = Factura::create([
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

            FacturaDetalle::create([
                'factura_id' => $factura->id,
                'cantidad' => $cantidad,
                'descripcion' => $detalle['descripcion'] ?? '',
                'precio_unitario' => $precioUnitario,
                'precio_total' => $precioTotal,
            ]);
        }

        // Actualizar el total de la factura
        $factura->update(['total' => (int)$total]);

        return redirect()->route('facturas.index', $factura->id)->with('success', 'Factura creada exitosamente.');
    }
    /**
     * Display the specified invoice.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        // Eager load the detalles relationship
        $factura->load('detalles');
        $users = \App\Models\User::all();
        return view('facturas.show', compact('factura', 'users'));
    }
    /**
     * Show the form for editing the specified invoice.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        // Eager load the detalles relationship
        $factura->load('detalles');
        $users = \App\Models\User::all(); // Obtener todos los usuarios
        return view('facturas.edit', compact('factura', 'users'));
    }

    /**
     * Update the specified invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
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
        $factura->update([
            'user_id' => $request->input('user_id'),
            'fecha' => $request->input('fecha'),
            'nota' => $request->input('nota'),
        ]);

        // Eliminar detalles existentes
        $factura->detalles()->delete();

        // Crear nuevos detalles
        $total = 0;
        $detalles = $request->input('detalles', []);

        foreach ($detalles as $detalle) {
            $cantidad = $detalle['cantidad'] ?? 0;
            $precioUnitario = (float)str_replace('.', '', $detalle['precio_unitario'] ?? 0);
            $precioTotal = $cantidad * $precioUnitario;
            $total += $precioTotal;

            FacturaDetalle::create([
                'factura_id' => $factura->id,
                'cantidad' => $cantidad,
                'descripcion' => $detalle['descripcion'] ?? '',
                'precio_unitario' => $precioUnitario,
                'precio_total' => $precioTotal,
            ]);
        }

        // Actualizar el total de la factura
        $factura->update(['total' => (int)$total]);

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    /**
     * Remove the specified invoice from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        // Delete the invoice and its details
        $factura->detalles()->delete();
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Invoice deleted successfully.');
    }

    public function card()
    {
        $facturaCount = Factura::count(); // Contar los registros

        return view('dashboard', compact('facturaCount')); // Pasar el conteo a la vista
    }
}
