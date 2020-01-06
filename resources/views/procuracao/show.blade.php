@extends('layouts.app')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_procuracao_form" name="edit_procuracao_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('procuracao.procuracao.index') }}" class="btn btn-primary" title="Show All Procuracao">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Cliente</dt>
            <dd>{{ isset($procuracao->cliente->nome) ? $procuracao->cliente->nome : '' }}</dd>
            <dt>Franquia</dt>
            <dd>{{ isset($procuracao->franquium->id) ? $procuracao->franquium->id : '' }}</dd>
            <dt>Data Validade</dt>
            <dd>{{ $procuracao->data_validade }}</dd>
            <dt>Outorgante</dt>
            <dd>{{ $procuracao->outorgante }}</dd>
            <dt>Rg</dt>
            <dd>{{ $procuracao->rg }}</dd>
            <dt>Orgao Expeditor</dt>
            <dd>{{ $procuracao->orgao_expeditor }}</dd>
            <dt>Cpf</dt>
            <dd>{{ $procuracao->cpf }}</dd>
            <dt>Endereco</dt>
            <dd>{{ $procuracao->endereco }}</dd>
            <dt>Bairro</dt>
            <dd>{{ $procuracao->bairro }}</dd>
            <dt>Cidade</dt>
            <dd>{{ $procuracao->cidade }}</dd>
            <dt>Estado</dt>
            <dd>{{ $procuracao->estado }}</dd>
            <dt>Created At</dt>
            <dd>{{ $procuracao->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $procuracao->updated_at }}</dd>
            <dt>Updated By</dt>
            <dd>{{ isset($procuracao->updater->name) ? $procuracao->updater->name : '' }}</dd>
            <dt>Created By</dt>
            <dd>{{ isset($procuracao->creator->name) ? $procuracao->creator->name : '' }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('procuracao.procuracao.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection