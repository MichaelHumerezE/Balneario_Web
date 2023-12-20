@extends('administrador.admin')

@section('content')
    <!-- ****************************************************-->
    @yield('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <h2>
                            <center><b>PRODUCTOS</b></center>
                        </h2>
                        <a href="{{ url('administrador/producto/create') }}" class="btn btn-primary float-end">Nuevo
                            Producto</a>
                        <a href="{{ route('reportes.producto', 'pdf') }}" class="btn btn-info">
                            Reporte PDF <i class="fa fa-file"></i></a>
                        <a href="{{ route('reportes.producto', 'csv') }}" class="btn btn-info">
                            Reporte CSV <i class="fa fa-file"></i></a>
                        <a href="{{ route('reportes.producto', 'xlsx') }}" class="btn btn-info">
                            Reporte XLSX <i class="fa fa-file-excel"></i></a>

                    </h4>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Subategoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td><img src="{{$producto->url}}" alt="" width="150"></td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->precio }} Bs.</td>
                                <td>{{ $producto->subcategoria->nombre }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('administrador/producto/' . $producto->id . '/edit') }}"
                                            class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $producto->id }}"
                                            onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form action="{{ route('producto.destroy', $producto->id) }}"
                                            id="delete_{{ $producto->id }}" method="POST" enctype="multipart/form-data"
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
            </div>
            <div class="fixed bottom-4 right-4 z-50">
                <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                    <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
                </div>
            </div>  
        </div>
    </div>
@endsection
