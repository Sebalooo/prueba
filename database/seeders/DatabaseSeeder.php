<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Storage::deleteDirectory('adjuntos');
        Storage::makeDirectory('adjuntos');
        
        $this->call(UnidadSeeder::class);
        $this->call(DetalleSeeder::class);
        $this->call(InventarioSeeder::class);
        //$this->call(RepuestoSeeder::class);
      
        $this->call(RoleSeeder::class); 
        
        $this->call(UserSeeder::class);
    }
}
