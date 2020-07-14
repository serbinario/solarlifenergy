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
                            <header>Lista de Projetos Arquivados</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('projetov2.projetov2.create') }}" class="btn btn-primary" title="Novo Fornecedor">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @include('projetov2.filtro')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="projetov2" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Id</th>
                                                    <th>Razão Social</th>
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
                                                    <th>Atualizado</th>
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

                    </div><!--end .card -->
                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/projetov2/arquivados/index.js')}}" type="text/javascript"></script>

@stop