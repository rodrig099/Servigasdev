<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(["name" => "Admin"]);
        $role2 = Role::create(["name" => "Usuario"]);
        $role3 = Role::create(["name" => "Tecnico"]);

        Permission::create(["name" => "dashboard"])->syncRoles([$role1, $role2, $role3]);

        Permission::create(["name" => "Admin.solicitudes.index"])->syncRoles([$role1, $role2, $role3]);
        Permission::create(["name" => "Admin.solicitudes.create"])->syncRoles([$role1, $role2]);
        Permission::create(["name" => "Admin.solicitudes.edit"])->syncRoles([$role1, $role3]);
        Permission::create(["name" => "Admin.solicitudes.destroy"])->syncRoles([$role1, $role3]);

        Permission::create(["name" => "Admin.tiposolicitudes.index"])->syncRoles([$role1]);
        Permission::create(["name" => "Admin.tiposolicitudes.create"])->syncRoles([$role1]);
        Permission::create(["name" => "Admin.tiposolicitudes.edit"])->syncRoles([$role1]);
        Permission::create(["name" => "Admin.tiposolicitudes.destroy"])->syncRoles([$role1]);

        Permission::create(["name" => "Admin.facturas.index"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.facturas.create"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.facturas.edit"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.facturas.destroy"])->assignRole([$role1]);

        Permission::create(["name" => "Admin.cotizaciones.index"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.cotizaciones.create"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.cotizaciones.edit"])->assignRole([$role1]);
        Permission::create(["name" => "Admin.cotizaciones.destroy"])->assignRole([$role1]);

    }
}