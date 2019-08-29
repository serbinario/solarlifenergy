<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
        <label for="clientes_id" class="col-md-2 control-label">Clientes</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="clientes_id" name="clientes_id">
                <option value="" style="display: none;" {{ old('clientes_id', isset($projeto->clientes_id) ? $projeto->clientes_id : '') == '' ? 'selected' : '' }} disabled selected>Select clientes</option>
                @foreach ($clientes as $key => $cliente)
                    <option value="{{ $key }}" {{ old('clientes_id', isset($projeto->clientes_id) ? $projeto->clientes_id : null) == $key ? 'selected' : '' }}>
                        {{ $cliente }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('clientes_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('users_id') ? 'has-error' : '' }}">
        <label for="users_id" class="col-md-2 control-label">Intergrador</label>
        <div class="col-md-10">

            @role('admin')
                <select   class="form-control" id="users_id" name="users_id">
            @else
                <select  disabled="true" class="form-control" id="users_id" name="users_id">
                    @endrole


                <option value="" style="display: none;" {{ old('users_id', isset($projeto->users_id) ? $projeto->users_id : '') == '' ? 'selected' : '' }} disabled selected>Intergrador</option>
                @foreach ($users as $key => $user)
                    <option value="{{ $key }}" {{ old('users_id', isset($projeto->users_id) ? $projeto->users_id : null) == $key ? 'selected' : '' }}>
                        {{ $user }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('conta_bancaria_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('consumo') ? 'has-error' : '' }}">
        <label for="consumo" class="col-md-2 control-label">Consumo</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="consumo" name="consumo">
                <option value="" style="display: none;" {{ old('consumo', isset($projeto->consumo) ? $projeto->consumo : '') == '' ? 'selected' : '' }} disabled selected>Enter consumo here...</option>
                @foreach (['30 - 100' => '30 - 100',
    '110 - 300' => '110 - 300',
    '350 - 600' => '350 - 600',
    '700 - 1.000' => '700 - 1.000',
    '1.100 - 1.500' => '1.100 - 1.500',
    '1.900 - 5.000' => '1.900 - 5.000',
    '6.000 - 8.000' => '6.000 - 8.000',
    'ACIMA DE 10.000' => 'ACIMA DE 10.000'] as $key => $text)
                    <option value="{{ $key }}" {{ old('consumo', isset($projeto->consumo) ? $projeto->consumo : null) == $key ? 'selected' : '' }}>
                        {{ $text }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('consumo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('area_disponivel') ? 'has-error' : '' }}">
        <label for="area_disponivel" class="col-md-2 control-label">Area Disponivel</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="area_disponivel" type="number" id="area_disponivel" value="{{ old('area_disponivel', isset($projeto->area_disponivel) ? $projeto->area_disponivel : null) }}" min="-2147483648" max="2147483647" placeholder="Enter area disponivel here...">
            {!! $errors->first('area_disponivel', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('projeto_codigo') ? 'has-error' : '' }}">
        <label for="projeto_codigo" class="col-md-2 control-label">Projeto Codigo</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="projeto_codigo" type="number" id="projeto_codigo" readonly value="{{ old('projeto_codigo', isset($projeto->projeto_codigo) ? $projeto->projeto_codigo : null) }}" placeholder="projeto_codigo...">
            {!! $errors->first('projeto_codigo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('prioridade') ? 'has-error' : '' }}">
        <label for="prioridade" class="col-md-2 control-label">Prioridade</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="prioridade" name="prioridade">
                <option value="" style="display: none;" {{ old('prioridade', isset($projeto->prioridade) ? $projeto->prioridade : '') == '' ? 'selected' : '' }} disabled selected>Prioridade...</option>
                @foreach ([
    'Alta' => 'Alta',
    'Media' => 'Media',
    'Baixa' => 'Baixa'] as $key => $text)
                    <option value="{{ $key }}" {{ old('prioridade', isset($projeto->prioridade) ? $projeto->prioridade : null) == $key ? 'selected' : '' }}>
                        {{ $text }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('consumo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('kw') ? 'has-error' : '' }}">
        <label for="kw" class="col-md-2 control-label">KWP</label>
        <div class="col-md-10">
            <input class="form-control input-sm money" name="kw" type="text" id="kw"  value="{{ old('kw', isset($projeto->kw) ? $projeto->kw : null) }}" placeholder="KW...">
            {!! $errors->first('kw', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('valor_projeto') ? 'has-error' : '' }}">
        <label for="valor_projeto" class="col-md-2 control-label">Valor de Projeto</label>
        <div class="col-md-10">
            <input class="form-control input-sm money" name="valor_projeto" type="text" id="valor_projeto"  value="{{ old('valor_projeto', isset($projeto->valor_projeto) ? $projeto->valor_projeto : null) }}" placeholder="Valor Projeto...">
            {!! $errors->first('valor_projeto', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Cadastro de Contas de Energia</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    @if(isset($projeto))
        @foreach( $projeto->contratos as $contrato )
            <div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                <label for="num_contrato" class="col-md-2 control-label">Contrato Celpe</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="num_contrato[]" type="number" id="num_contrato" value="{{ old('contrato_celpe', isset($contrato) ? $contrato->num_contrato : null) }}" placeholder="Contrato Celpe...">
                </div>
            </div>
        @endforeach
    @else
        <div class="form-group{{ $errors->has('num_contrato') ? 'has-error' : '' }}">
            <label for="num_contrato" class="col-sm-4 control-label">Contrato Celpe</label>
            <div class="col-md-8">
                <input class="form-control input-sm" name="num_contrato[]" type="number" id="num_contrato" value="{{ old('contrato_celpe', isset($contrato) ? $contrato->num_contrato : null) }}" placeholder="Contrato Celpe...">
            </div>
        </div>
    @endif


    <div class="row after-add-more">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                <div class="col-md-2">
                    <div class="">
                        <label for="">
                            <button class="btn btn-success add-more btn-sm" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
        <label for="obs" class="col-md-2 control-label">Obs</label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projeto->obs) ? $projeto->obs : null) }}</textarea>
            {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


</div>

