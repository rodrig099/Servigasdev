<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;



class AssignUserRole
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        // Asignar el rol de "Usuario" al usuario recién registrado
        $user = $event->user;

        // Si usas Spatie, asigna el rol con el método `assignRole`
        $user->assignRole('Usuario');
    }

}