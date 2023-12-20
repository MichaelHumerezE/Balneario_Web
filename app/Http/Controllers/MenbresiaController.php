<?php

namespace App\Http\Controllers;

use App\Models\Menbresia;
use App\Http\Requests\StoremenbresiaRequest;
use App\Http\Requests\UpdatemenbresiaRequest;
use App\Models\Bitacora;
use App\Models\PageVisit;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class MenbresiaController extends Controller
{
    function __construct()
    {
        /*$this->middleware('can:menbresia.index', ['only' => 'index']);
        $this->middleware('can:menbresia.create', ['only' => ['create', 'store']]);
        $this->middleware('can:menbresia.update', ['only' => ['edit', 'update']]);
        $this->middleware('can:menbresia.delete', ['only' => ['destroy']]);*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Visitas
        $page = 'Menbresia-Index'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        $menbresias = Menbresia::paginate(10);
        return view('administrador.gestionar_menbresias.index', compact('menbresias', 'pageVisitsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.gestionar_menbresias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoremenbresiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenbresiaRequest $request)
    {
        $menbresia = menbresia::create($request->validated());
        if ($request->hasFile('qr')) {
            $file = $request->file('qr');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('public/img/', $filename);
            $menbresia->qr = $filename;
        }
        $menbresia->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('id', $id2)->first();
        $action = "Creó un nuevo registro de tipo de pago";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //---------------
        return redirect()->route('menbresias.admin.index')->with('mensaje', 'Menbresia Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menbresia  $menbresia
     * @return \Illuminate\Http\Response
     */
    public function show(menbresia $menbresia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menbresia  $menbresia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menbresia = Menbresia::findOrFail($id);
        return view('administrador.gestionar_menbresias.edit', compact('menbresia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemenbresiaRequest  $request
     * @param  \App\Models\menbresia  $menbresia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenbresiaRequest $request, $id)
    {
        $menbresia = menbresia::findOrFail($id);
        $menbresia->update($request->validated());
        if ($request->hasFile('qr')) {
            $file = $request->file('qr');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('public/img/', $filename);
            $menbresia->qr = $filename;
        }
        $menbresia->save();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('id', $id2)->first();
        $action = "Editó un registro de tipo de pago";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //---------------
        return redirect()->route('menbresias.admin.index')->with('mensaje', 'Menbresia Editado Con Éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menbresia  $menbresia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $menbresia = menbresia::findOrFail($id);
        try {
            $menbresia->delete();
            //Bitacora
            $id2 = Auth::id();
            $user = User::where('id', $id2)->first();
            $action = "Eliminó un registro de un tipo de pago";
            $bitacora = Bitacora::create();
            $bitacora->tipou = $user->tipo;
            $bitacora->name = $user->name;
            $bitacora->actividad = $action;
            $bitacora->fechaHora = date('Y-m-d H:i:s');
            $bitacora->ip = $request->ip();
            $bitacora->save();
            //----------
            return redirect()->route('menbresias.admin.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('menbresias.admin.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
