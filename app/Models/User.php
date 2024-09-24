<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $two_factor_secret
 * @property $two_factor_recovery_codes
 * @property $two_factor_confirmed_at
 * @property $remember_token
 * @property $current_team_id
 * @property $profile_photo_path
 * @property $created_at
 * @property $updated_at
 * @property $apellidos
 * @property $direccion
 * @property $telefono
 * @property $barrio
 * @property $ciudad
 * @property $departamento
 * @property $cedula
 *
 * @property Factura[] $facturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellidos',
        'direccion',
        'telefono',
        'barrio',
        'ciudad',
        'departamento',
        'cedula'];


         /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

}
