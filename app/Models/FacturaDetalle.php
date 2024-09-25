<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['factura_id', 'cantidad', 'descripcion', 'precio_unitario', 'precio_total'];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
}
