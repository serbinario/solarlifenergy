<div class="card-body">

    @if(isset($preProposta->cliente->id))
        <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
            <label for="nome" class="col-md-2 control-label text-bold">Cliente.:</label>
            <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($preProposta->cliente->cep) ? $preProposta->cliente->cep : null) }}" >
            <input name="cliente_id" type="hidden" id="cliente_id" value="{{ old('id', isset($preProposta->cliente->id) ? $preProposta->cliente->id : null) }}" >
            <input name="estado" type="hidden" id="estado" value="{{ old('estado', isset($preProposta->cliente->estado) ? $preProposta->cliente->estado : null) }}" >
            <div class="col-md-10">
                <input class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($preProposta->cliente->nome) ? $preProposta->cliente->nome : null) }}" readonly >
                {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @else
        <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
            <label for="cliente_id" class="col-md-2 control-label text-bold">Cliente.:</label>
            <div class="col-md-10">
                <select class="form-control" id="cliente_id" name="cliente_id">
                    <option value="" style="display: none;" {{ old('cliente_id', isset($preProposta->cliente_id) ? $preProposta->cliente_id : '') == '' ? 'selected' : '' }} disabled selected>Select cliente</option>
                    @foreach ($Clientes as $key => $Cliente)
                        <option value="{{ $key }}" {{ old('cliente_id', isset($preProposta->cliente_id) ? $preProposta->cliente_id : null) == $key ? 'selected' : '' }}>
                            {{ $Cliente }}
                        </option>
                    @endforeach
                </select>

                {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endif

    <div class="form-group {{ $errors->has('power') ? 'has-error' : '' }}">
        <label for="monthly_usage" class="col-md-2 control-label text-bold">Média consumo Kwh.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="monthly_usage" type="text" id="monthly_usage" value="{{ old('monthly_usage', isset($preProposta->monthly_usage) ? $preProposta->monthly_usage : null) }}" maxlength="10" placeholder="Consumo médio em Kwh">
            {!! $errors->first('monthly_usage', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('power') ? 'has-error' : '' }}">
        <label for="preco_medio_instalado" class="col-md-2 control-label text-bold">Valor Proposta.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm money" name="preco_medio_instalado" type="text" id="preco_medio_instalado" value="{{ old('preco_medio_instalado', isset($preProposta->preco_medio_instalado) ? $preProposta->preco_medio_instalado : null) }}" maxlength="10" placeholder="Enter power here...">
            {!! $errors->first('preco_medio_instalado', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('potencia_instalada') ? 'has-error' : '' }}">
        <label for="potencia_instalada" class="col-md-2 control-label text-bold">Pot. do gerador (KWp).:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="potencia_instalada" type="text" id="potencia_instalada" value="{{ old('potencia_instalada', isset($preProposta->potencia_instalada) ? $preProposta->potencia_instalada : null) }}" maxlength="10" placeholder="Enter quantity here...">
            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('minima_area') ? 'has-error' : '' }}">
        <label for="minima_area" class="col-md-2 control-label text-bold">Área ( m²).:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="minima_area" type="text" id="minima_area" value="{{ old('minimum_area', isset($preProposta->minima_area) ? $preProposta->minima_area : null) }}" maxlength="10" placeholder="Enter minimum area here...">
            {!! $errors->first('minima_area', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('minima_area') ? 'has-error' : '' }}">
        <label for="preco_kwh" class="col-md-2 control-label text-bold">Preço do KWh.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm 7 kwh " name="preco_kwh" type="text" id="preco_kwh" value="{{ old('preco_kwh', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : null) }}" maxlength="10" placeholder="#,####">
            {!! $errors->first('preco', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('qtd_paineis') ? 'has-error' : '' }}">
        <label for="qtd_paineis" class="col-md-2 control-label text-bold">Quantidade de painéis.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" value="{{ old('qtd_paineis', isset($preProposta->qtd_paineis) ? $preProposta->qtd_paineis : null) }}" min="0" max="10" placeholder="Enter average weight here...">
            {!! $errors->first('qtd_paineis', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('panel_potencia') ? 'has-error' : '' }}">
        <label for="panel_potencia" class="col-md-2 control-label text-bold">Painel Potência.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="panel_potencia" type="text" id="panel_potencia" value="{{ old('panel_potencia', isset($preProposta->panel_potencia) ? $preProposta->panel_potencia : null) }}" min="-99999999" max="99999999" placeholder="Enter real power here..." step="any">
            {!! $errors->first('panel_potencia', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('economia_anula') ? 'has-error' : '' }}">
        <label for="economia_anula" class="col-md-2 control-label text-bold">Economia anual .:</label>
        <div class="col-md-10">
            <input class="form-control input-sm money" name="economia_anula" type="text" id="value" value="{{ old('economia_anula', isset($preProposta->economia_anula) ? $preProposta->economia_anula : null) }}" placeholder="Enter value here..." step="any">
            {!! $errors->first('economia_anula', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

        <div class="col-lg-12">
            <h4 class="text-bold">Histórico de Consumo</h4>
            <hr class="ruler-lg"/>
        </div>

    <div class="form-group {{ $errors->has('jan') ? 'has-error' : '' }}">
        <label for="jan" class="col-md-2 control-label text-bold">Jan.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="jan" type="text" id="jan" value="{{ old('jan', isset($preProposta->jan) ? $preProposta->jan : null) }}" maxlength="10" placeholder="Enter jan here...">
            {!! $errors->first('jan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('feb') ? 'has-error' : '' }}">
        <label for="feb" class="col-md-2 control-label text-bold">Feb.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="feb" type="text" id="feb" value="{{ old('feb', isset($preProposta->feb) ? $preProposta->feb : null) }}" maxlength="10" placeholder="Enter feb here...">
            {!! $errors->first('feb', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('mar') ? 'has-error' : '' }}">
        <label for="mar" class="col-md-2 control-label text-bold">Mar.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="mar" type="text" id="mar" value="{{ old('mar', isset($preProposta->mar) ? $preProposta->mar : null) }}" maxlength="10" placeholder="Enter mar here...">
            {!! $errors->first('mar', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('apr') ? 'has-error' : '' }}">
        <label for="apr" class="col-md-2 control-label text-bold">Apr.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="apr" type="text" id="apr" value="{{ old('apr', isset($preProposta->apr) ? $preProposta->apr : null) }}" maxlength="10" placeholder="Enter apr here...">
            {!! $errors->first('apr', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('may') ? 'has-error' : '' }}">
        <label for="may" class="col-md-2 control-label text-bold">May.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="may" type="text" id="may" value="{{ old('may', isset($preProposta->may) ? $preProposta->may : null) }}" maxlength="10" placeholder="Enter may here...">
            {!! $errors->first('may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('jun') ? 'has-error' : '' }}">
        <label for="jun" class="col-md-2 control-label text-bold">Jun.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="jun" type="text" id="jun" value="{{ old('jun', isset($preProposta->jun) ? $preProposta->jun : null) }}" maxlength="10" placeholder="Enter jun here...">
            {!! $errors->first('jun', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('jul') ? 'has-error' : '' }}">
        <label for="jul" class="col-md-2 control-label text-bold">Jul.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="jul" type="text" id="jul" value="{{ old('jul', isset($preProposta->jul) ? $preProposta->jul : null) }}" maxlength="10" placeholder="Enter jul here...">
            {!! $errors->first('jul', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('aug') ? 'has-error' : '' }}">
        <label for="aug" class="col-md-2 control-label text-bold">Aug.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="aug" type="text" id="aug" value="{{ old('aug', isset($preProposta->aug) ? $preProposta->aug : null) }}" maxlength="10" placeholder="Enter aug here...">
            {!! $errors->first('aug', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('sep') ? 'has-error' : '' }}">
        <label for="sep" class="col-md-2 control-label text-bold">Sep.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="sep" type="text" id="sep" value="{{ old('sep', isset($preProposta->sep) ? $preProposta->sep : null) }}" maxlength="10" placeholder="Enter sep here...">
            {!! $errors->first('sep', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('oct') ? 'has-error' : '' }}">
        <label for="oct" class="col-md-2 control-label text-bold">Oct.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="oct" type="text" id="oct" value="{{ old('oct', isset($preProposta->oct) ? $preProposta->oct : null) }}" maxlength="10" placeholder="Enter oct here...">
            {!! $errors->first('oct', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('nov') ? 'has-error' : '' }}">
        <label for="nov" class="col-md-2 control-label text-bold">Nov.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="nov" type="text" id="nov" value="{{ old('nov', isset($preProposta->nov) ? $preProposta->nov : null) }}" maxlength="10" placeholder="Enter nov here...">
            {!! $errors->first('nov', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('dec') ? 'has-error' : '' }}">
        <label for="dec" class="col-md-2 control-label text-bold">Dec.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="dec" type="text" id="dec" value="{{ old('dec', isset($preProposta->dec) ? $preProposta->dec : null) }}" maxlength="10" placeholder="Enter dec here...">
            {!! $errors->first('dec', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

