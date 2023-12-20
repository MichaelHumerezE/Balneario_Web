<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\PageVisit;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class PagoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $notasVentas = $user->notaventas;

        // Inicializa un array para almacenar los pagos
        $todosLosPagos = [];

        // Itera sobre cada nota de venta y obtén los pagos asociados
        foreach ($notasVentas as $notaVenta) {
            $pagos = $notaVenta->pagos;
            $todosLosPagos = array_merge($todosLosPagos, $pagos->toArray());
        }

        //Defecto
        $productos = Producto::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::get();

        $subcategorias = Subcategoria::get();

        //Visitas
        $page = 'PagosClientes-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //

        return view('cliente.pagos.index', compact('todosLosPagos', 'pageVisitsCount', 'subcategorias', 'productos', 'carrito', 'detallesCarrito'));
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
        $pago = Pago::findOrFail($id);

        //Defecto
        $productos = Producto::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::get();
        $subcategorias = Subcategoria::get();

        //Visitas
        $page = 'PagosQR-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        return view('cliente.pagos.show', compact('pago', 'pageVisitsCount', 'subcategorias', 'productos', 'carrito', 'detallesCarrito'));
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
