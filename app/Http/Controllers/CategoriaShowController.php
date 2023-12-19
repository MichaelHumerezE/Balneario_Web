<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\categoria;
use App\Models\DetalleCarrito;
use App\Models\marca;
use App\Models\producto;
use App\Models\Promocion;
use App\Models\Subcategoria;

class CategoriaShowController extends Controller
{
    public function index()
    {
        $categoriasShow = Subcategoria::paginate(10);
        if (auth()->user()) {
            $productos = producto::get();
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return (view('cliente.categoria.index', compact('categoriasShow', 'productos', 'carrito', 'detallesCarrito')));
        } else {
            return (view('cliente.categoria.index', compact('categoriasShow')));
        }
    }

    public function show($id)
    {
        $productos = producto::get();
        $productosS = producto::where('subcategoria_id', $id)->paginate(9);
        $categoria = Subcategoria::findOrFail($id);
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.categoria.show', compact('productos', 'productosS', 'categoria', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.categoria.show', compact('productos', 'productosS', 'categoria'));
    }
}
