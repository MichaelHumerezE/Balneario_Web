@csrf
<div class="row">
    <div class="billing-details">
        <div class="col-md-10">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" placeholder="name" class="input" name="name"
                    value="{{ isset($perfil) ? $perfil->name : old('name') }}">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label>CI</label>
                <input type="number" placeholder="ci" class="input" name="ci"
                    value="{{ isset($perfil) ? $perfil->ci : old('ci') }}">
            </div>
        </div>
        <div class="col-md-10">
            <br>
            <h5>Género</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="M"
                    @if ((isset($perfil) ? $perfil->sexo : old('sexo')) == 'M') checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    Masculine
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="F"
                    @if ((isset($perfil) ? $perfil->sexo : old('sexo')) == 'F') checked @endif>
                <label class="form-check-label" for="flexRadioDefault2">
                    Female
                </label>
            </div>
            <br>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="number" placeholder="telefono" class="input" name="telefono"
                    value="{{ isset($perfil) ? $perfil->telefono : old('telefono') }}">
            </div>
        </div>
    </div>
</div>
