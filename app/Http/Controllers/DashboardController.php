<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Solicitude;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function card()
    {
        $facturaCount = Factura::count();
        $pendientesCount = Solicitude::where('estatus', 'PENDIENTE')->count();


        return view('dashboard', compact('facturaCount','pendientesCount')); // Pasar el conteo a la vista
    }
}
