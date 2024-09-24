<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();

        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'AndresG',
            'email' => 'test@example.com',
            'password' => '12345678'
        ])->assignRole('Admin');

    }
}