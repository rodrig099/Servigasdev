<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposolicitude
 *
 * @property $id
 * @property $nombreTipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Solicitude[] $solicitudes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tiposolicitude extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombreTipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes()
    {
        return $this->hasMany(\App\Models\Solicitude::class, 'id', 'tiposolicitudes_id');
    }
    

}
