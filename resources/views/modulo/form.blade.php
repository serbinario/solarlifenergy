<div class="card-body">
    <div class="form-group {{ $errors->has('potencia') ? 'has-error' : '' }}">
        <label for="potencia" class="col-md-2 control-label text-bold">Potência.:</label>
        <div class="col-md-10">
            <input readonly class="form-control input-sm" name="potencia" type="text" id="potencia" value="{{ old('potencia', isset($modulo->potencia) ? $modulo->potencia : null) }}" placeholder="">
            {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('rendimento') ? 'has-error' : '' }}">
        <label for="rendimento" class="col-md-2 control-label text-bold">Redimento.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="rendimento" type="text" id="rendimento" value="{{ old('rendimento', isset($modulo->rendimento) ? $modulo->rendimento : null) }}" placeholder="">
            {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('area_total') ? 'has-error' : '' }}">
        <label for="area_total" class="col-md-2 control-label text-bold">Área Total.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="area_total" type="text" id="area_total" value="{{ old('area_total', isset($modulo->area_total) ? $modulo->area_total : null) }}" placeholder="">
            {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('area_geracao') ? 'has-error' : '' }}">
        <label for="area_geracao" class="col-md-2 control-label text-bold">Área Geração.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="area_geracao" type="text" id="area_geracao" value="{{ old('area_geracao', isset($modulo->area_geracao) ? $modulo->area_geracao : null) }}" placeholder="">
            {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
        <label for="is_active" class="col-md-2 control-label text-bold">Ativo?.:</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', isset($modulo->is_active) ? $modulo->is_active : null) == '1' ? 'checked' : '' }}>
                    Sim
                </label>
            </div>

            {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
        </div>
    </div>






</div>

