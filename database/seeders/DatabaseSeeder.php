<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Statu;
use App\Models\PaymentMethod;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::factory()->create(['name'=> 'Admin']);
        Role::factory()->create(['name'=> 'Vendedor']);

        Statu::factory()->create(['name'=> 'Pendiente']);
        Statu::factory()->create(['name'=> 'Completado']);
        Statu::factory()->create(['name'=> 'Cancelado']);

        PaymentMethod::factory()->create(['name'=> 'Efectivo']);
        PaymentMethod::factory()->create(['name'=> 'Transacción']);

        $usersData = [
            [
                'name' => 'Diana',
                'role_id'=>'1',
                'lastname' => 'Hernandez',
                'birthdate' => '1990-01-01',
                'phone' => '123456789',
                'address' => 'Dirección 1',
                'nss' => '1234567890',
                'email' => 'diana@gmail.com',
                'password' => bcrypt('diana123'), // Asegúrate de hashear la contraseña
            ],
            [
                'name' => 'Eliud',
                'role_id'=>'2',
                'lastname' => 'Arroyo',
                'birthdate' => '1995-01-01',
                'phone' => '987654321',
                'address' => 'Dirección 2',
                'nss' => '0987654321',
                'email' => 'eliud@gmail.com',
                'password' => bcrypt('eliud123'), // Asegúrate de hashear la contraseña
            ],
        ];

        // Crea los usuarios utilizando los datos proporcionados
        foreach ($usersData as $data) {
            User::create($data);
        }
        
    }
}
