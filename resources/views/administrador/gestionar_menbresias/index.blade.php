@extends('administrador.admin')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline">
            <h1>
                <center><b>MENBRESIAS</b></center>
            </h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('menbresias.create') }}" class="btn btn-primary ml-auto">
                        <i class="fas fa-plus"></i>
                        Agregar</a>
                </div>
                <div class="pagination justify-content-end">
                    {{ $menbresias->links() }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Periodo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menbresias as $menbresia)
                            <tr>
                                <th scope="row">{{ $menbresia->id }}</th>
                                <td><img src="{{$menbresia->url}}" alt="" width="150"></td>
                                <td>{{ $menbresia->nombre }}</td>
                                <td>{{ $menbresia->precio }} Bs.</td>
                                <td>{{ $menbresia->periodo }} días</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('menbresias.edit', $menbresia->id) }}" class="btn btn-primary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $menbresia->id }}"
                                            onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form action="{{ route('menbresias.destroy', $menbresia->id) }}"
                                            id="delete_{{ $menbresia->id }}" method="POST" enctype="multipart/form-data"
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
        </div>
        <div class="pagination justify-content-end">
            {{ $menbresias->links() }}
        </div>
        <div class="fixed bottom-4 right-4 z-50">
            <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
            </div>
        </div>  
    </div>
@endsection
