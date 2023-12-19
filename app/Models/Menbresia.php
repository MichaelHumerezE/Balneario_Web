<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menbresia extends Model
{
    use HasFactory;

    protected $table = 'menbresia';

    protected $fillable = [
        'nombre',
        'precio',
        'imagen',
        'url',
        'periodo'
    ];

    public function detallesmenbresias()
	{
		return $this->hasMany(DetalleMenbresia::class, 'menbresia_id', 'id');
	}
}
