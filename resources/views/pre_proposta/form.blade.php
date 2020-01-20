<div class="card-body">


    <div class="row">
        <div class="col-sm-6">
            @if(isset($preProposta->cliente->id))
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="nome" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($preProposta->cliente->cep) ? $preProposta->cliente->cep : null) }}" >
                    <input name="cliente_id" type="hidden" id="cliente_id" value="{{ old('id', isset($preProposta->cliente->id) ? $preProposta->cliente->id : null) }}" >
                    <input name="estado" type="hidden" id="estado" value="{{ old('estado', isset($preProposta->cliente->estado) ? $preProposta->cliente->estado : null) }}" >
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($preProposta->cliente->nome) ? $preProposta->cliente->nome : null) }}" readonly >
                        {!! $errors->first('clientes_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="cliente_id" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <div class="col-md-8">
                        <select class="form-control  input-sm" id="cliente_id" name="cliente_id">
                            <option value="" style="display: none;" {{ old('cliente_id', isset($preProposta->cliente_id) ? $preProposta->cliente_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione um Cliente</option>
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
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="data_validade" class="col-sm-5 control-label text-bold">Data Validade.:</label>
                <div class="col-md-7">
                    <input class="form-control input-sm date" name="data_validade" type="text" id="data_validade" value="{{ old('data_validade', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="codigo" class="col-sm-4 control-label text-bold">Codigo.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="codigo" type="number" id="codigo" readonly value="{{ old('codigo', isset($preProposta->codigo) ? $preProposta->codigo : null) }}" >
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('power') ? 'has-error' : '' }}">
                <label for="monthly_usage" class="col-sm-4 control-label text-bold">Média consumo Kwh.:.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm number" name="monthly_usage" type="text" id="monthly_usage" value="{{ old('monthly_usage', isset($preProposta->monthly_usage) ? $preProposta->monthly_usage : null) }}" maxlength="10" placeholder="Consumo médio em Kwh">
                    {!! $errors->first('monthly_usage', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('preco_kwh') ? 'has-error' : '' }}">
                <label for="preco_kwh" class="col-sm-4 control-label text-bold">Preço do KWh R$.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm 7 kwh " name="preco_kwh" type="text" id="preco_kwh" value="{{ old('preco_kwh', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : null) }}" maxlength="10" placeholder="#,####">
                    {!! $errors->first('preco', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('potencia_instalada') ? 'has-error' : '' }}">
                <label for="potencia_instalada" class="col-sm-4 control-label text-bold">Pot. do gerador (KWp).:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm kwp" name="potencia_instalada" type="text" id="potencia_instalada" value="{{ old('potencia_instalada', isset($preProposta->potencia_instalada) ? $preProposta->potencia_instalada : null) }}" maxlength="10" placeholder="Enter quantity here...">
                    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('preco_medio_instalado') ? 'has-error' : '' }}">
                <label for="preco_medio_instalado" class="col-sm-4 control-label text-bold">Valor Proposta R$.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm money" name="preco_medio_instalado" type="text" id="preco_medio_instalado" value="{{ old('preco_medio_instalado', isset($preProposta->preco_medio_instalado) ? $preProposta->preco_medio_instalado : null) }}" maxlength="12" placeholder="Enter power here...">
                    {!! $errors->first('preco_medio_instalado', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('qtd_paineis') ? 'has-error' : '' }}">
                <label for="qtd_paineis" class="col-sm-4 control-label text-bold">Quantidade de painéis.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" value="{{ old('qtd_paineis', isset($preProposta->qtd_paineis) ? $preProposta->qtd_paineis : null) }}" min="0" max="10" placeholder="Enter average weight here...">
                    {!! $errors->first('qtd_paineis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('panel_potencia') ? 'has-error' : '' }}">
                <label for="panel_potencia" class="col-sm-4 control-label text-bold">Painel Potência.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="panel_potencia" type="text" id="panel_potencia" value="{{ old('panel_potencia', isset($preProposta->panel_potencia) ? $preProposta->panel_potencia : null) }}" min="-99999999" max="99999999" placeholder="Enter real power here..." step="any">
                    {!! $errors->first('panel_potencia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('qtd_paineis') ? 'has-error' : '' }}">
                <label for="minima_area" class="col-sm-4 control-label text-bold">Área ( m²).::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="minima_area" type="text" id="minima_area" value="{{ old('minimum_area', isset($preProposta->minima_area) ? $preProposta->minima_area : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('minima_area', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group"{{ $errors->has('panel_potencia') ? 'has-error' : '' }}">
                <label for="economia_anula" class="col-sm-4 control-label text-bold">Economia anual R$.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm money" name="economia_anula" type="text" id="value" value="{{ old('economia_anula', isset($preProposta->economia_anula) ? $preProposta->economia_anula : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('economia_anula', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <h4 class="text-bold">Histórico de consumo fora da ponta</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('jan') ? 'has-error' : '' }}">
                <label for="jan" class="col-sm-4 control-label text-bold">Jan.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="jan" type="text" id="jan" value="{{ old('minimum_area', isset($preProposta->jan) ? $preProposta->jan : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('jan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('feb') ? 'has-error' : '' }}">
                <label for="feb" class="col-sm-4 control-label text-bold">Fev.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="feb" type="text" id="feb" value="{{ old('feb', isset($preProposta->feb) ? $preProposta->feb : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('feb', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('mar') ? 'has-error' : '' }}">
                <label for="mar" class="col-sm-4 control-label text-bold">Mar.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="mar" type="text" id="mar" value="{{ old('mar', isset($preProposta->mar) ? $preProposta->mar : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('mar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('apr') ? 'has-error' : '' }}">
                <label for="apr" class="col-sm-4 control-label text-bold">Abr.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="apr" type="text" id="apr" value="{{ old('apr', isset($preProposta->apr) ? $preProposta->apr : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('apr', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('may') ? 'has-error' : '' }}">
                <label for="may" class="col-sm-4 control-label text-bold">Mai.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="may" type="text" id="may" value="{{ old('may', isset($preProposta->may) ? $preProposta->may : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('may', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('jun') ? 'has-error' : '' }}">
                <label for="jun" class="col-sm-4 control-label text-bold">Jun.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="jun" type="text" id="jun" value="{{ old('jun', isset($preProposta->jun) ? $preProposta->jun : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('jun', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('jul') ? 'has-error' : '' }}">
                <label for="jul" class="col-sm-4 control-label text-bold">Jul.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="jul" type="text" id="jul" value="{{ old('jul', isset($preProposta->jul) ? $preProposta->jul : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('jul', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('aug') ? 'has-error' : '' }}">
                <label for="aug" class="col-sm-4 control-label text-bold">Ago.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="aug" type="text" id="aug" value="{{ old('aug', isset($preProposta->aug) ? $preProposta->aug : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('aug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('sep') ? 'has-error' : '' }}">
                <label for="sep" class="col-sm-4 control-label text-bold">Set.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="sep" type="text" id="sep" value="{{ old('sep', isset($preProposta->sep) ? $preProposta->sep : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('sep', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('oct') ? 'has-error' : '' }}">
                <label for="oct" class="col-sm-4 control-label text-bold">Out.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="oct" type="text" id="oct" value="{{ old('oct', isset($preProposta->oct) ? $preProposta->oct : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('oct', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('nov') ? 'has-error' : '' }}">
                <label for="nov" class="col-sm-4 control-label text-bold">Nov.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="nov" type="text" id="nov" value="{{ old('nov', isset($preProposta->nov) ? $preProposta->nov : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('nov', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('dec') ? 'has-error' : '' }}">
                <label for="dec" class="col-sm-4 control-label text-bold">Dez.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="dec" type="text" id="dec" value="{{ old('dec', isset($preProposta->dec) ? $preProposta->dec : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('dec', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <h4 class="text-bold">Histórico de consumo na ponta</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_jan') ? 'has-error' : '' }}">
                <label for="na_ponta_jan" class="col-sm-4 control-label text-bold">Jan.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_jan" type="text" id="na_ponta_jan" value="{{ old('minimum_area', isset($preProposta->na_ponta_jan) ? $preProposta->na_ponta_jan : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('na_ponta_jan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_feb') ? 'has-error' : '' }}">
                <label for="na_ponta_feb" class="col-sm-4 control-label text-bold">Fev.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_feb" type="text" id="na_ponta_feb" value="{{ old('na_ponta_feb', isset($preProposta->na_ponta_feb) ? $preProposta->na_ponta_feb : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_feb', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_mar') ? 'has-error' : '' }}">
                <label for="na_ponta_mar" class="col-sm-4 control-label text-bold">Mar.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_mar" type="text" id="na_ponta_mar" value="{{ old('na_ponta_mar', isset($preProposta->na_ponta_mar) ? $preProposta->na_ponta_mar : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_mar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_apr') ? 'has-error' : '' }}">
                <label for="na_ponta_apr" class="col-sm-4 control-label text-bold">Abr.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_apr" type="text" id="na_ponta_apr" value="{{ old('na_ponta_apr', isset($preProposta->na_ponta_apr) ? $preProposta->na_ponta_apr : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_apr', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_may') ? 'has-error' : '' }}">
                <label for="na_ponta_may" class="col-sm-4 control-label text-bold">Mai.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_may" type="text" id="na_ponta_may" value="{{ old('na_ponta_may', isset($preProposta->na_ponta_may) ? $preProposta->na_ponta_may : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('na_ponta_may', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_jun') ? 'has-error' : '' }}">
                <label for="na_ponta_jun" class="col-sm-4 control-label text-bold">Jun.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_jun" type="text" id="na_ponta_jun" value="{{ old('na_ponta_jun', isset($preProposta->na_ponta_jun) ? $preProposta->na_ponta_jun : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_jun', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_jul') ? 'has-error' : '' }}">
                <label for="na_ponta_jul" class="col-sm-4 control-label text-bold">Jul.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_jul" type="text" id="na_ponta_jul" value="{{ old('na_ponta_jul', isset($preProposta->na_ponta_jul) ? $preProposta->na_ponta_jul : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_jul', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_aug') ? 'has-error' : '' }}">
                <label for="na_ponta_aug" class="col-sm-4 control-label text-bold">Ago.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_aug" type="text" id="na_ponta_aug" value="{{ old('na_ponta_aug', isset($preProposta->na_ponta_aug) ? $preProposta->na_ponta_aug : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_aug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_sep') ? 'has-error' : '' }}">
                <label for="na_ponta_sep" class="col-sm-4 control-label text-bold">Set.::</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_sep" type="text" id="na_ponta_sep" value="{{ old('na_ponta_sep', isset($preProposta->na_ponta_sep) ? $preProposta->na_ponta_sep : null) }}" maxlength="10" placeholder="Enter minimum area here...">
                    {!! $errors->first('na_ponta_sep', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_oct') ? 'has-error' : '' }}">
                <label for="na_ponta_oct" class="col-sm-4 control-label text-bold">Out.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_oct" type="text" id="na_ponta_oct" value="{{ old('na_ponta_oct', isset($preProposta->na_ponta_oct) ? $preProposta->na_ponta_oct : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_oct', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_nov') ? 'has-error' : '' }}">
                <label for="na_ponta_nov" class="col-sm-4 control-label text-bold">Nov.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_nov" type="text" id="na_ponta_nov" value="{{ old('na_ponta_nov', isset($preProposta->na_ponta_nov) ? $preProposta->na_ponta_nov : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_nov', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group"{{ $errors->has('na_ponta_dec') ? 'has-error' : '' }}">
                <label for="na_ponta_dec" class="col-sm-4 control-label text-bold">Dez.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="na_ponta_dec" type="text" id="na_ponta_dec" value="{{ old('na_ponta_dec', isset($preProposta->na_ponta_dec) ? $preProposta->na_ponta_dec : null) }}" placeholder="Enter value here..." step="any">
                    {!! $errors->first('na_ponta_dec', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>


</div>

