<!--Accordion -->
<div class="col-md-12">
    <div class="panel-group" id="accordion8">
        <div class="card panel">
            <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion8" data-target="#accordion8-1">
                <header>Filtro</header>
                <div class="tools">
                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div id="accordion8-1" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Cliente:</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" name="nome" type="text" id="nome" maxlength="20" placeholder="Nome">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="franquia_id" class="col-md-2 control-label">Franquia.: *</label>
                                <div class="col-md-10">
                                    <select class="form-control input-sm" id="franquia_id" name="franquia_id">
                                        <option value="" selected>Todas</option>
                                        @foreach ($franquias as $key => $franquia)
                                            <option value="{{ $key }}" {{ old('franquia_id', isset($user->franquia->id) ? $user->franquia->id : null) == $key ? 'selected' : '' }}>
                                                {{ $franquia }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('franquia_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="integrador" class="col-sm-4 control-label">Intergrador:</label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" name="integrador" type="text" id="integrador"  placeholder="Integrador">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="prioridade" class="col-md-4 control-label">Prioridade</label>
                                <div class="col-md-8">
                                    <select id="prioridade" name="prioridade" class="form-control input-sm">
                                        <option value="">Todos</option>
                                        <option value="1">Alta</option>
                                        <option value="2">Média</option>
                                        <option value="3">Baixa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="projeto_status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-8">
                                    <select id="projeto_status" name="projeto_status" class="form-control input-sm">
                                        <option value="">Todos</option>
                                        <option value="1">Análise Preliminar</option>
                                        <option value="2">Elaboração Projeto</option>
                                        <option value="3">Proj. em Análise / fianlisado para Obras</option>
                                        <option value="4">Obras em Execursão</option>
                                        <option value="5">Obras em Fase Final</option>
                                        <option value="6">Obras Finalisadas</option>
                                        <option value="7">Obras Paradas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="estado" class="col-md-4 control-label">Estado</label>
                                <div class="col-md-8">
                                    <select id="estado" name="status" class="form-control input-sm">
                                        <option value="">Todos</option>
                                        <option value="Alta">PE</option>
                                        <option value="Alta">PB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="cidade" class="col-md-4 control-label">Cidade</label>
                                <div class="col-md-8">
                                    <select id="cidade" name="status" class="form-control input-sm">
                                        <option value="">Todos</option>
                                        <option value="Alta">Recife</option>
                                        <option value="Média">Cabo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="data_ini" class="col-sm-5 control-label">Data Ini.:</label>
                                <div class="col-md-7">
                                    <input class="form-control input-sm date" name="data_ini" type="text" id="data_ini" value="{{ old('data_ini',  null) }}" placeholder="Início">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="data_fim" class="col-sm-5 control-label">Data Fim.:</label>
                                <div class="col-md-7">
                                    <input class="form-control input-sm date" name="data_fim" type="text" id="data_fim" value="{{ old('data_fim',  null) }}" placeholder="Fim">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">

                                <label for="cidade" class="col-md-2 control-label">Data</label>
                                <div class="col-md-6">
                                    <select id="filtro_por" name="filtro_por" class="form-control input-sm">
                                        <option value="">Todos</option>
                                        <option value="created_at">Cadastro</option>
                                        <option value="updated_at">Atualização</option>
                                        <option value="data_pagamento_projeto">Pagamento(Cliente/Banco)</option>
                                    </select>
                                </div>
                            </div><!--end .form-group -->
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <a href="#" type="button" id="localizar" class="btn btn-sm btn-flat btn-primary ink-reaction">Localizar</a>
                                    <input class="btn btn-sm btn-primary"  id="limpar" type="button" value="Limpar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end .panel -->
    </div><!--end .panel-group -->
</div>