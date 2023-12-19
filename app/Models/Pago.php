<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';

    protected $fillable = [
        'monto_total',
        'fecha_hora',
        'estado',
        'tipo',
        'nota_venta_id',
        'imagen',
        'url',
        'pago_facil_id'
    ];

    public function notaventa()
    {
        return $this->belongsTo(NotaVenta::class, 'nota_venta_id');
    }
}
