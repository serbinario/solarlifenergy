<!--Accordion -->
<div class="col-md-12">
    <div class="panel-group" id="accordion">
        <div class="card panel">
            <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                <header>Filtro</header>
                <div class="tools">
                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div id="accordion7-1" class="collapse">
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
                            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
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
                                <label for="data_ini" class="col-sm-4 control-label">Data Ini.:</label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm date" name="data_ini" type="text" id="data_ini" value="{{ old('data_ini',  null) }}" placeholder="Início">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="data_fim" class="col-sm-4 control-label">Data Fim.:</label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm date" name="data_fim" type="text" id="data_fim" value="{{ old('data_fim',  null) }}" placeholder="Fim">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Filtrar data por:</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="filtro_por" checked value="created_at"><span>Cadastro</span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="filtro_por" value="updated_at"><span>Atualização</span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="filtro_por" value="data_validade"><span>Validade</span>
                                    </label>
                                </div><!--end .col -->
                            </div><!--end .form-group -->
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="is_propostas" class="col-md-4 control-label">Prioridade</label>
                            <div class="col-md-8">
                                <select id="prioridade_id" name="prioridade_id" class="form-control input-sm">
                                    <option value="">Todos</option>
                                    <option value="1">Baixa</option>
                                    <option value="2">Média</option>
                                    <option value="3">Alta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="projetos" class="col-md-4 control-label">Projetos</label>
                            <div class="col-md-8">
                                <select id="projetos" name="projetos" class="form-control input-sm">
                                    <option value="">Todos</option>
                                    <option value="1">Sem Projetos</option>
                                    <option value="2">Projeto Gerados</option>
                                </select>
                            </div>
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