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
                        <center><b>Nota Ventas</b></center>
                    </h1>
                </div>
                <div class="pagination justify-content-end">
                    {!! $nota_ventas->links() !!}
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIT</th>
                            <th>Fecha Hora</th>
                            <th>Monto Total</th>
                            <th>Nombre del Cliente</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nota_ventas as $nota_venta)
                            <tr>
                                <td>{{ $nota_venta->id }}</td>
                                <td>{{ $nota_venta->nit }}</td>
                                <td>{{ $nota_venta->fecha_hora }}</td>
                                <td>{{ $nota_venta->monto_total }}</td>
                                <td>{{ $nota_venta->nombre_cliente }}</td>
                                <td>{{ $nota_venta->users->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('administrador/notaVentas/' . $nota_venta->id . '/edit') }}"
                                            class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('notaVentas.show', $nota_venta->id) }}" class="btn btn-dark"><i
                                                class="fas fa-eye"></i></a>
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $nota_venta->id }}">
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        <form action="{{ route('notaVentas.destroy', $nota_venta->id) }}"
                                            id="delete_{{ $nota_venta->id }}" method="POST" enctype="multipart/form-data"
                                            hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-end">
                    {!! $nota_ventas->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
