<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetalleCarritoRequest;
use App\Http\Requests\UpdateDetalleCarritoRequest;
use App\Models\Bitacora;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Persona;
use App\Models\producto;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class DetalleCarritoCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2($id)
    {
        $productos = Producto::get();
        $carrito = Carrito::findOrFail($id);
        return view('administrador.gestionar_carrito_de_clientes.create', compact('productos', 'carrito'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetalleCarritoRequest $request)
    {
        $producto = producto::findOrFail($request->producto_id);
        $request['precio'] = $producto->precio;
        $carrito = Carrito::findOrFail($request->carrito_id);
        $detallesC = DetalleCarrito::get();
        foreach ($detallesC as $detalleC) {
            if ($producto->id == $detalleC->producto_id && $carrito->id == $detalleC->carrito_id) {
                if ($producto->stock >= $request->cantidad && $detalleC->cantidad + $request->cantidad <= $producto->stock) {
                    $detalleC->cantidad = $detalleC->cantidad + $request->cantidad;
                    $detalleC->update();
                    $detalles = DetalleCarrito::get()->where('carrito_id', $carrito->id);
                    $carrito->total = 0;
                    foreach ($detalles as $detalle) {
                        $carrito->total = $carrito->total + $detalle->cantidad * $detalle->precio;
                    }
                    $carrito->fechaHora = date('Y-m-d H:i:s');
                    //Bitacora
                    $id2 = Auth::id();
                    $user = User::where('id', $id2)->first();
                    $action = "Agregó un producto a su carrito";
                    $bitacora = Bitacora::create();
                    $bitacora->tipou = $user->tipo;
                    $bitacora->name = $user->name;
                    $bitacora->actividad = $action;
                    $bitacora->fechaHora = date('Y-m-d H:i:s');
                    $bitacora->ip = $request->ip();
                    $bitacora->save();
                    //----------
                    $carrito->save();
                    return redirect()->route('carritosClientes.index')->with('message', 'Producto agregado exitosamente');
                } else {
                    return redirect()->route('carritosClientes.index')->with('danger', 'Producto sin stock suficiente');
                }
            }
        }
        if ($producto->stock >= $request->cantidad) {
            $detalleCarrito = DetalleCarrito::create($request->all());
            $carrito->total = $carrito->total + $detalleCarrito->cantidad * $detalleCarrito->precio;
            $carrito->fechaHora = date('Y-m-d H:i:s');
            $carrito->save();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('id', $id2)->first();
            $action = "Agregó un producto a su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('carritosClientes.index')->with('message', 'Producto agregado exitosamente');
        } else {
            return redirect()->route('carritosClientes.index')->with('danger', 'Producto sin stock suficiente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleCarrito = DetalleCarrito::findOrFail($id);
        $productos = producto::get();
        $carrito = Carrito::findOrFail($detalleCarrito->idCarrito);
        return view('administrador.gestionar_carrito_de_clientes.edit', compact('productos', 'carrito', 'detalleCarrito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetalleCarritoRequest $request, $id)
    {
        $producto = producto::findOrFail($request->idProducto);
        $carrito = Carrito::findOrFail($request->idCarrito);
        $detalleCarrito = DetalleCarrito::findOrFail($id);
        if ($producto->stock >= $request->cantidad && $request->cantidad > 0) {
            $detalleCarrito->cantidad = $request->cantidad;
            $detalleCarrito->update();
            $detalles = DetalleCarrito::get()->where('idCarrito', $detalleCarrito->idCarrito);
            $carrito->total = 0;
            foreach ($detalles as $detalle) {
                $carrito->total = ($carrito->total + $detalle->cantidad * $detalle->precio);
            }
            $carrito->fechaHora = date('Y-m-d H:i:s');
            $carrito->save();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('id', $id2)->first();
            $tipo = "default";
            if ($user->tipoe == 1) {
                $tipo = "Empleado";
            }
            if ($user->tipoc == 1) {
                $tipo = "Cliente";
            }
            $action = "Edito los productos de su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('carritosClientes.index')->with('message', 'Producto actualizado exitosamente');
        } else {
            return redirect()->route('carritosClientes.index')->with('danger', 'Producto sin stock suficiente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $detalleCarrito = DetalleCarrito::findOrFail($id);
        try {
            $detalleCarrito = DetalleCarrito::findOrFail($id);
            $carrito = Carrito::findOrFail($detalleCarrito->idCarrito);
            $detalleCarrito->delete();
            $detalles = DetalleCarrito::get();
            $carrito->total = 0;
            foreach ($detalles as $detalle) {
                if ($detalle->idCarrito == $carrito->id) {
                    $carrito->total = ($carrito->total + $detalle->cantidad * $detalle->precio);
                }
            }
            $carrito->fechaHora = date('Y-m-d H:i:s');
            $carrito->save();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('id', $id2)->first();
            $tipo = "default";
            if ($user->tipoe == 1) {
                $tipo = "Empleado";
            }
            if ($user->tipoc == 1) {
                $tipo = "Cliente";
            }
            $action = "Eliminó un producto de su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('carritosClientes.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('carritosClientes.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
