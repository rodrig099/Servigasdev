<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacione extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fecha', 'nota', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(CotizacioneDetalle::class);
    }
}
