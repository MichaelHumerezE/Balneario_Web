<?php

namespace Database\Seeders;

use App\Models\producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        producto::create([
            'nombre' => 'Pique Macho',
            'descripcion' => 'Pique Macho',
            'stock' => 15,
            'precio' => 45,
            'imagen' => 'productos/Pique_Macho.jpg',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/productos/Pique_Macho.jpg',
            'subcategoria_id' => 2
        ]);

        producto::create([
            'nombre' => 'Chicharron',
            'descripcion' => 'Chicharron',
            'stock' => 15,
            'precio' => 45,
            'imagen' => 'productos/Chicharron.jpg',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/productos/Chicharron.jpg',
            'subcategoria_id' => 2
        ]);

        producto::create([
            'nombre' => 'Empanada de Queso',
            'descripcion' => 'Empanada de Queso',
            'stock' => 30,
            'precio' => 5,
            'imagen' => 'productos/Empanada_De_Queso.jpg',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/productos/Empanada_De_Queso.jpg',
            'subcategoria_id' => 1
        ]);

        producto::create([
            'nombre' => 'Coca Cola 2 Lts',
            'descripcion' => 'Coca Cola 2 Lts',
            'stock' => 40,
            'precio' => 15,
            'imagen' => 'productos/Coca_Cola_2Lts.jpg',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/productos/Coca_Cola_2Lts.jpg',
            'subcategoria_id' => 4
        ]);

        producto::create([
            'nombre' => 'Boleto de Entrada',
            'descripcion' => 'Boleto de Entrada',
            'stock' => 50,
            'precio' => 25,
            'imagen' => 'productos/Ticket.png',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/productos/Ticket.png',
            'subcategoria_id' => 6
        ]);
    }
}
