<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\PageVisit;
use App\Models\Producto;
use App\Models\Subcategoria;

class CategoriaShowController extends Controller
{
    public function index()
    {
        $categoriasShow = Subcategoria::paginate(10);
        $subcategorias = Subcategoria::get();
        //Visitas
        $page = 'Catalogo'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        if (auth()->user()) {
            $productos = Producto::get();
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return (view('cliente.categoria.index', compact('categoriasShow', 'pageVisitsCount', 'subcategorias', 'productos', 'carrito', 'detallesCarrito')));
        } else {
            return (view('cliente.categoria.index', compact('categoriasShow', 'pageVisitsCount', 'subcategorias')));
        }
    }

    public function show($id)
    {
        $productos = Producto::get();
        $productosS = Producto::where('subcategoria_id', $id)->paginate(9);
        $categoria = Subcategoria::findOrFail($id);
        $subcategorias = Subcategoria::get();
        //Visitas
        $page = 'Catalogo-Show'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.categoria.show', compact('productos', 'pageVisitsCount', 'subcategorias', 'productosS', 'categoria', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.categoria.show', compact('productos', 'pageVisitsCount', 'subcategorias', 'productosS', 'categoria'));
    }
}
