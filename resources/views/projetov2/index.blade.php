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
                                    <a href="{{ route('projetov2.projetov2.create') }}" class="btn btn-primary" title="Novo Fornecedor">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="projetov2" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Rasão Social</th>
                                                    <th>Cod. Proposta</th>
                                                    <th>Valor</th>
                                                    <th>Kwp</th>
                                                    <th>Data Financi.</th>
                                                    <th>Previsão Parcela</th>
                                                    <th>Previsão Obra</th>
                                                    <th>Data Conexao</th>
                                                    <th>Prioridade</th>
                                                    <th>Integrador</th>
                                                    <th>Franquia</th>
                                                    <th>Situação</th>
                                                    <th>Acao</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!--end .table-responsive -->
                                </div>
                            </div><!--end .col -->
                        </div><!--end .row -->
                        <!-- END DATATABLE 1 -->

                        <!--Accordion -->
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion">
                                <div class="card panel">
                                    <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                                        <header>Relatórios</header>
                                        <div class="tools">
                                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div id="accordion7-1" class="collapse">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="status" class="col-md-2 control-label">Status:</label>
                                                        <div class="col-md-8">
                                                            <select id="status" name="status" class="form-control input-sm" multiple="multiple">
                                                                <option value="1">Prospecção e Elaboração de Projetos</option>
                                                                <option value="2">Proj. em Análise</option>
                                                                <option value="3">Proj. em Análise - Finalizando p/ Inínicio de Obras</option>
                                                                <option value="4">Obras em Execusão </option>
                                                                <option value="5">Obras em Fase Final</option>
                                                                <option value="6">Obras Finalizadas </option>
                                                                <option value="7">Obras Paradas</option>
                                                            </select>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="prioridade" class="col-md-4 control-label">Ordenar Por</label>
                                                        <div class="col-md-8">
                                                            <select id="prioridade" name="prioridade" class="form-control input-sm">
                                                                <option value="clientes.nome">Nome</option>
                                                                <option value="pre_propostas.data_financiamento_bancario">Data Assinatura</option>
                                                                <option value="pre_propostas.data_prevista_parcela">Data Parcela</option>
                                                                <option value="users.name">Intergrador</option>
                                                                <option value="banco_financiadora.nome">Banco</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="col-md-8">
                                                            <input class="btn btn-sm btn-primary" onclick="report()" id="gerar_relatorio" type="button" value="Gerar Relatório">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end .panel -->
                            </div><!--end .panel-group -->

                    </div><!--end .card -->
                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/projetov2/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop