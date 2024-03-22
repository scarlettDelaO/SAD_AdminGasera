<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Statu;


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
        
    }
}
