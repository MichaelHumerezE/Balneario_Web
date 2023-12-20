@extends('cliente.cliente')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Pagos</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li class="active">Pagos Realizados</li>
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
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Monto Total</th>
                            <th>Fecha Hora</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th># Nota de Venta</th>
                            <th>Id Pago Facil</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valor = 1;
                        ?>
                        @foreach ($todosLosPagos as $pago)
                            <tr>
                                <th scope="row">{{ $valor++ }}</th>
                                <td>{{ $pago['monto_total'] }} Bs</td>
                                <td>{{ $pago['fecha_hora'] }}</td>
                                @if ($pago['estado'] == 0)
                                    <td>No pagado</td>
                                @else
                                    <td>Pagado</td>
                                @endif
                                <td>{{ $pago['tipo'] }}</td>
                                <td>{{ $pago['nota_venta_id'] }}</td>
                                <td>{{ $pago['pago_facil_id'] }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('pagosCliente.show', $pago['id']) }}" class="btn btn-primary"><i
                                                class="fa fa-align-justify"></i> Ver QR</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination justify-content-end">
        </div>
        <div class="fixed bottom-4 right-4 z-50">
            <div class="fixed bottom-4 right-4 z-50">
                <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                    <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
                </div>
            </div>  
        </div>
    </div>
@endsection
