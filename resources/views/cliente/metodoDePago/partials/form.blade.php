@csrf
<div class="row">
    <div class="billing-details">
        <div class="card-header d-inline-flex">
            <h1>Transferencia por QR Pago Facil</h1>
        </div>
        <div class="col-12">
            <label>Número de cuenta o de telefono a depositar</label>
            <div class="form-floating">
                <input type="number" placeholder="cta" class="form-control" name="cta"
                    value="{{ isset($tipoPago) ? $tipoPago->nroCta : old('nroCta') }}" disabled>
            </div>
        </div>
        <br>
        <div class="col-12">
            <label>Identificación de la cuenta (número de cuenta, teléfono, ci)</label>
            <div class="form-floating">
                <input type="number" placeholder="Ingrese la identificación de su cuenta" class="form-control"
                    name="ctaOrd" value="{{ isset($pago) ? $pago->ctaOrd : old('ctaOrd') }}">
            </div>
        </div>
        <br>
        <div class="col-12">
            <label>ID de transacción</label>
            <div class="form-floating">
                <input type="number" placeholder="Ingrese el ID de transacción" class="form-control" name="idTrans"
                    value="{{ isset($pago) ? $pago->idTrans : old('idTrans') }}">
            </div>
        </div>
        <?php
        date_default_timezone_set('America/La_Paz');
        $dateTime = date('Y-m-d H:i:s');
        $total = 0;
        ?>
        @if ((isset($tipoPago->qr) ? $tipoPago->qr : '') == '')
        @else
            <br>
            <label>Opción de pago por QR habilitado</label>
            <br>
            <div class="col-md-4 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="{{ asset('public/img/' . $tipoPago->qr) }}" alt="...">
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="fechaHora" class="form-control" id="exampleInputPassword1"
            value="{{ $dateTime }}">
        <input type="hidden" name="monto" class="form-control" id="exampleInputPassword1"
            value="{{ $total }}">
    </div>
</div>
<br>
