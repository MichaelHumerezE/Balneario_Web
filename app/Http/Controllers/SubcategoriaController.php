<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresubcategoriaRequest;
use App\Http\Requests\UpdatesubcategoriaRequest;
use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\PageVisit;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class SubcategoriaController extends Controller
{
    function __construct()
    {
        $this->middleware('can:subcategoria.index', ['only' => 'index']);
        $this->middleware('can:subcategoria.create', ['only' => ['create', 'store']]);
        $this->middleware('can:subcategoria.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:subcategoria.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Visitas
        $page = 'Subcategoria-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $subcategorias = Subcategoria::paginate(10);
        return view('administrador.gestionar_subcategorias.index', compact('subcategorias', 'pageVisitsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get();
        return view('administrador.gestionar_subcategorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcategoriaRequest $request)
    {
        subcategoria::create($request->validated());
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Creó un registro de una nueva subcategoria";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect('administrador/subcategorias')->with('message', 'Guardado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function show(subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::get();
        return view('administrador.gestionar_subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubcategoriaRequest $request, $id)
    {
        $subcategoria = subcategoria::findOrFail($id);
        $subcategoria->update($request->validated());
        $subcategoria->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Editó un registro de una subcategoria";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect('administrador/subcategorias')->with('message', 'Editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $subcategoria = Subcategoria::findOrFail($id);
        try {
            $subcategoria->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('iduser', $id2)->first();
            $action = "Eliminó un registro de una subcategoria";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('subcategorias.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('subcategorias.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
