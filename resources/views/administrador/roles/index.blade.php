@extends('administrador.admin')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline">
            <H1><center><b>ROLES Y PERMISOS</b></center></H1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('roles.create') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Registrar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $user) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        <div class="fixed bottom-4 right-4 z-50">
            <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
            </div>
        </div>  
    </div>
@endsection
