<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EpaycoService;
use App\Models\Factura;

class PaymentController extends Controller
{
    protected $epaycoService;

    public function __construct(EpaycoService $epaycoService)
    {
        $this->epaycoService = $epaycoService;
    }

    public function checkout(Factura $factura)
    {
        $factura->load('detalles');
        $users = \App\Models\User::all();
        return view('checkout', compact('factura', 'users'));
    }

    public function processPayment(Request $request)
    {
        $epayco = $this->epaycoService->getEpayco();

        try {
            $response = $epayco->charge->create([
                'token_card' => $request->token_card,
                'customer_id' => $request->customer_id,
                'doc_type' => $request->doc_type,
                'doc_number' => $request->doc_number,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'bill' => $request->bill,
                'description' => $request->description,
                'value' => $request->value,
                'tax' => $request->tax,
                'tax_base' => $request->tax_base,
                'currency' => 'COP',
                'dues' => $request->dues
            ]);

            if ($response->status == 'success') {
                // Procesar el pago exitoso, tal vez guardar la factura o registro
                return redirect()->route('payment.success')->with('success', 'Pago procesado con éxito.');
            } else {
                // Mostrar mensaje de error al usuario
                return redirect()->route('payment.failed')->with('error', 'Error en el procesamiento del pago: ' . $response->status);
            }
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->route('payment.failed')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

}
