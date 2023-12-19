<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleMenbresia extends Model
{
    use HasFactory;

    protected $table = 'detalle_menbresia';

    protected $fillable = [
        'cantidad',
        'precio',
        'menbresia_id',
        'nota_venta_id',
    ];

    public function menbresia()
	{
		return $this->belongsTo(Menbresia::class, 'menbresia_id');
	}

    public function notaventa()
	{
		return $this->belongsTo(NotaVenta::class, 'nota_venta_id');
	}
}
