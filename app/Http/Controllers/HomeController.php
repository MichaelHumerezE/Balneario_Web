<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\categoria;
use App\Models\DetalleCarrito;
use App\Models\producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productos = producto::get();
        $categorias = categoria::get();
        if (auth()->user()) {
            if (auth()->user()->tipo == 'Empleado') {
                return view('administrador.home');
            }
            if (auth()->user()->tipo == 'Cliente') {
                $carrito = Carrito::where('cliente_id', auth()->user()->id);
                $carrito = $carrito->where('estado', 0)->first();
                $detallesCarrito = DetalleCarrito::get();
                return view('cliente.home', compact('productos', 'categorias', 'carrito', 'detallesCarrito'));
            }
        }
        return view('cliente.home', compact('productos', 'categorias'));
    }

    public function indexA()
    {
        return view('administrador.home');
    }
    public function indexC()
    {
        return view('cliente.home');
    }
}
