<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\PageVisit;
use App\Models\Producto;
use App\Models\Subcategoria;
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
        //Visitas
        $page = 'Catalogo-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $productos = Producto::paginate(9);
        $subcategorias = Subcategoria::get();
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.catalogo.catalogo', compact('productos', 'pageVisitsCount', 'subcategorias', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.catalogo.catalogo', compact('productos', 'pageVisitsCount', 'subcategorias'));
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
        $productos = Producto::get();
        $producto = Producto::findOrFail($id);
        $subcategorias = Subcategoria::get();
        //Visitas
        $page = 'Catalogo-Product'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        if (auth()->user()) {
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            return view('cliente.catalogo.product', compact('productos', 'pageVisitsCount', 'subcategorias', 'producto', 'carrito', 'detallesCarrito'));
        }
        return view('cliente.catalogo.product', compact('productos', 'pageVisitsCount', 'producto', 'subcategorias'));
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
