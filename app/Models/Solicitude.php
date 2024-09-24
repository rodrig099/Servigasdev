<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 *
 * @property $id
 * @property $tiposolicitudes_id
 * @property $descripcion
 * @property $estatus
 * @property $created_at
 * @property $updated_at
 *
 * @property Tiposolicitude $tiposolicitude
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Solicitude extends Model
{
    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tiposolicitudes_id', 'descripcion', 'estatus'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposolicitude()
    {
        return $this->belongsTo(\App\Models\Tiposolicitude::class, 'tiposolicitudes_id', 'id');
    }
}
