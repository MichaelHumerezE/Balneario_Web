@extends('cliente.cliente')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline">
            <h1>
                <center><b>Detalles - Nota Venta</b></center>
            </h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('notaVentasCliente.index') }}" class="primary-btn order-submit">
                        <i class="fa fa-arrow-left"></i>
                        Volver</a>
                </div>
                <div class="pagination justify-content-end">
                    {{ $detallesNotaVenta->links() }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio (Bs)</th>
                            <th>Total (Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valor = 1;
                        $total = 0;
                        ?>
                        @foreach ($detallesNotaVenta as $detalleNotaVenta)
                            <tr>
                                <th scope="row">{{ $valor++ }}</th>
                                <td>{{ $detalleNotaVenta->producto->nombre }}</td>
                                <td>{{ $detalleNotaVenta->cantidad }}</td>
                                <td>{{ $detalleNotaVenta->precio }}</td>
                                <td>{{ $detalleNotaVenta->cantidad * $detalleNotaVenta->precio }}</td>
                                <?php $total += $detalleNotaVenta->cantidad * $detalleNotaVenta->precio; ?>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Monto Total</th>
                            <td>{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination justify-content-end">
            {{ $detallesNotaVenta->links() }}
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
