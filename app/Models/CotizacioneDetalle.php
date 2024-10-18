<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacioneDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['cotizacione_id', 'cantidad', 'descripcion', 'precio_unitario', 'precio_total'];

    public function factura()
    {
        return $this->belongsTo(Cotizacione::class);
    }
}
