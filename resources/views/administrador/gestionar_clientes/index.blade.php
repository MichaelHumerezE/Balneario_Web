@extends('administrador.admin')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline">
            <h1><center><b>CLIENTES</b></center></h1>
        </div>
        <div class="card-body">
            <div class="row">
                @can('cliente.create')
                    <div class="col-2">
                        <a href="{{ route('clientes.create') }}" class="btn btn-primary ml-auto">
                            <i class="fas fa-plus"></i>
                            Agregar</a>
                    </div>
                @endcan
                <div class="pagination justify-content-end">
                    {{ $clientes->links() }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>CI</th>
                            <th>Sexo</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valor = 1;
                        ?>
                        @foreach ($clientes as $cliente)
                                <tr>
                                    <th scope="row">{{ $valor++ }}</th>
                                    <td>{{ $cliente->name }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->ci }}</td>
                                    <td>{{ $cliente->sexo }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @can('cliente.update')
                                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('cliente.delete')
                                                <button type="submit" class="btn btn-danger" form="delete_{{ $cliente->id }}"
                                                    onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                    id="delete_{{ $cliente->id }}" method="POST"
                                                    enctype="multipart/form-data" hidden>
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination justify-content-end">
            {{ $clientes->links() }}
        </div>
        <div class="fixed bottom-4 right-4 z-50">
            <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
            </div>
        </div>  
    </div>
@endsection
