@extends('cliente.cliente')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline">
            <h1>
                <center><b>Pago - QR</b></center>
            </h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('pagosCliente.index') }}" class="primary-btn order-submit">
                        <i class="fa fa-arrow-left"></i>
                        Volver</a>
                </div>
                <div class="pagination justify-content-end">
                </div>
            </div>
            <div class="text-center mt-3">
                <img src="{{ url($pago->url) }}" alt="Imagen" class="img-fluid" style="max-width: 400px; height: auto;">
                <!-- Ajusta la ruta y los estilos según tus necesidades -->
            </div>
        </div>
        <div class="pagination justify-content-end">
        </div>
    </div>
@endsection
