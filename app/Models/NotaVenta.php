<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
  use HasFactory;

  protected $table = 'nota_venta';

  protected $fillable = [
    'nit',
    'fecha_hora',
    'monto_total',
    'nombre_cliente',
    'usuario_id',
  ];

  public function users()
  {
    return $this->belongsTo(User::class, 'usuario_id');
  }

  public function detallesnotaventasm()
	{
		return $this->hasMany(DetalleMenbresia::class, 'nota_venta_id', 'id');
	}

  public function detallesnotaventasp()
	{
		return $this->hasMany(DetalleNotaVenta::class, 'nota_venta_id', 'id');
	}

  public function pagos()
	{
		return $this->hasMany(Pago::class, 'nota_venta_id', 'id');
	}
}
