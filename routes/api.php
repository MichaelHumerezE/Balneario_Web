<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\DetalleCarritoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\Api\ApiClienteController;
use App\Http\Controllers\Api\ApiCarritoController;
use App\Http\Controllers\Api\ApiUsuarioController;
use App\Http\Controllers\Api\ApiTipoPagoController;
use App\Http\Controllers\Api\ApiPagoController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});