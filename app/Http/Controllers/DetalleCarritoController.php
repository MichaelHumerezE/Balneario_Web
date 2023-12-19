<?php

namespace App\Http\Controllers;

use App\Models\DetalleCarrito;
use App\Http\Requests\UpdateDetalleCarritoRequest;
use App\Models\Bitacora;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

date_default_timezone_set('America/La_Paz');

class DetalleCarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::where('carrito_id', $carrito->id)->paginate(9);
        return view('cliente.carrito.carrito', compact('productos', 'carrito', 'detallesCarrito'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetalleCarritoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $carrito = Carrito::findOrFail($request->carrito_id);
        $detallesC = DetalleCarrito::get();
        foreach ($detallesC as $detalleC) {
            if ($producto->id == $detalleC->producto_id && $carrito->id == $detalleC->carrito_id) {
                if ($producto->stock >= $request->cantidad && $detalleC->cantidad + $request->cantidad <= $producto->stock) {
                    $detalleC->cantidad = $detalleC->cantidad + $request->cantidad;
                    $detalleC->update();
                    //Bitacora
                    $id2 = Auth::id();
                    $user = User::findOrFail($id2);
                    $action = "Agregó un producto a su carrito";
                    $bitacora = Bitacora::create();
                    $bitacora->tipou = $user->tipo;
                    $bitacora->name = $user->name;
                    $bitacora->actividad = $action;
                    $bitacora->fechaHora = date('Y-m-d H:i:s');
                    $bitacora->ip = $request->ip();
                    $bitacora->save();
                    //----------
                    return redirect('cliente/catalogo')->with('message', 'Producto agregado exitosamente');
                } else {
                    return redirect('cliente/catalogo')->with('danger', 'Producto sin stock suficiente');
                }
            }
        }
        if ($producto->stock >= $request->cantidad) {
            $detalleCarrito = DetalleCarrito::create($request->all());
            //Bitacora
            $id2 = Auth::id();
            $user = User::findOrFail($id2);
            $action = "Agregó un producto a su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect('cliente/catalogo')->with('message', 'Producto agregado exitosamente');
        } else {
            return redirect('cliente/catalogo')->with('danger', 'Producto sin stock suficiente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleCarrito  $detalleCarrito
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleCarrito $detalleCarrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleCarrito  $detalleCarrito
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleCarrito $detalleCarrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetalleCarritoRequest  $request
     * @param  \App\Models\DetalleCarrito  $detalleCarrito
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetalleCarritoRequest $request, $id)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $carrito = Carrito::findOrFail($request->carrito_id);
        $detalleCarrito = DetalleCarrito::findOrFail($id);
        if ($producto->stock >= $request->cantidad && $request->cantidad > 0) {
            $detalleCarrito->cantidad = $request->cantidad;
            $detalleCarrito->update();
            //Bitacora
            $id2 = Auth::id();
            $user = User::findOrFail($id2);
            $action = "Edito los productos de su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect('cliente/detalleCarrito')->with('message', 'Producto actualizado exitosamente');
        } else {
            return redirect('cliente/detalleCarrito')->with('danger', 'Producto sin stock suficiente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleCarrito  $detalleCarrito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $detalleCarrito = DetalleCarrito::findOrFail($id);
        try {
            $detalleCarrito = DetalleCarrito::findOrFail($id);
            $detalleCarrito->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::findOrFail($id2);
            $action = "Eliminó un producto de su carrito";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect('cliente/detalleCarrito')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect('cliente/detalleCarrito')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
