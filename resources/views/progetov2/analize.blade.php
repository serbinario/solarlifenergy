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
                                    <label for="codigo" class="col-sm-6 control-label text-bold">Potência Gerador</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm" name="codigo" type="text" id="codigo" readonly value="{{ old('minima_area', isset($progetov2->PreProposta->potencia_instalada) ? $progetov2->PreProposta->potencia_instalada : null) }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="minima_area" class="col-sm-4 control-label text-bold">Área.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="minima_area" type="text" id="minima_area" readonly value="{{ old('minima_area', isset($progetov2->PreProposta->minima_area) ? $progetov2->PreProposta->minima_area : null) }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="monthly_usage" class="col-sm-7 control-label text-bold">Cons. mensal kWh.:</label>
                                    <div class="col-md-5">
                                        <input class="form-control input-sm" name="monthly_usage" type="text" id="monthly_usage" readonly value="{{ old('monthly_usage', isset($progetov2->PreProposta->monthly_usage) ? $progetov2->PreProposta->monthly_usage : null) }}" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="minima_area" class="col-sm-4 control-label text-bold">Res. Documentação.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="res_documentacao" type="text" id="res_documentacao"  value="{{ old('res_documentacao', isset($projeto->res_documentacao) ? $projeto->res_documentacao : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="monthly_usage" class="col-sm-4 control-label text-bold">Res. Acompanhamento.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="res_acompanhamento" type="text" id="res_acompanhamento"  value="{{ old('res_acompanhamento', isset($projeto->res_acompanhamento) ? $projeto->res_acompanhamento : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="minima_area" class="col-sm-4 control-label text-bold">Data Prevista.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm" name="res_documentacao" type="text" id="res_documentacao"  value="{{ old('res_documentacao', isset($projeto->res_documentacao) ? $projeto->res_documentacao : null) }}" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="monthly_usage" class="col-sm-4 control-label text-bold">Prioridade.:</label>
                                    <div class="col-md-8">
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
                                    </div>
                                </div>
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

                    </div>
                </div>
            </div><!--end .panel -->
        </div><!--end .panel-group -->
    </div><!--end .Acordion -->
</div>

<div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-1 control-label  text-bold">Obs.:</label>
    <div class="col-md-11">
        <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projeto->obs) ? $projeto->obs : null) }}</textarea>
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    </div>
</div>
