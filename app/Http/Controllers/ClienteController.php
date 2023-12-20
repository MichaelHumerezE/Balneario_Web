<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Bitacora;
use App\Models\PageVisit;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class ClienteController extends Controller
{
    function __construct()
    {
        $this->middleware('can:cliente.index', ['only' => 'index']);
        $this->middleware('can:cliente.create', ['only' => ['create', 'store']]);
        $this->middleware('can:cliente.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:cliente.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Visitas
        $page = 'Cliente-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $clientes = User::where('tipo', 'Cliente')->paginate(10); 
        return view('administrador.gestionar_clientes.index', compact('clientes', 'pageVisitsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.gestionar_clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = User::create($request->validated());
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Creó un nuevo registro de un usuario cliente";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect()->route('clientes.admin.index')->with('mensaje', 'cliente Agregado Con Éxito');
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
        $cliente = User::findOrFail($id);
        return view('administrador.gestionar_clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        $cliente = User::find($id);
        $cliente->update($request->validated());
        $cliente->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Editó un registro de un usuario cliente";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect()->route('clientes.admin.index')->with('mensaje', 'Datos Actualizados');
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
        $cliente = User::findOrFail($id);
        try {
            $cliente->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('iduser', $id2)->first();
            $action = "Eliminó un registro de un usuario cliente";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('clientes.admin.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('clientes.admin.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
