<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion2">
            <div class="card panel expanded">
                <div class="card-head card-head-xs" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-3">
                    <header class="text-bold">Detalhamento do Projeto</header>
                    <div class="col-6 total_equipamentos">
                    </div>
                </div>
                <div id="accordion2-3" class="collapse in">
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
                                        <select class="form-control input-sm" id="prioridade" name="prioridade">
                                            <option value="" style="display: none;" {{ old('prioridade', isset($projetov2->prioridade) ? $projetov2->prioridade : '') == '' ? 'selected' : '' }} disabled selected>Selecione uma Prioridade</option>
                                            @foreach ([
                                                'Alta' => 'Alta',
                                                'Media' => 'Media',
                                                'Baixa' => 'Baixa'] as $key => $text)
                                                <option value="{{ $key }}" {{ old('prioridade', isset($projetov2->prioridade) ? $projetov2->prioridade : null) == $key ? 'selected' : '' }}>
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
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-2">
                    <header class="text-bold">Endereço de Instalação</header>
                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="accordion2-2" class="collapse">
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
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-4">
                    <header class="text-bold">Cadastro de contas energia</header>
                </div>
                <div id="accordion2-4" class="collapse">
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('conta_contrato_anterior') ? 'has-error' : '' }}">
                            <label for="conta_contrato_anterior" class="col-md-2  text-bold control-label text-bold">Conta Contrato Anterior.:</label>
                            <div class="col-md-10">
                                <input class="form-control input-sm contrato" name="conta_contrato_anterior" type="text" id="conta_contrato_anterior"  value="{{ old('kwh', isset($projetov2->conta_contrato_anterior) ? $projetov2->conta_contrato_anterior : null) }}" >
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('conta_contrato_atual') ? 'has-error' : '' }}">
                            <label for="conta_contrato_atual" class="col-md-2  text-bold control-label text-bold">Conta Contrato Atual.:</label>
                            <div class="col-md-10">
                                <input class="form-control input-sm contrato" name="conta_contrato_atual" type="text" id="conta_contrato_atual"  value="{{ old('kwh', isset($projetov2->conta_contrato_atual) ? $projetov2->conta_contrato_atual : null) }}" >
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <h4 class="text-bold">Contas Contrato</h4>
                            <hr class="ruler-lg"/>
                        </div>
                        @if(isset($projetov2))
                                @foreach( $projetov2->contratos as $contrato )
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="num_contacontrato" class="col-sm-6 control-label text-bold">Conta Contrato.:</label>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label for="parecer_relacionamento">
                                                            <input class="form-control input-sm" name="num_contacontrato[]" type="text" id="num_contacontrato" value="{{ old('num_contacontrato', isset($contrato) ? $contrato->num_contacontrato : null) }}"">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="percentual" class="col-sm-6 control-label text-bold">Percentual.:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm" name="percentual[]" type="text" id="percentual" value="{{ old('percentual', isset($contrato) ? $contrato->percentual : null) }}" placeholder="%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger remove btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i> Remover</button>
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
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-5">
                    <header class="text-bold">Documentos</header>
                </div>
                <div id="accordion2-5" class="collapse">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf_cnh_rg" class="col-sm-8 control-label text-bold">CPF/RG.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="cpf_cnh_rg">
                                                <input id="cpf_cnh_rg" class="" name="cpf_cnh_rg" type="checkbox" value="1" {{ old('cpf_cnh_rg', isset($projetov2->ProjetosDocumento->cpf_cnh_rg) ? $projetov2->ProjetosDocumento->cpf_cnh_rg : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="cpf_cnh_rg_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                                    <div class="col-md-9">
                                        <input class="form-control input-sm" name="cpf_cnh_rg_image" type="file" id="cpf_cnh_rg_image" value="{{ old('cpf_cnh_rg_image', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_image) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_image : "") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->cpf_cnh_rg_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="conprovante_residencia" class="col-sm-8 control-label text-bold">Comprovante Residência.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="conprovante_residencia">
                                                <input id="conprovante_residencia" class="" name="conprovante_residencia" type="checkbox" value="1" {{ old('conprovante_residencia', isset($projetov2->ProjetosDocumento->conprovante_residencia) ? $projetov2->ProjetosDocumento->conprovante_residencia : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="conprovante_residencia_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                                    <div class="col-md-9">
                                        <input class="form-control input-sm" name="conprovante_residencia_image" type="file" id="conprovante_residencia_image" value="{{ old('conprovante_residencia_image', isset($projetov2->ProjetosDocumento->conprovante_residencia_image) ? $projetov2->ProjetosDocumento->conprovante_residencia_image : "") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @if($projetov2->ProjetosDocumento->conprovante_residencia_image)
                                        <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->conprovante_residencia_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf_cnh_rg_conjugue" class="col-sm-8 control-label text-bold">CPF/CNH/RG Conjugue.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="cpf_cnh_rg_conjugue">
                                                <input id="cpf_cnh_rg_conjugue" class="" name="cpf_cnh_rg_conjugue" type="checkbox" value="1" {{ old('cpf_cnh_rg_conjugue', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="cpf_cnh_rg_conjugue_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                                    <div class="col-md-9">
                                        <input class="form-control input-sm" name="cpf_cnh_rg_conjugue_image" type="file" id="cpf_cnh_rg_conjugue_image" value="{{ old('cpf_cnh_rg_conjugue_image', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image : "") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @if($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image)
                                    @endif
                                    <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="certidao_casamento" class="col-sm-8 control-label text-bold">Certidão de Casamento.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="certidao_casamento">
                                                <input id="certidao_casamento" class="" name="certidao_casamento" type="checkbox" value="1" {{ old('certidao_casamento', isset($projetov2->ProjetosDocumento->certidao_casamento) ? $projetov2->ProjetosDocumento->certidao_casamento : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="certidao_casamento_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                                    <div class="col-md-9">
                                        <input class="form-control input-sm" name="certidao_casamento_image" type="file" id="certidao_casamento_image" value="{{ old('certidao_casamento_image', isset($projetov2->ProjetosDocumento->certidao_casamento_image) ? $projetov2->ProjetosDocumento->certidao_casamento_image : "") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @if($projetov2->ProjetosDocumento->certidao_casamento_image)
                                        <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->certidao_casamento_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="certidao_casamento" class="col-sm-8 control-label text-bold">Ficha de Elaboração Assinada?.:</label>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-styled">
                                            <label for="ficha_elaboracao_projeto">
                                                <input id="ficha_elaboracao_projeto" class="" name="ficha_elaboracao_projeto" type="checkbox" value="1" {{ old('ficha_elaboracao_projeto', isset($projetov2->ProjetosDocumento->ficha_elaboracao_projeto) ? $projetov2->ProjetosDocumento->ficha_elaboracao_projeto : null) == '1' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="ficha_elaboracao_projeto_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                                    <div class="col-md-9">
                                        <input class="form-control input-sm" name="ficha_elaboracao_projeto_image" type="file" id="ficha_elaboracao_projeto_image" value="{{ old('ficha_elaboracao_projeto_image', isset($projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image) ? $projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image : "") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @if($projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image)
                                        <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

                                    @endif

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div><!--end .panel -->

        </div><!--end .panel-group -->
    </div><!--end .Acordion -->
</div>

<div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Obs.:</label>
    <div class="col-md-11">
        <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projetov2->obs) ? $projetov2->obs : null) }}</textarea>
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    </div>
</div>
