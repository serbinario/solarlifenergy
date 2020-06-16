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
                            <header>Lista de Contratos</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('contrato.contrato.create') }}" class="btn btn-primary" title="Novo Contrato">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @include('contrato.filtro')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="contrato" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Cliente</th>
                                                    <th>CPF/CNPJ</th>
                                                    <th>Valor Proposta</th>
                                                    <th>KWp</th>
                                                    <th>Ano</th>
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
                            </div>
                        </div>
                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->
    @include ('contrato.modalContrato')

@endsection

@section('javascript')
    <script src="{{ asset('/js/contrato/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop