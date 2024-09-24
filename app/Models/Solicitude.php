<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 *
 * @property $id
 * @property $users_id
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


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id', 'tiposolicitudes_id', 'descripcion', 'estatus'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposolicitude()
    {
        return $this->belongsTo(\App\Models\Tiposolicitude::class, 'tiposolicitudes_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }


}