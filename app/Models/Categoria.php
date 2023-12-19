<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
	use HasFactory;

	protected $table = 'categoria';

	protected $fillable = [
		'nombre',
	];

	public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id', 'id');
    }
}
