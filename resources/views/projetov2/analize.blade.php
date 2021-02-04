<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion2">
            <div class="card panel">
                <div class="card-head card-head-xs" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_1">
                    <header class="text-bold">Detalhamento do Projeto</header>
                    <div class="col-6 total_equipamentos">
                    </div>
                </div>
                <div id="tab_1" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="codigo" class="col-sm-8 control-label text-bold">Pot. gerador (KWp)</label>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" name="codigo" type="text" id="codigo" readonly value="{{ old('minima_area', isset($projetov2->PreProposta->potencia_instalada) ? $projetov2->PreProposta->potencia_instalada : null) }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="qtd_paineis" class="col-sm-8 control-label text-bold">Qtd. Modulos</label>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" readonly value="{{ old('qtd_paineis', isset($projetov2->PreProposta->qtd_paineis) ? $projetov2->PreProposta->qtd_paineis : null) }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="minima_area" class="col-sm-8 control-label text-bold">Área.:</label>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" name="minima_area" type="text" id="minima_area" readonly value="{{ old('minima_area', isset($projetov2->PreProposta->minima_area) ? $projetov2->PreProposta->minima_area : null) }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="monthly_usage" class="col-sm-8 control-label text-bold">Cons. mensal kWh.:</label>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" name="monthly_usage" type="text" id="monthly_usage" readonly value="{{ old('monthly_usage', isset($projetov2->PreProposta->monthly_usage) ? $projetov2->PreProposta->monthly_usage : null) }}" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="res_documentacao" class="col-sm-4 control-label text-bold">Res. Documentação.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="res_documentacao" type="text" id="res_documentacao"  value="{{ old('res_documentacao', isset($projetov2->res_documentacao) ? $projetov2->res_documentacao : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="res_acompanhamento" class="col-sm-4 control-label text-bold">Res. Acompanhamento.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="res_acompanhamento" type="text" id="res_acompanhamento"  value="{{ old('res_acompanhamento', isset($projetov2->res_acompanhamento) ? $projetov2->res_acompanhamento : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="data_prevista" class="col-sm-4 control-label text-bold">Data Prevista.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm date" name="data_prevista" type="text" id="data_prevista"  value="{{ old('data_prevista', isset($projetov2->data_prevista) ? $projetov2->data_prevista : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="monthly_usage" class="col-sm-4 control-label text-bold">Prioridade.:</label>
                                    <div class="col-md-8">
                                        <select class="form-control input-sm" id="projeto_prioridade_id" name="projeto_prioridade_id">
                                            <option value="" style="display: none;" {{ old('projeto_prioridade_id', isset($projetov2->projeto_prioridade_id) ? $projetov2->projeto_prioridade_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione uma Prioridade</option>
                                            @foreach ([
                                                '1' => 'Alta',
                                                '2' => 'Media',
                                                '3' => 'Baixa',
                                                '4' => 'Altíssima',
                                                ] as $key => $text)
                                                <option value="{{ $key }}" {{ old('projeto_prioridade_id', isset($projetov2->projeto_prioridade_id) ? $projetov2->projeto_prioridade_id : null) == $key ? 'selected' : '' }}>
                                                    {{ $text }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="projeto_status_id" class="col-md-2 text-bold control-label">Status Projeto.: *</label>
                            <div class="col-md-10">
                                <select   class="form-control input-sm" id="projeto_status_id" name="projeto_status_id">
                                    <option value="" style="display: none;" {{ old('projeto_status_id', isset($projetov2->projeto_status_id) ? $projetov2->projeto_status_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione um Status</option>
                                    @foreach ($projetosStatus as $key => $statu)
                                        <option value="{{ $key }}" {{ old('projeto_status_id', isset($projetov2->projeto_status_id) ? $projetov2->projeto_status_id : null) == $key ? 'selected' : '' }}>
                                            {{ $statu }}
                                        </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('projeto_status_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>


                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_2">
                    <header class="text-bold">Endereço de Instalação</header>
                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="tab_2" class="collapse">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cep" class="col-md-4 control-label text-bold">Cep.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="cep" type="text" id="cep" value="{{ old('cep', isset($projetov2->Endereco->cep) ? $projetov2->Endereco->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
                                        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="coordenadas" class="col-md-4 control-label text-bold">Coordenadas.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="coordenadas" type="text" id="coordenadas"  value="{{ old('coordenadas', isset($projetov2->Endereco->coordenadas) ? $projetov2->Endereco->coordenadas : null) }}" placeholder="">
                                        {!! $errors->first('coordenadas', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="logradouro" class="col-md-4 control-label text-bold">End. de Instalação.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="logradouro" type="text" id="logradouro" value="{{ old('logradouro', isset($projetov2->Endereco->logradouro) ? $projetov2->Endereco->logradouro : null) }}" maxlength="200" placeholder="Endereço">
                                        {!! $errors->first('end_intalacao', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="bairro" class="col-sm-4 control-label text-bold">Bairro.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="bairro" type="text" id="bairro" value="{{ old('bairro', isset($projetov2->Endereco->bairro) ? $projetov2->Endereco->bairro : null) }}" maxlength="100" placeholder="Bairro">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }}">
                                    <label for="numero" class="col-sm-4 control-label text-bold">Numero.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="numero" type="text" id="numero" value="{{ old('numero', isset($projetov2->Endereco->numero) ? $projetov2->Endereco->numero : null) }}" maxlength="10" placeholder="Enter numero here...">
                                        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }}">
                                    <label for="complemento" class="col-sm-4 control-label text-bold">Complemento.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="complemento" type="text" id="complemento" value="{{ old('complemento', isset($projetov2->Endereco->complemento) ? $projetov2->Endereco->complemento : null) }}" maxlength="200" placeholder="Enter complemento here...">
                                        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="uf" class="col-sm-4 control-label text-bold">Estado.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="uf" type="text" id="estado" value="{{ old('uf', isset($projetov2->Endereco->uf) ? $projetov2->Endereco->uf : null) }}" maxlength="2" placeholder="Enter estado here...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cidade" class="col-sm-4 control-label text-bold">Cidade.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="cidade" type="text" id="cidade" value="{{ old('cidade', isset($projetov2->Endereco->cidade) ? $projetov2->Endereco->cidade : null) }}" placeholder="Cidade">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_3">
                    <header class="text-bold">Cadastro de Contas Energia</header>
                </div>
                <div id="tab_3" class="collapse">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('titularidade_projeto') ? 'has-error' : '' }}">
                                    <label for="titularidade_projeto" class="col-md-4  text-bold control-label text-bold">Titularidade Projeto.:</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm" name="titularidade_projeto" type="text" id="titularidade_projeto"  value="{{ old('titularidade_projeto', isset($projetov2->titularidade_projeto) ? $projetov2->titularidade_projeto : null) }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('titularidade_projeto_cpf') ? 'has-error' : '' }}">
                                    <label for="titularidade_projeto_cpf" class="col-md-4  text-bold control-label text-bold">CPF/CNPJ.:</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm" name="titularidade_projeto_cpf" type="text" id="titularidade_projeto_cpf"  value="{{ old('titularidade_projeto_cpf', isset($projetov2->titularidade_projeto_cpf) ? $projetov2->titularidade_projeto_cpf : null) }}" >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('conta_contrato_atual') ? 'has-error' : '' }}">
                                    <label for="conta_contrato_atual" class="col-md-4  text-bold control-label text-bold">Conta Geradora.:</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm contrato" name="conta_contrato_atual" type="text" id="conta_contrato_atual"  value="{{ old('kwh', isset($projetov2->conta_contrato_atual) ? $projetov2->conta_contrato_atual : null) }}" >
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <h4 class="text-bold">Contas Contrato</h4>
                            <hr class="ruler-lg"/>
                        </div>
                        @if(isset($projetov2))
                                @foreach( $projetov2->contratos as $contrato )
                                    <div class="row copy" id="{{ $contrato->num_contacontrato }}">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="num_contacontrato" class="col-sm-6 control-label text-bold">C/Contrato.:</label>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label for="parecer_relacionamento">
                                                            <input class="form-control input-sm" name="num_contacontrato[]" type="text" id="num_contacontrato[]" value="{{ old('num_contacontrato', isset($contrato) ? $contrato->num_contacontrato : null) }}"">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="checkbox checkbox-styled">
                                                        <label>
                                                            <input id="contrato_titularidade[]" class="" name="contrato_titularidade[]" type="checkbox" value="1" {{ old('cpf_cnh_rg', isset($contrato->contrato_titularidade) ? $contrato->contrato_titularidade : null) == '1' ? 'checked' : '' }}>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="percentual" class="col-sm-6 control-label text-bold">Percentual.:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm" name="percentual[]" type="text" id="percentual[]" value="{{ old('percentual', isset($contrato) ? $contrato->percentual : null) }}" placeholder="%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="image" class="col-sm-3 control-label text-bold"><a target="_blank" href="{{ url("/storage/{$contrato->image}") }}" >Link Arquivo</a></label>
                                                <div class="col-md-9">
                                                    <input readonly class="form-control input-sm" name="image[]" type="text" id="image[]" value="{{ old('image', isset($contrato) ? $contrato->image : null) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <button  class="btn btn-danger remove btn-sm"  type="button" onclick="removeContaContrato('{{$contrato->id}}');"><i class="glyphicon glyphicon-remove"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
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
                                                <button class="btn btn-primary add-more btn-sm" type="button"><i class="glyphicon glyphicon-plus"></i> Adicionar conta contrato</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_4">
                    <header class="text-bold">Documentos</header>
                </div>
                <div id="tab_4" class="collapse">
                    <div class="card-body">
                        @include('projetov2.analizeDocumentos')

                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_5">
                    <header class="text-bold">Documentos Diversos</header>
                </div>
                <div id="tab_5" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($projetov2->imagens as $key => $image)
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="descricao" class="col-sm-4 control-label text-bold">Descrição.:</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-sm" name="descricao[]" type="text" id="descricao[]"  value="{{ old('data_prevista', isset($image->descricao) ? $image->descricao : null) }}" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="descricao_image" class="col-sm-3 control-label text-bold"><a target="_blank" href="{{ url("/storage/{$image->descricao_image}") }}" >Link Arquivo</a></label>
                                        <div class="col-md-9">
                                            <input readonly class="form-control input-sm" name="descricao_image[]" type="text" id="descricao_image[]" value="{{ old('image', isset($image) ? $image->descricao_image : null) }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row after-add-more-documento">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <div class="">
                                            <label for="">
                                                <button class="btn btn-primary add-more-documento btn-sm" type="button"><i class="glyphicon glyphicon-plus"></i> Documento</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end .panel -->
            @role('super-admin')
            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#tab_6">
                    <header class="text-bold">Liberação de Participação</header>
                </div>
                <div id="tab_6" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="monthly_usage" class="col-sm-4 text-bold control-label">Data referência.:</label>
                                <div class="col-md-6">
                                        <label class="radio-inline radio-styled radio-primary tipo_fisica">
                                            <input id="10" class="10" name="data_prevista" type="radio" value="10" {{ old('tipo', isset($projetov2->participacao->data_prevista) ? $projetov2->participacao->data_prevista : null) == '10' ? 'checked' : '' }}>
                                            10
                                        </label>
                                        <label class="radio-inline radio-styled radio-success tipo_juridico">
                                            <input id="20" class="20" name="data_prevista" type="radio" value="20"  {{ old('tipo', isset($projetov2->participacao->data_prevista) ? $projetov2->participacao->data_prevista : null) == '20' ? 'checked' : '' }}>
                                            20
                                        </label>
                                        <label class="radio-inline radio-styled radio-success tipo_juridico">
                                            <input id="30" class="30" name="data_prevista" type="radio" value="30"  {{ old('tipo', isset($projetov2->participacao->data_prevista) ? $projetov2->participacao->data_prevista : null) == '30' ? 'checked' : '' }}>
                                            30
                                        </label>
                                </div>
                            </div>

                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="pago" class="col-sm-8 control-label text-bold">Pago?.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="pago">
                                                <input id="pago" class="" name="pago" type="checkbox" value="1" {{ old('pago', isset($projetov2->participacao->pago) ? $projetov2->participacao->pago : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('titularidade_projeto_cpf') ? 'has-error' : '' }}">
                                        <label for="titularidade_projeto" class="col-md-4 left text-bold control-label text-bold">Data Paga.:</label>
                                        <div class="col-md-6">
                                            <input class="form-control input-sm date" name="data_pagamento" type="text"  value="{{ old('data_pagamento', isset($projetov2->participacao->data_pagamento) ? $projetov2->participacao->data_pagamento : null) }}" >
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group {{ $errors->has('data_pagamento_projeto') ? 'has-error' : '' }}">
                                <label for="data_pagamento_projeto" class="col-md-3 text-bold control-label">Data Liberação Cliente/Banco.:</label>
                                <div class="col-md-3">
                                    <input class="form-control input-sm date" name="data_pagamento_projeto" type="text"  value="{{ old('data_pagamento_projeto', isset($projetov2->data_pagamento_projeto) ? $projetov2->data_pagamento_projeto : null) }}" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
                                <label for="participacao_obs" class="col-md-1 control-label  text-bold">Obs.:</label>
                                <div class="col-md-11">
                                    <textarea class="form-control input-sm" name="participacao_obs" cols="20" rows="10" id="participacao_obs" placeholder="">{{ old('obs', isset($projetov2->participacao->obs) ? $projetov2->participacao->obs : null) }}</textarea>
                                    {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end .panel -->
            @endrole

        </div><!--end .panel-group -->
    </div><!--end .Acordion -->
</div>

<div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Pendências?.:</label>

    <div class="checkbox checkbox-styled">
        <div class="col-md-4">
            <label for="pendencia">
                <input id="pendencia" class="" name="pendencia" type="checkbox" value="1" {{ old('cpf_cnh_rg', isset($projetov2->pendencia) ? $projetov2->pendencia : null) == '1' ? 'checked' : '' }}>
            </label>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Obs.:</label>
    <div class="col-md-11">
        <textarea class="form-control input-sm" name="obs" cols="10" rows="5" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projetov2->obs) ? $projetov2->obs : null) }}</textarea>
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pendencia_juridica') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Jurídico?.:</label>

    <div class="checkbox checkbox-styled">
        <div class="col-md-4">
            <label for="pendencia_juridica">
                <input id="pendencia_juridica" class="" name="pendencia_juridica" type="checkbox" value="1" {{ old('pendencia_juridica', isset($projetov2->pendencia_juridica) ? $projetov2->pendencia_juridica : null) == '1' ? 'checked' : '' }}>
            </label>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('obs_juridica') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Obs.:</label>
    <div class="col-md-11">
        <textarea class="form-control input-sm" name="obs_juridica" cols="10" rows="5" id="obs_juridica" placeholder="Enter obs here...">{{ old('obs_juridica', isset($projetov2->obs_juridica) ? $projetov2->obs_juridica : null) }}</textarea>
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    </div>
</div>
