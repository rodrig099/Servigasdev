<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarjetapro
 *
 * @property $id
 * @property $user_id
 * @property $codigo
 * @property $expedido
 * @property $vigencia
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarjetapro extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'codigo', 'expedido', 'vigencia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
