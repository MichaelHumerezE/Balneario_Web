<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
	use HasFactory;

	protected $table = 'subcategoria';

	protected $fillable = [
		'nombre',
		'categoria_id',
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'categoria_id');
	}

	public function productos()
	{
		return $this->hasMany(Producto::class, 'subcategoria_id', 'id');
	}
}
