@csrf
@include('layouts.messages')
<div class="row">
    <h5>Productos</h5>
    <div class="col-12">
        @if ((isset($detalleCarrito->id) ? $detalleCarrito->id : '') == '')
            <select name="producto_id" class="form-control">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}
                    </option>
                @endforeach
                <option selected value=""> Seleccione Una Producto... </option>
            </select>
        @else
            <select name="producto_id" class="form-control">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" @if ($detalleCarrito->producto_id == $producto->id) selected @endif>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="number" placeholder="cantidad" class="form-control" name="cantidad"
                value="{{ isset($detalleCarrito) ? $detalleCarrito->cantidad : old('cantidad') }}">
            <label>Cantidad</label>
        </div>
    </div>
    <input type="hidden" name="precio" class="form-control" id="exampleInputPassword1" value="0">
    <input type="hidden" name="carrito_id" class="form-control" id="exampleInputPassword1" value="{{ $carrito->id }}">
</div>
