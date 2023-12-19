<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterEmpRequest;
use App\Http\Requests\UpdateEmpRequest;
use App\Models\Bitacora;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class EmpleadoController extends Controller
{
    function __construct()
    {
        $this->middleware('can:empleado.index', ['only' => 'index']);
        $this->middleware('can:empleado.create', ['only' => ['create', 'store']]);
        $this->middleware('can:empleado.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:empleado.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = User::where('tipo', 'Empleado')->paginate(10);
        return view('administrador.gestionar_empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.gestionar_empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterEmpRequest $request)
    {
        //dd($request->all());
        $empleado = User::create($request->validated());
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Creó un nuevo registro de un usuario empleado";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect()->route('empleados.index')->with('mensaje', 'Empleado Agregado Con Éxito');
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
        $empleado = User::findOrFail($id);
        return view('administrador.gestionar_empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpRequest $request, $id)
    {
        $empleado = User::find($id);
        $empleado->update($request->validated());
        $empleado->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('iduser', $id2)->first();
        $action = "Editó un registro de un usuario empleado";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect()->route('empleados.index')->with('mensaje', 'Datos Actualizados');
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
        $empleado = User::findOrFail($id);
        try {
            $empleado->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('iduser', $id2)->first();
            $action = "Eliminó un registro de un usuario empleado";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('empleados.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('empleados.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
