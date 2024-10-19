<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Certification
 *
 * @property $id
 * @property $ciudad
 * @property $barrio
 * @property $direccion
 * @property $fecha_de_vencimiento
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Certification extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['ciudad', 'barrio', 'direccion', 'fecha_de_vencimiento'];


}
