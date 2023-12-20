<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Bitacora;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaVenta;
use App\Models\NotaVenta;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('America/La_Paz');

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::get();
        $subcategorias = Subcategoria::get();
        return view('cliente.metodoDePago.index', compact('productos', 'subcategorias', 'carrito', 'detallesCarrito'));
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
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        //Pago
        $pago = Pago::create($request->validated());
        //Pedido
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        //Carrito
        $carrito->estado = 1;
        $carrito->save();
        Carrito::create([
            'estado' => '0',
            'cliente_id' => auth()->user()->id,
        ]);
        //NotaVenta
        NotaVenta::create([
            'nit' => $request->nit,
            'fechaHora' => date('Y-m-d H:i:s'),
            'monto_total' => 0,
            'nombre_cliente' => auth()->user()->name,
            'usuario_id' => auth()->user()->id,
        ]);
        //Actiualizacion de stock
        $productos = Producto::get();
        $detallesCarrito = DetalleCarrito::get()->where('carrito_id', $carrito->id);
        foreach ($detallesCarrito as $detalleCarrito) {
            foreach ($productos as $producto) {
                if ($detalleCarrito->producto_id == $producto->id) {
                    $prod = Producto::findOrFail($producto->id);
                    $prod->stock = $prod->stock - $detalleCarrito->cantidad;
                    $prod->save();
                }
            }
        }
        //Bitacora Pago
        $id2 = Auth::id();
        $user = User::findOrFail($id2);
        $action = "Nuevo pago creado";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        //Bitacora carrito
        $action = "Nuevo carrito creado y asignado";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //Bitacora factura
        $action = "Nota Venta creada";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $user->tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        return redirect('/home')->with('mensaje', 'Pago realizado, Su transferencia será revisada dentro de 24 horas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Nota Venta
        $notaVenta = NotaVenta::create([
            'nit' => auth()->user()->ci,
            'fecha_hora' => date('Y-m-d H:i:s'),
            'monto_total' => 0,
            'nombre_cliente' => auth()->user()->name,
            'usuario_id' => auth()->user()->id,
        ]);
        //Detalle Nota Venta
        $productos = Producto::get();
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::get()->where('carrito_id', $carrito->id);
        $total = 0;
        foreach ($detallesCarrito as $detalleCarrito) {
            $total += $detalleCarrito->cantidad * $detalleCarrito->precio;
            $detalleNotaVenta = DetalleNotaVenta::create([
                'cantidad' => $detalleCarrito->cantidad,
                'precio' => $detalleCarrito->precio,
                'producto_id' => $detalleCarrito->producto_id,
                'nota_venta_id' => $notaVenta->id,
            ]);
            $producto = Producto::findOrFail($detalleCarrito->producto_id);
            $producto->stock = $producto->stock - $detalleCarrito->cantidad;
            $producto->save();
        }
        //Nuevo Carrito
        $carrito->estado = 1;
        $carrito->save();
        Carrito::create([
            'estado' => '0',
            'cliente_id' => auth()->user()->id,
        ]);
        //Pago
        $pago = Pago::create([
            'estado' => 0,
            'fecha_hora' => date('Y-m-d H:i:s'),
            'monto_total' => $total,
            'tipo' => 'Pago Facil',
            'nota_venta_id' => $notaVenta->id,
        ]);
        $this->generarqrv2($pago);

        $pago = Pago::findOrFail($pago->id);
        
        $notaVenta->monto_total = $pago->monto_total;
        $notaVenta->save();

        //Vista
        $carrito = Carrito::where('cliente_id', auth()->user()->id);
        $carrito = $carrito->where('estado', 0)->first();
        $detallesCarrito = DetalleCarrito::get();

        $subcategorias = Subcategoria::get();
        return view('cliente.metodoDePago.create', compact('productos', 'subcategorias', 'carrito', 'detallesCarrito', 'pago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }

    public function generarqrv2(Pago $pago)
    {
        $detalles = DetalleNotaVenta::where('nota_venta_id', $pago->nota_venta_id)->get();
        $detallesF = [];
        foreach ($detalles as $detalle) {
            $detalleModificado = [
                "Serial"    => $detalle->producto_id,
                "Producto"  => $detalle->producto->nombre,
                "Cantidad"  => $detalle->cantidad,
                "Precio"    => $detalle->precio,
                "Descuento" => 0,
                "Total"     => $detalle->cantidad * $detalle->precio
            ];

            // Agrega el detalle modificado al nuevo array
            $detallesF[] = $detalleModificado;
        }

        $loClient = new Client();

        $tcNroPago = rand(123456789, 999999999);

        $laHeader = [
            'Accept' => 'application/json'
        ];

        $laBody   = [
            "tcCommerceID"          => "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c",
            "tnMoneda"              => 2,
            "tnTelefono"            => auth()->user()->telefono,
            'tcNombreUsuario'       => auth()->user()->name,
            'tnCiNit'               => auth()->user()->ci,
            'tcNroPago'             => $tcNroPago,
            "tnMontoClienteEmpresa" => $pago->monto_total,
            "tcCorreo"              => auth()->user()->email,
            'tcUrlCallBack'         => route('urlCallback.store'),
            "tcUrlReturn"           => "http://localhost:8000",
            'taPedidoDetalle'       => $detallesF
        ];

        $loResponse = $loClient->post("https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2", [
            'headers' => $laHeader,
            'json' => $laBody
        ]);

        $laResult = json_decode($loResponse->getBody()->getContents());

        $laValues = explode(";", $laResult->values)[1];

        $laQrImage = json_decode($laValues)->qrImage;

        // Decodifica el base64 para obtener los datos binarios
        $binaryData = base64_decode($laQrImage);

        // Genera un nombre de archivo único
        $fileName = time() . '.png';

        // Almacena los datos binarios en el bucket S3
        Storage::disk('s3')->put('pagos/' . $fileName, $binaryData, 'public');

        // Obtiene la URL del archivo almacenado en S3
        $qrCodeUrl = Storage::disk('s3')->url('pagos/' . $fileName);

        $pago = Pago::findOrFail($pago->id);
        $pago->pago_facil_id = $tcNroPago;
        $pago->imagen = 'pagos/' . $fileName;
        $pago->url = $qrCodeUrl;
        $pago->save();
    }
}
