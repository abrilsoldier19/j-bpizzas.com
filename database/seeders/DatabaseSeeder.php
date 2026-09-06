<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Usuario::firstOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Administrador',
            'password' => bcrypt('12345678'), // Contraseña de prueba para iniciar sesión
            'role_id' => 1,
        ]
    );
        
    }
}
