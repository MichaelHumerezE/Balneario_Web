@extends('cliente.cliente')
@section('content')
    <div class="card mt-4">
        @include('layouts.messages')
        <div class="card-body">
            <div class="card-header d-inline-flex">
                <a href="{{ route('pagos.index') }}" class="primary-btn order-submit">
                    <i class="fa fa-arrow-left"></i>
                    Volver</a>
            </div><br>
            <div class="text-center mt-3">
                <img src="{{ url($pago->url) }}" alt="Imagen" class="img-fluid" style="max-width: 400px; height: auto;">
                <!-- Ajusta la ruta y los estilos según tus necesidades -->
            </div>
        </div>
        <div class="card-footer">
            <Button class="primary-btn order-submit" form="create">
                <i class="fa fa-check"></i> Hecho
            </Button>
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
