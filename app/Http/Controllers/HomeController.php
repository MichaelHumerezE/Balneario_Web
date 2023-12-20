<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\DetalleCarrito;
use App\Models\NotaVenta;
use App\Models\PageVisit;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $productos = Producto::get();
        $subcategorias = Subcategoria::get();
        if (auth()->user()) {
            if (auth()->user()->tipo == 'Empleado') {
                //Visitas
                $page = 'Home-Empleado'; // Reemplaza con el nombre único de tu página
                $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
                $pageVisitsCount = $pageVisits->visits;

                // Incrementa el contador
                $pageVisits->increment('visits');
                //
                $usuarios = User::get();
                $notaVentas = NotaVenta::get();
                $productos = DB::select('select * from productos_vendidos');
                $productos_cantidad = DB::select('select * from productos_vendidos_cantidad');
                $dias = DB::select('select * from VentasXAll');
                $mes = DB::select('select * from VentasXMes');
                $anual = DB::select('select * from VentasXAnio');
                $total = 0;
                foreach ($notaVentas as $notaVenta) {
                    $total += $notaVenta->monto_total;
                }
                return view('administrador.home', compact('usuarios', 'pageVisitsCount', 'notaVentas', 'total', 'productos', 'productos_cantidad', 'dias', 'mes', 'anual'));
            }
            if (auth()->user()->tipo == 'Cliente') {
                //Visitas
                $page = 'Home-Cliente'; // Reemplaza con el nombre único de tu página
                $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
                $pageVisitsCount = $pageVisits->visits;

                // Incrementa el contador
                $pageVisits->increment('visits');
                //
                $carrito = Carrito::where('cliente_id', auth()->user()->id);
                $carrito = $carrito->where('estado', 0)->first();
                $detallesCarrito = DetalleCarrito::get();
                return view('cliente.home', compact('productos', 'carrito', 'pageVisitsCount', 'detallesCarrito', 'subcategorias'));
            }
        }
        //Visitas
        $page = 'Invitado'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        return view('cliente.home', compact('productos', 'subcategorias', 'pageVisitsCount'));
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
