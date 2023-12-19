@extends('administrador.admin')

@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-110">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Agregar Nueva Subcategoria</h1>
                            <p class="lead">
                                Asegurese de ingresar los datos correctos
                            </p>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <!--route de form -->
                                    <form action="{{ route('subcategorias.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!--  {{ csrf_field() }}  -->
                                        <!--  -->
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control form-control-lg" type="text" name="nombre"
                                                placeholder="Ingrese el nombre del producto" />
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Subcategoria</label>
                                            <select name="categoria_id" class="form-control">
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                                <option selected value=""> Seleccione Una categoria... </option>
                                            </select>
                                            @error('categoria_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
                                            <a href="{{ url('administrador/subcategorias') }}"
                                                class="btn btn-primary float-end">Volver</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
