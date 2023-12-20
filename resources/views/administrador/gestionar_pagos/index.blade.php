@extends('administrador.admin')

@section('content')
    <!-- ****************************************************-->
    @yield('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-inline">
                    <h1>
                        <center><b>PAGOS</b></center>
                    </h1>
                </div>
                <div class="pagination justify-content-end">
                    {!! $pagos->links() !!}
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Monto Total</th>
                            <th>Fecha Hora</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th># Nota de Venta</th>
                            <th>QR</th>
                            <th>Pago Facil ID</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->monto_total }}</td>
                                <td>{{ $pago->fecha_hora }}</td>
                                @if ($pago->estado == 0)
                                    <td>No Pagado</td>
                                @else
                                    <td>Pagado</td>
                                @endif
                                <td>{{ $pago->tipo }}</td>
                                <td>{{ $pago->nota_venta_id }}</td>
                                <td><img src="{{ url($pago->url) }}" alt="" width="100"></td>
                                <td>{{ $pago->pago_facil_id }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('administrador/pagos/' . $pago->id . '/edit') }}"
                                            class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-end">
                    {!! $pagos->links() !!}
                </div>
                <div class="fixed bottom-4 right-4 z-50">
                    <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                        <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
