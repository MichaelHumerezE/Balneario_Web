<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\producto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(9);
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.catalogo.catalogo', compact('productos', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.catalogo.catalogo', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = producto::get();
        $producto = producto::findOrFail($id);
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.catalogo.product', compact('productos', 'producto', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.catalogo.product', compact('productos', 'producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
