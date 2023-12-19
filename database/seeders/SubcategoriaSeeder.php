<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategoria::create([
            'nombre' => 'Desayuno',
            'categoria_id' => 1
        ]);

        Subcategoria::create([
            'nombre' => 'Almuerzo',
            'categoria_id' => 1
        ]);

        Subcategoria::create([
            'nombre' => 'Frituras',
            'categoria_id' => 1
        ]);

        Subcategoria::create([
            'nombre' => 'Gaseosas',
            'categoria_id' => 2
        ]);

        Subcategoria::create([
            'nombre' => 'Alcoholicas',
            'categoria_id' => 2
        ]);

        Subcategoria::create([
            'nombre' => 'Mayores',
            'categoria_id' => 3
        ]);

        Subcategoria::create([
            'nombre' => 'Niños',
            'categoria_id' => 3
        ]);
    }
}
