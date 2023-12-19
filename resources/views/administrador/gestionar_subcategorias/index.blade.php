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
                        <center><b>SUBCATEGORIAS</b></center>
                    </h1>
                    <a href="{{ url('administrador/subcategorias/create') }}" class="btn btn-primary float-end">Nueva
                        subcategoria</a>
                </div>
                <div class="pagination justify-content-end">
                    {!! $subcategorias->links() !!}
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategorias as $subcategoria)
                            <tr>
                                <td>{{ $subcategoria->id }}</td>
                                <td>{{ $subcategoria->nombre }}</td>
                                <td>{{ $subcategoria->categoria->nombre }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('administrador/subcategorias/' . $subcategoria->id . '/edit') }}"
                                            class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $subcategoria->id }}"
                                            onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form action="{{ route('subcategorias.destroy', $subcategoria->id) }}"
                                            id="delete_{{ $subcategoria->id }}" method="POST" enctype="multipart/form-data"
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
                    {!! $subcategorias->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
