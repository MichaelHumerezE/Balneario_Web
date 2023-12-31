<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\PageVisit;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class CategoriaController extends Controller
{
    function __construct()
    {
        $this->middleware('can:categoria.index', ['only' => 'index']);
        $this->middleware('can:categoria.create', ['only' => ['create', 'store']]);
        $this->middleware('can:categoria.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:categoria.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Visitas
        $page = 'Categoria-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $categorias = Categoria::paginate(10);
        return (view('administrador.gestionar_categoria.index', compact('categorias', 'pageVisitsCount')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.gestionar_categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->validated());
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Creó un registro de una nueva categoria";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect('administrador/categoria')->with('message', 'Guardado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('administrador.gestionar_categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->update($request->validated());
        $categoria->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Editó un registro de una categoria";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect('administrador/categoria')->with('message', 'Editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $request = Request::capture();
        try {
            $categoria->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('iduser', $id2)->first();
            $action = "Eliminó un registro de una categoria";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('categoria.admin.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('categoria.admin.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
