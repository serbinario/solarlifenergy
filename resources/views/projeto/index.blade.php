@extends('layouts.menu')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif


    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Lista de Projetos</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('projeto.projeto.create') }}" class="btn btn-primary" title="Novo Fornecedor">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

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
                                                    <div class="form-group">
                                                        <label for="cod_projeto" class="col-sm-4 control-label">Cod. Projeto:</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control input-sm" name="cod_projeto" type="text" id="cod_projeto"  placeholder="">
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
                                                                <option value="Alta">Alta</option>
                                                                <option value="Média">Média</option>
                                                                <option value="Baixa">Baixa</option>
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
                                                                <option value="1">Prospeccção e Elaboração de Projetos</option>
                                                                <option value="2">Proj. em Análise</option>
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
                                                        </div><!--end .col -->
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

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="projeto" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Id</th>
                                                    <th>Cliente</th>
                                                    <th>Cod. Projeto</th>
                                                    <th>Integrador</th>
                                                    <th>Data Cadastro</th>
                                                    <th>Data Atualização</th>
                                                    <th>KWP</th>
                                                    <th>Prioridade</th>
                                                    <th>Acao</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!--end .table-responsive -->
                                </div>
                            </div><!--end .col -->
                        </div><!--end .row -->
                        <!-- END DATATABLE 1 -->




                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a href="{{ route('projeto.projeto.create') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Novo Projeto</a>
                            </div>
                        </div>
                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/projeto/index.js')}}" type="text/javascript"></script>

@stop