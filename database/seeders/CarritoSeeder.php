<?php

namespace Database\Seeders;

use App\Models\Carrito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        Carrito::create([
            'estado' => '0',
            'cliente_id' => '6'
        ]);

        Carrito::create([
            'estado' => '0',
            'cliente_id' => '7'
        ]);

        Carrito::create([
            'estado' => '0',
            'cliente_id' => '8'
        ]);
    }
}
