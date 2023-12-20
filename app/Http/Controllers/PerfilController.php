<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePerfilRequest;
use App\Models\Bitacora;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\PageVisit;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->tipo == 'Cliente') {
                return redirect('cliente/home');
            } else {
                if (auth()->user()->tipo == 'Empleado') {
                    return redirect('administrador/home');
                }
            }
        }
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
        $perfil = User::findOrFail($id);
        if ($perfil->tipo == 'Cliente') {
            $productos = Producto::get();
            $carrito = Carrito::where('cliente_id', auth()->user()->id);
            $carrito = $carrito->where('estado', 0)->first();
            $detallesCarrito = DetalleCarrito::get();
            $subcategorias = Subcategoria::get();

            //Visitas
            $page = 'Perfil-Cliente'; // Reemplaza con el nombre único de tu página
            $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
            $pageVisitsCount = $pageVisits->visits;

            // Incrementa el contador
            $pageVisits->increment('visits');
            //
            return view('perfilC.edit', compact('perfil', 'pageVisitsCount', 'subcategorias', 'detallesCarrito', 'carrito', 'productos'));
        } else {
            //Visitas
            $page = 'Perfil-Empleado'; // Reemplaza con el nombre único de tu página
            $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
            $pageVisitsCount = $pageVisits->visits;

            // Incrementa el contador
            $pageVisits->increment('visits');
            //
            return view('perfil.edit', compact('perfil', 'pageVisitsCount'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerfilRequest $request, $id)
    {
        $perfil = User::findOrFail($id);
        $perfil->update($request->validated());
        $id2 = Auth::id();
        //Bitacora
        $user = User::where('id', $id2)->first();
        $action = "Editó los datos de su perfil personal";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        if ($user->tipo == 'Cliente') {
            return redirect('cliente/home')->with('message', 'Se ha actualizado los datos correctamente.');
        } else {
            if ($user->tipo == 'Empleado') {
                return redirect('administrador/home')->with('message', 'Se ha actualizado los datos correctamente.');
            }
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
        //
    }
}
