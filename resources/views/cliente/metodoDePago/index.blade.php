@extends('cliente.cliente')
@section('content')
    <!-- Order Details -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            <?php $total = 0; ?>
                            @foreach ($detallesCarrito as $detalleCarrito)
                                @if ($detalleCarrito->carrito_id == $carrito->id)
                                    @foreach ($productos as $producto)
                                        @if ($detalleCarrito->producto_id == $producto->id)
                                            <?php $total += $detalleCarrito->cantidad * $detalleCarrito->precio; ?>
                                            <div class="order-col">
                                                <div>{{ $detalleCarrito->cantidad }}x {{ $producto->nombre }}</div>
                                                <div>{{ $detalleCarrito->precio * $detalleCarrito->cantidad }} Bs</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">{{ $total }} Bs</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Order Details -->
    <div class="d-table-cell align-middle">
        <div class="text-center mt-4">
            <h3 class="title">Payment Method</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="m-sm-4">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>QR Pago Facil</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('pagos.show', 1) }}"
                                                class="primary-btn order-submit"><i class="fa fa-check"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
