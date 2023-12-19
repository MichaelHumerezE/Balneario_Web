<?php

namespace Database\Seeders;

use App\Models\Menbresia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenbresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menbresia::create([
            'nombre' => 'Boleto de Entrada',
            'precio' => 150,
            'imagen' => 'menbresias/T1.png',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/menbresias/T1.png',
            'periodo' => 15
        ]);

        Menbresia::create([
            'nombre' => 'Boleto de Entrada',
            'precio' => 250,
            'imagen' => 'menbresias/T2.png',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/menbresias/T2.png',
            'periodo' => 30
        ]);

        Menbresia::create([
            'nombre' => 'Boleto de Entrada',
            'precio' => 300,
            'imagen' => 'menbresias/T3.png',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/menbresias/T3.png',
            'periodo' => 45
        ]);
    }
}
