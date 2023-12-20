@extends('cliente.cliente')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Nota Ventas</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li class="active">Nota Ventas Realizados</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-header d-inline">
                <div class="card-header d-inline-flex">
                    <a href="{{ url('/home') }}" class="primary-btn order-submit">
                        <i class="fa fa-arrow-left"></i>
                        Volver</a>
                </div>
            </div>
            <div class="row">
                <div class="pagination justify-content-end">
                    {{ $notaVentas->links() }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIT</th>
                            <th>Fecha Hora</th>
                            <th>Monto Total</th>
                            <th>Nombre Cliente</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valor = 1;
                        ?>
                        @foreach ($notaVentas as $notaVenta)
                            @foreach ($pagos as $pago)
                                @if ($notaVenta->id == $pago->nota_venta_id)
                                    <tr>
                                        <th scope="row">{{ $valor++ }}</th>
                                        <td>{{ $notaVenta->nit }}</td>
                                        <td>{{ $notaVenta->fecha_hora }}</td>
                                        <td>{{ $notaVenta->monto_total }}</td>
                                        <td>{{ $notaVenta->nombre_cliente }}</td>
                                        @if ($pago->estado == 0)
                                            <td>No Pagado</td>
                                        @else
                                            <td>Pagado</td>
                                        @endif
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('notaVentasCliente.show', $notaVenta->id) }}"
                                                    class="btn btn-primary"><i class="fa fa-align-justify"></i> Detalles</a>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('notaVentasCliente.edit', $notaVenta->id) }}"
                                                    class="btn btn-primary"><i class="fa fa-file"></i> Factura</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination justify-content-end">
            {{ $notaVentas->links() }}
        </div>
    </div>
@endsection
