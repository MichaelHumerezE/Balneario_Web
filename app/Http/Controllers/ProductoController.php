<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Bitacora;
use App\Models\Producto;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\PageVisit;
use App\Models\Subcategoria;
use App\Models\User;

date_default_timezone_set('America/La_Paz');

class ProductoController extends Controller
{
    function __construct()
    {
        $this->middleware('can:producto.index', ['only' => 'index']);
        $this->middleware('can:producto.create', ['only' => ['create', 'store']]);
        $this->middleware('can:producto.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:producto.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Visitas
        $page = 'Producto-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $productos = Producto::paginate(10);
        return view('administrador.gestionar_producto.index', compact('productos', 'pageVisitsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategorias = Subcategoria::get();
        return view('administrador.gestionar_producto.create', compact('subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('public/img/', $filename);
            $producto->imagen = $filename;
        }
        $producto->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Creó un registro de un Producto";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //---------------
        return redirect('administrador/producto')->with('message', 'Guardado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $subcategorias = Subcategoria::get();
        return view('administrador.gestionar_producto.edit', compact('producto', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->validated());
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('public/img/', $filename);
            $producto->imagen = $filename;
        }
        $producto->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Editó un registro de un Producto";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //---------------
        return redirect('administrador/producto')->with('message', 'Actualizado exitosamente');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $producto = Producto::findOrFail($id);
        try {
            $producto->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('iduser', $id2)->first();
            $action = "Eliminó un registro de un Producto";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //---------------
            return redirect('administrador/producto')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect('administrador/producto')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
