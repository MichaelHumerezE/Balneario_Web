<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaVentaRequest;
use App\Http\Requests\UpdateNotaVentaRequest;
use App\Models\Bitacora;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaVenta;
use App\Models\NotaVenta;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

date_default_timezone_set('America/La_Paz');

class NotaVentaController extends Controller
{
    function __construct()
    {
        /*$this->middleware('can:notaVentas.index', ['only' => 'index']);
        $this->middleware('can:notaVentas.show', ['only' => 'show']);
        $this->middleware('can:notaVentas.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:notaVentas.factura', ['only' => ['destroy']]);*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota_ventas = NotaVenta::paginate(10);
        return (view('administrador.gestionar_nota_ventas.index', compact('nota_ventas')));
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
     * @param  \App\Http\Requests\Storenota_ventaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotaVentaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nota_venta  $nota_venta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota_venta = NotaVenta::findOrFail($id);
        $carrito = Carrito::findOrFail($nota_venta->id_carrito);
        $detallesCarritos = DetalleCarrito::where('carrito_id', $carrito->id)->paginate(10);
        $productos = Producto::get();
        return (view('administrador.gestionar_nota_ventas.show', compact('detallesCarritos', 'productos')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nota_venta  $nota_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nota_venta = NotaVenta::findOrFail($id);
        return view('administrador.gestionar_nota_ventas.edit', compact('nota_venta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenota_ventaRequest  $request
     * @param  \App\Models\nota_venta  $nota_venta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotaVentaRequest $request, $id)
    {
        $nota_venta = NotaVenta::findOrFail($id);
        $nota_venta->update($request->validated());
        if($request->estado == 'Cancelado'){
            $productos = Producto::get();
            $detallesCarrito = DetalleCarrito::get()->where('idCarrito', $nota_venta->id_carrito);
            foreach($detallesCarrito as $detalleCarrito){
                foreach($productos as $producto){
                    if($detalleCarrito->idProducto == $producto->id){
                        $prod = Producto::findOrFail($producto->id);
                        $prod->stock = $prod->stock + $detalleCarrito->cantidad;
                        $prod->save();
                    }
                }
            }
        }
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $tipo = "default";
        if ($user->tipoe == 1) {
            $tipo = "Empleado";
        }
        if ($user->tipoc == 1) {
            $tipo = "Cliente";
        }
        $action = "Actualizó un nota_venta";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect('administrador/nota_ventas')->with('message', 'Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nota_venta  $nota_venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Factura
        $notaVenta = NotaVenta::findOrFail($id);
        $usuario = User::findOrfail($notaVenta->usuario_id);
        $pago = Pago::where('nota_venta_id', $notaVenta->id)->first();
        $productos = Producto::get();
        $detallesNotaVenta = DetalleNotaVenta::get()->where('nota_venta_id', $notaVenta->id);
        //Bitacora
        $request = Request::capture();
        $id2 = Auth::id();
        $user = User::findOrFail($id2);
        $action = "Generó una factura de un nota_venta";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return view('administrador.gestionar_nota_ventas.factura', compact('notaVenta', 'usuario', 'productos', 'detallesNotaVenta', 'pago'));
    }

}
