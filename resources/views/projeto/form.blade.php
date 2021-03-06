<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @if(isset($projeto->cliente->id))
                <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
                    <label for="nome" class="col-sm-4 control-label  text-bold">Cliente.: *</label>
                    <input name="clientes_id" type="hidden" id="clientes_id" value="{{ old('clientes_id', isset($projeto->cliente->id) ? $projeto->cliente->id : null) }}" >
                    <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($projeto->cliente->cep) ? $projeto->cliente->cep : null) }}" >
                    <input name="estado" type="hidden" id="estado" value="{{ old('estado', isset($projeto->cliente->estado) ? $projeto->cliente->estado : null) }}" >
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($projeto->cliente->nome) ? $projeto->cliente->nome : null) }}" readonly >
                        {!! $errors->first('clientes_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
                    <label for="clientes_id" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <div class="col-md-8">
                        <select name="clientes_id" class="form-control select2_clientes" data-placeholder="Selecione">
                        </select>
                        {!! $errors->first('clientes_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('projeto_codigo') ? 'has-error' : '' }}">
                <label for="projeto_codigo" class="col-sm-4 control-label text-bold">Código.:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="projeto_codigo" type="number" id="projeto_codigo" readonly value="{{ old('projeto_codigo', isset($projeto->projeto_codigo) ? $projeto->projeto_codigo : null) }}" placeholder="Código do Projeto">
                    {!! $errors->first('projeto_codigo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    @role('admin')
    <div class="form-group {{ $errors->has('projeto_status_id') ? 'has-error' : '' }}">
        <label for="projeto_status_id" class="col-md-2 text-bold control-label">Status Projeto.: *</label>
        <div class="col-md-10">
            <select   class="form-control input-sm" id="projeto_status_id" name="projeto_status_id">
                <option value="" style="display: none;" {{ old('projeto_status_id', isset($projeto->projeto_status_id) ? $projeto->projeto_status_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione um Status</option>
                @foreach ($projetosStatus as $key => $statu)
                    <option value="{{ $key }}" {{ old('projeto_status_id', isset($projeto->projeto_status_id) ? $projeto->projeto_status_id : null) == $key ? 'selected' : '' }}>
                        {{ $statu }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('projeto_status_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @else
        <div class="form-group">
            <label for="projeto_status_id" class="col-md-2 control-label  text-bold">Status Projeto.: *</label>
            <div class="col-md-10">
                <input class="form-control input-sm" readonly name="projeto_status_id" type="hidden" id="projeto_status_id" value="{{ old('projeto_status_id', isset($projeto->projeto_status_id) ? $projeto->projeto_status_id : null) }}">
                <input class="form-control input-sm" readonly name="projeto_status_nome" type="text" id="projeto_status_nome" value="{{ old('projeto_status_nome', isset($projeto->projetoStatus->status_nome) ? $projeto->projetoStatus->status_nome : null) }}">
            </div>
        </div>
        @endrole


        @role('admin')
        <div class="form-group {{ $errors->has('users_id') ? 'has-error' : '' }}">
            <label for="users_id" class="col-md-2 text-bold control-label">Intergrador.: *</label>
            <div class="col-md-10">
                <select   class="form-control input-sm" id="users_id" name="users_id">
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
        @endrole

        <div class="form-group {{ $errors->has('consumo') ? 'has-error' : '' }}">
            <label for="consumo" class="col-md-2 control-label text-bold">Consumo R$.:</label>
            <div class="col-md-10">
                <select class="form-control input-sm" id="consumo" name="consumo">
                    <option value="" style="display: none;" {{ old('consumo', isset($projeto->consumo) ? $projeto->consumo : '') == '' ? 'selected' : '' }} disabled selected>Selecione um consumo</option>
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
            <label for="area_disponivel" class="col-md-2 control-label  text-bold">Área ( m²).:</label>
            <div class="col-md-10">
                <input class="form-control input-sm number" name="area_disponivel" type="text" id="area_disponivel" value="{{ old('area_disponivel', isset($projeto->area_disponivel) ? $projeto->area_disponivel : null) }}" placeholder="Enter area disponivel here...">
                {!! $errors->first('area_disponivel', '<p class="help-block">:message</p>') !!}
            </div>
        </div>



        <div class="form-group {{ $errors->has('data_prevista') ? 'has-error' : '' }}">
            <label for="data_prevista" class="col-md-2 control-label text-bold">Previsão Data.:</label>
            <div class="col-md-10">
                @role('admin')
                <input class="form-control input-sm date" name="data_prevista" type="text" id="data_prevista" value="{{ old('data_prevista', isset($projeto->data_prevista) ? $projeto->data_prevista : null) }}">
                @else
                    <input class="form-control input-sm" name="data_prevista" type="text" id="data_prevista" readonly value="{{ old('data_prevista', isset($projeto->data_prevista) ? $projeto->data_prevista : null) }}">
                    @endrole

            </div>
        </div>

        <div class="form-group {{ $errors->has('prioridade') ? 'has-error' : '' }}">
            <label for="prioridade" class="col-md-2 control-label text-bold">Prioridade.:</label>
            <div class="col-md-10">
                <select class="form-control input-sm" id="prioridade" name="prioridade">
                    <option value="" style="display: none;" {{ old('prioridade', isset($projeto->prioridade) ? $projeto->prioridade : '') == '' ? 'selected' : '' }} disabled selected>Selecione uma Prioridade</option>
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
            <label for="kw" class="col-md-2  text-bold control-label text-bold">Pot. do gerador (KWp).:</label>
            <div class="col-md-10">
                <input class="form-control input-sm kwp" name="kw" type="text" id="kw"  value="{{ old('kw', isset($projeto->kw) ? $projeto->kw : null) }}" placeholder="KW...">
                {!! $errors->first('kw', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('kwh') ? 'has-error' : '' }}">
            <label for="kwh" class="col-md-2  text-bold control-label text-bold">Cons. mensal em kWh.: *</label>
            <div class="col-md-10">
                <input class="form-control input-sm number" name="kwh" type="text" id="kwh"  value="{{ old('kwh', isset($projeto->kwh) ? $projeto->kwh : null) }}" placeholder="KWh...">
                {!! $errors->first('kwh', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('res_documentacao') ? 'has-error' : '' }}">
            <label for="res_documentacao" class="col-md-2 control-label text-bold">Res. Documentação.:</label>
            <div class="col-md-4">
                <input class="form-control input-sm" name="res_documentacao" type="text" id="res_documentacao"  value="{{ old('res_documentacao', isset($projeto->res_documentacao) ? $projeto->res_documentacao : null) }}" placeholder="">
                {!! $errors->first('valor_projeto', '<p class="help-block">:message</p>') !!}
            </div>
            <label for="res_acompanhamento" class="col-md-2 control-label text-bold">Res. Acompanhamento.:</label>
            <div class="col-md-4">
                <input class="form-control input-sm" name="res_acompanhamento" type="text" id="res_acompanhamento"  value="{{ old('res_acompanhamento', isset($projeto->res_acompanhamento) ? $projeto->res_acompanhamento : null) }}" placeholder="">
                {!! $errors->first('res_acompanhamento', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="col-lg-12">
            <h4 class="text-bold">Endereço</h4>
            <hr class="ruler-lg"/>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cep" class="col-md-4 control-label text-bold">Cep.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="cep" type="text" id="cep" value="{{ old('cep', isset($projeto->cep) ? $projeto->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
                        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="coordenadas" class="col-md-4 control-label text-bold">Coordenadas.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="coordenadas" type="text" id="coordenadas"  value="{{ old('coordenadas', isset($projeto->coordenadas) ? $projeto->coordenadas : null) }}" placeholder="">
                        {!! $errors->first('coordenadas', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end_intalacao" class="col-md-4 control-label text-bold">End. de Instalação.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="end_intalacao" type="text" id="end_intalacao" value="{{ old('end_intalacao', isset($projeto->end_intalacao) ? $projeto->end_intalacao : null) }}" maxlength="200" placeholder="Endereço">
                        {!! $errors->first('end_intalacao', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="bairro" class="col-sm-4 control-label text-bold">Bairro.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="bairro" type="text" id="bairro" value="{{ old('bairro', isset($projeto->bairro) ? $projeto->bairro : null) }}" maxlength="100" placeholder="Bairro">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }}">
                    <label for="numero" class="col-sm-4 control-label text-bold">Numero.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="numero" type="text" id="numero" value="{{ old('numero', isset($projeto->numero) ? $projeto->numero : null) }}" maxlength="10" placeholder="Enter numero here...">
                        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }}">
                    <label for="complemento" class="col-sm-4 control-label text-bold">Complemento.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="complemento" type="text" id="complemento" value="{{ old('complemento', isset($projeto->complemento) ? $projeto->complemento : null) }}" maxlength="200" placeholder="Enter complemento here...">
                        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="estado" class="col-sm-4 control-label text-bold">Estado.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="estado" type="text" id="estado" value="{{ old('estado', isset($projeto->estado) ? $projeto->estado : null) }}" maxlength="2" placeholder="Enter estado here...">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cidade" class="col-sm-4 control-label text-bold">Cidade.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="cidade" type="text" id="cidade" value="{{ old('cidade', isset($projeto->cidade) ? $projeto->cidade : null) }}" placeholder="Cidade">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <h4 class="text-bold">Cadastro de Contas de Energia</h4>
            <hr class="ruler-lg"/>
        </div>

        <div class="form-group {{ $errors->has('conta_contrato_anterior') ? 'has-error' : '' }}">
            <label for="conta_contrato_anterior" class="col-md-2  text-bold control-label text-bold">Conta Contrato Anterior.:</label>
            <div class="col-md-10">
                <input class="form-control input-sm contrato" name="conta_contrato_anterior" type="text" id="conta_contrato_anterior"  value="{{ old('kwh', isset($projeto->conta_contrato_anterior) ? $projeto->conta_contrato_anterior : null) }}" >
                {!! $errors->first('conta_contrato_anterior', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('conta_contrato_atual') ? 'has-error' : '' }}">
            <label for="conta_contrato_atual" class="col-md-2  text-bold control-label text-bold">Conta Contrato Atual.:</label>
            <div class="col-md-10">
                <input class="form-control input-sm contrato" name="conta_contrato_atual" type="text" id="conta_contrato_atual"  value="{{ old('kwh', isset($projeto->conta_contrato_atual) ? $projeto->conta_contrato_atual : null) }}" >
                {!! $errors->first('conta_contrato_atual', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="col-lg-12">
            <h4 class="text-bold">Contas Contrato</h4>
            <hr class="ruler-lg"/>
        </div>
        @if(isset($projeto))
            <div class="row">
                @foreach( $projeto->contratos as $contrato )
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                            <label for="num_contrato" class="col-sm-4 control-label text-bold">Conta Contrato.:</label>
                            <div class="col-md-3">
                                <input class="form-control input-sm" name="num_contrato[]" type="text" id="num_contrato" value="{{ old('contrato_celpe', isset($contrato) ? $contrato->num_contrato : null) }}"">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                            <label for="percentual" class="col-sm-4 control-label">Percentual.:</label>
                            <div class="col-md-3">
                                <input class="form-control input-sm" name="percentual[]" type="text" id="percentual" value="{{ old('percentual', isset($contrato) ? $contrato->percentual : null) }}" placeholder="%">
                            </div>
                            {{--<div class="input-group-btn">
                                <button class="btn btn-default" type="button">Excluir</button>
                            </div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{--<div class="form-group{{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                <label for="num_contrato" class="col-sm-4 control-label text-bold">Contrato Celpe.:</label>
                <div class="col-md-2">
                    <input class="form-control input-sm" name="num_contrato[]" type="number" id="num_contrato" value="{{ old('contrato_celpe', isset($contrato) ? $contrato->num_contrato : null) }}" placeholder="Contrato Celpe...">
                </div>
            </div>--}}

        @endif
        <div class="row after-add-more">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
                    <div class="col-md-2">
                        <div class="">
                            <label for="">
                                <button class="btn btn-success add-more btn-sm" type="button"><i class="glyphicon glyphicon-plus"></i> Adicionar conta contrato</button>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
            <label for="obs" class="col-md-2 control-label  text-bold">Obs.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projeto->obs) ? $projeto->obs : null) }}</textarea>
                {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

</div>

