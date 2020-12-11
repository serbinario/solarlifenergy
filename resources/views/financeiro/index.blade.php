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
                            <header>Lançamentos</header>
                            <div class="tools">
                                <div class="btn-group">

                                </div>
                            </div>
                        </div>

                        <div id="header-table">
                            <div class="btn-group lancamentos">
                                <header></header>
                                <div class="btn-lancamento">
                                    <button type="button" class="btn ink-reaction btn-floating-action btn-sm btn-info" data-toggle="dropdown"><i class="fa fa-plus"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a id="btn-despesa" href="#">Despesa</a></li>
                                        <li><a id="btn-receita" href="#">Receita</a></li>
                                        <li><a id="btn-teste" href="#">Teste</a></li>
                                    </ul>
                                </div>
                            </div><!--end .btn-group -->
                            <div id="data-table">
                                <span>Data</span>
                            </div>
                            <div id="data-dtable">
                                <span>Data</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="financeiro" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Descrição</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Vencimento</th>
                                                    <th>Pagamento</th>
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

    @include('financeiro.modalReceita')
    @include('financeiro.modalDespesa')
    @include('financeiro.modalTeste')

@endsection

@section('javascript')
    <script src="{{ asset('/js/financeiro/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/financeiro/receita.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop