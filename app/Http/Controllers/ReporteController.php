<?php

namespace App\Http\Controllers;

use App\Models\marca;
use App\Models\producto;
use App\Models\categoria;

use App\Models\Proveedor;
use App\Exports\ProductosExport;
use App\Exports\ProveedoresExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReporteController extends Controller
{
    public function producto($data)
    {
        if ($data == 'csv') {
            return Excel::download(new ProductosExport, 'productos.csv');
        } elseif ($data == 'xlsx') {
            return Excel::download(new ProductosExport, 'productos.xlsx');
        } else {
            $productos = producto::all();
            $categorias = categoria::get();
            $pdf = PDF::loadView('administrador.reportes.producto', compact('productos', 'categorias'));
            return $pdf->stream();
        }
    }

    public function proveedor($data)
    {
        if ($data == 'csv') {
            return Excel::download(new ProveedoresExport, 'proveedores.csv');
        } elseif ($data == 'xlsx') {
            return Excel::download(new ProveedoresExport, 'proveedores.xlsx');
        } else {
            $pdf = PDF::loadView('administrador.reportes.proveedor'));
            return $pdf->stream();
        }
    }
}
