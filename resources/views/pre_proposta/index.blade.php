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
                            <header>Lista de Propostas</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('pre_proposta.pre_proposta.create') }}" class="btn btn-primary" title="Novo Fornecedor">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @include('pre_proposta.filtro')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="preProposta" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Id</th>
                                                    <th>Proposta N</th>
                                                    <th>Cliente</th>
                                                    <th>Valor Proposta</th>
                                                    <th>KWp</th>
                                                    <th>Data Validade</th>
                                                    <th>Integrador</th>
                                                    <th>Franquia</th>
                                                    <th>Data Cadastro</th>
                                                    <th>Data Alteração</th>
                                                    <th>Prioridade</th>
                                                    <th>Alerta</th>
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
                                <a href="{{ route('pre_proposta.pre_proposta.create') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Nova Proposta</a>
                            </div>
                        </div>

                        @include('pre_proposta.relatorio')
                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

    @include('pre_proposta.modalPropostas')

@endsection

@section('javascript')
    <script src="{{ asset('/js/pre_proposta/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop