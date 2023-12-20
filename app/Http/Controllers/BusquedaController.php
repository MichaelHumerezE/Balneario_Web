<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        // $tablas = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        // Obtener todas las tablas de la base de datos
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");
        $tableNames = array_column($tables, 'table_name');
        // Tablas que deseas excluir de la búsqueda
        $tablasExcluidas = ['bitacora', 'detalle_carrito', 'detalle_menbresia', 'detalle_nota_venta', 'detalle_carrito', 'failed_jobs', 'migrations','model_has_permissions','model_has_roles', 'nota_venta', 'pago','password_resets','permissions','personal_access_tokens','roles','role_has_permissions'];
        $tablasValidas = ['categoria', 'menbresia', 'producto', 'subcategoria', 'users', 'roles'];
        if ( $query == 'carrito' || $query == 'detalle carrito' || $query == 'detalle'){
            return redirect()->route('detalleCarrito.cliente.index');
        }
        foreach ($tableNames as $tabla) {
            // Verificar si la tabla actual está en la lista de tablas excluidas
            if (!in_array($tabla, $tablasExcluidas)) {
                $columnas = Schema::getColumnListing($tabla);
                // Buscar en cada columna de la tabla
                foreach ($columnas as $columna) {
                    $resultados = DB::table($tabla)
                        ->where($columna, 'ILIKE', '%' . $query . '%')
                        ->get();
                    // Si se encontraron resultados, redireccionar al primer resultado
                    if (!$resultados->isEmpty()) {
                        if ( $tabla == "subcategoria" ){
                            return redirect()->route('categoria.cliente.index');
                        }
                        if ( $tabla == "producto" ){
                            return redirect()->route('catalogo.cliente.index');
                        }
                    }
                }
            }
        }
        // Si no se encontraron resultados, mostrar un mensaje o redireccionar a una página de resultados vacíos
        return redirect()->back()->with('alerta', 'La ruta de índice no existe');
    }

    public function buscarAdmin(Request $request)
    {
        $query = $request->input('query');

        // $tablas = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        // Obtener todas las tablas de la base de datos
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");
        $tableNames = array_column($tables, 'table_name');
        // Tablas que deseas excluir de la búsqueda
        $tablasExcluidas = ['bitacora', 'detalle_carrito', 'detalle_menbresia', 'detalle_nota_venta', 'detalle_carrito', 'failed_jobs', 'migrations','model_has_permissions','model_has_roles', 'nota_venta', 'pago','password_resets','permissions','personal_access_tokens','roles','role_has_permissions'];
        $tablasValidas = ['categoria', 'menbresia', 'producto', 'subcategoria', 'users', 'roles'];
        foreach ($tableNames as $tabla) {
            // Verificar si la tabla actual está en la lista de tablas excluidas
            if (!in_array($tabla, $tablasExcluidas)) {
                $columnas = Schema::getColumnListing($tabla);
                // Buscar en cada columna de la tabla
                foreach ($columnas as $columna) {
                    $resultados = DB::table($tabla)
                        ->where($columna, 'ILIKE', '%' . $query . '%')
                        ->get();
                    // Si se encontraron resultados, redireccionar al primer resultado
                    if (!$resultados->isEmpty()) {
                        if ( $tabla == "categoria" ){
                            return redirect()->route('categoria.admin.index');
                        }
                        if ( $tabla == "producto" ){
                            return redirect()->route('producto.admin.index');
                        }
                        if ( $tabla == "subcategoria" ){
                            return redirect()->route('subcategoria.admin.index');
                        }
                        if ( $tabla == "menbresia" ){
                            return redirect()->route('menbresia.admin.index');
                        }
                        if ( $tabla == "users" ){
                            if ( $resultados[0]->tipo == "Empleado") return redirect()->route('empleado.admin.index');
                            if ( $resultados[0]->tipo == "Cliente") return redirect()->route('cliente.admin.index');
                        }
                        // return $resultados;
                        // $rutaIndex = $tabla . '.index';
                        // if (Route::has($rutaIndex)) {
                        //     return redirect()->route($rutaIndex);
                        // } else {
                        //     return redirect()->back()->with('alerta', 'La ruta de índice no existe');
                        // }
                        // // return $resultados;
                        // //return redirect()->route($tabla . '.index');
                        // //return redirect()->route('redireccionar', ['tabla' => $tabla, 'id' => $resultados->first()->id]);
                    }
                }
            }
        }
        // Si no se encontraron resultados, mostrar un mensaje o redireccionar a una página de resultados vacíos
        return redirect()->back()->with('alerta', 'La ruta de índice no existe');
    }

    public function redireccionar($tabla, $id)
    {
        // Aquí puedes realizar cualquier lógica adicional antes de redireccionar a la tupla encontrada
        // Por ejemplo, podrías realizar una validación para asegurarte de que el usuario tiene permiso para ver esta tupla

        // Redireccionar a la tupla encontrada
        return redirect()->route($tabla . '.show', $id);
    }
}