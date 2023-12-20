<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(CarritoSeeder::class);
        $this->call(MenbresiaSeeder::class);
        $this->call(PagoSeeder::class);
    }
}
