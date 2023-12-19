<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $fillable = [
        'estado',
        'cliente_id'
	];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}
