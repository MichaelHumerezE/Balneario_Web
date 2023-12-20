<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaVenta;
use App\Models\NotaVenta;
use App\Models\PageVisit;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Http\Request;

class NotaVentaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::get();
        $productos = Producto::get();
        $detallesCarrito = DetalleCarrito::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $notaVentas = NotaVenta::where('usuario_id', auth()->user()->id)->paginate(10);
        $subcategorias = Subcategoria::get();
        //Visitas
        $page = 'NotaVentaCliente-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        return view('cliente.NotaVentaCliente.index', compact('notaVentas', 'pageVisitsCount', 'subcategorias', 'carrito', 'detallesCarrito', 'productos', 'pagos'));
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
        $notaVentas = NotaVenta::findOrFail($id);
        $detallesNotaVenta = DetalleNotaVenta::where('nota_venta_id', $id)->paginate(10);
        $productos = Producto::get();
        $detallesCarrito = DetalleCarrito::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $subcategorias = Subcategoria::get();
        //Visitas
        $page = 'DetalleNotaVentaCliente-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        return view('cliente.NotaVentaCliente.show', compact('notaVentas', 'pageVisitsCount', 'subcategorias', 'detallesCarrito', 'productos', 'detallesNotaVenta', 'carrito'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Factura
        $notaVenta = NotaVenta::findOrFail($id);
        $user = User::findOrfail($notaVenta->usuario_id);
        $pago = Pago::where('nota_venta_id', $notaVenta->id)->first();
        $productos = producto::get();
        $detallesNotaVenta = DetalleNotaVenta::get()->where('nota_venta_id', $notaVenta->id);
        $subcategorias = Subcategoria::get();
        return view('cliente.NotaVentaCliente.factura', compact('notaVenta', 'user', 'productos', 'subcategorias', 'detallesNotaVenta', 'pago'));
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
