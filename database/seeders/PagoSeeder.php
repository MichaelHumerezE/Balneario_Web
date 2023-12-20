<?php

namespace Database\Seeders;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaVenta;
use App\Models\NotaVenta;
use App\Models\Pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detalle = DetalleCarrito::create([
            'cantidad' => '2',
            'precio' => '45',
            'producto_id' => '1',
            'carrito_id' => '3',
            'created_at' => '2023-12-06 17:35:17',
            'updated_at' => '2023-12-06 17:35:17',
        ]);

        $notaVenta = NotaVenta::create([
            'nit' => '9866028',
            'fecha_hora' => '2023-12-06 17:35:17',
            'monto_total' => '90',
            'nombre_cliente' => 'Juan Carlos Contreras',
            'usuario_id' => '8',
            'created_at' => '2023-12-06 17:35:17',
            'updated_at' => '2023-12-06 17:35:17',
        ]);

        DetalleNotaVenta::create([
            'cantidad' => '2',
            'precio' => '45',
            'producto_id' => '1',
            'nota_venta_id' => $notaVenta->id,
            'created_at' => '2023-12-06 17:35:17',
            'updated_at' => '2023-12-06 17:35:17',
        ]);

        Pago::create([
            'monto_total' => '90',
            'fecha_hora' => '2023-12-06 17:35:17',
            'estado' => 0,
            'tipo' => 'Pago Facil',
            'nota_venta_id' => $notaVenta->id,
            'imagen' => 'pagos/1701899220968.png',
            'url' => 'https://bucket-balneario-playa-caribe.s3.amazonaws.com/pagos/1701899220968.png',
            'pago_facil_id' => '1171807',
            'created_at' => '2023-12-06 17:35:17',
            'updated_at' => '2023-12-06 17:35:17',
        ]);

        $carrito = Carrito::findOrFail($detalle->carrito_id);

        $carrito->estado = 1;

        Carrito::create([
            'estado' => 0,
            'cliente_id' => 8,
            'created_at' => '2023-12-06 17:35:17',
            'updated_at' => '2023-12-06 17:35:17',
        ]);
    }
}
