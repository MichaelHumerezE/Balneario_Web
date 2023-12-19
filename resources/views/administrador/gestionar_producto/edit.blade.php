@extends('administrador.admin')

@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-110">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Modificar Producto</h1>
                            <p class="lead">
                                Asegurese de ingresar los datos correctos
                            </p>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <!--route de form -->
                                    <form action="{{ route('producto.update', $producto->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <!--  {{ csrf_field() }}  -->
                                        <!--  -->
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control form-control-lg" type="text" name="nombre"
                                                value="{{ $producto->nombre }}" placeholder="Ingrese el nombre del producto" />
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripcion</label>
                                            <input class="form-control form-control-lg" type="text" name="descripcion"
                                                value="{{ $producto->descripcion }}" placeholder="Ingrese una descripcion" />
                                            @error('descripcion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock</label>
                                            <input class="form-control form-control-lg" type="integer" name="stock"
                                                value="{{ $producto->stock }}" placeholder="" />
                                            @error('stock')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio</label>
                                            <input class="form-control form-control-lg" type="decimal" name="precio"
                                                value="{{ $producto->precio }}" placeholder="00.00" />
                                            @error('precio')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">subcategoria</label>
                                            <select name="subcategoria_id" class="form-control">
                                                @foreach ($subcategorias as $subcategoria)
                                                    <option value="{{ $subcategoria->id }}"
                                                        @if ($subcategoria->id == $producto->subcategoria_id) selected @endif>
                                                        {{ $subcategoria->nombre }}
                                                    </option>
                                                @endforeach
                                                <option value=""> Seleccione Una subcategoria... </option>
                                            </select>
                                            @error('subcategoria_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Imagen</label>
                                            <input class="form-control" type="file" name="imagen" />
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
                                            <a href="{{ url('administrador/producto') }}"
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
