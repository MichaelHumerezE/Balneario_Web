<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaVenta;
use App\Models\NotaVenta;
use App\Models\producto;
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
        $detallesCarrito = DetalleCarrito::get();
        $productos = producto::get();
        $carritos = Carrito::where('cliente_id', auth()->user()->id)->paginate(10);
        $notaVentas = NotaVenta::where('usuario_id', auth()->user()->id)->paginate(10);
        return view('cliente.pedidos.index', compact('pedidos', 'carritos', 'detallesCarrito', 'productos'));
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
        $productos = producto::get();
        $detallesCarrito = DetalleCarrito::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        return (view('cliente.pedidos.show', compact('pedido', 'carritoCliente', 'detallesCarritos', 'productos', 'detallesCarrito', 'carrito', 'direccion')));

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
        /*$factura = factura::where('id_pedido', $id)->first();
        $user = User::findOrfail($factura->id_cliente);
        $pedido = pedido::findOrFail($factura->id_pedido);
        $pago = Pago::findOrfail($pedido->id_pago);
        $tipoPago = TipoPago::findOrFail($pago->id_tipoPago);
        $productos = producto::get();
        $carrito = Carrito::findOrFail($pedido->id_carrito);
        $detallesCarritos = DetalleCarrito::get()->where('idCarrito', $carrito->id);*/
        return view('administrador.gestionar_pedidos.factura', compact('factura', 'user', 'tipoPago', 'productos', 'detallesCarritos', 'pago'));
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
