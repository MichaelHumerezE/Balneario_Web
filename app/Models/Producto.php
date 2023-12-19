<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'precio',
        'imagen',
        'url',
        'subcategoria_id',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    public function detallesnotaventas()
	{
		return $this->hasMany(DetalleNotaVenta::class, 'producto_id', 'id');
	}

    public function detallescarritos()
	{
		return $this->hasMany(DetalleCarrito::class, 'producto_id', 'id');
	}
}
