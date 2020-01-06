@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_parametro_form" name="edit_parametro_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('parametro.parametro.index') }}" class="btn btn-primary" title="Show All Parametro">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Procu Nome</dt>
            <dd>{{ $parametro->procu_nome }}</dd>
            <dt>Procu Rg</dt>
            <dd>{{ $parametro->procu_rg }}</dd>
            <dt>Procu Orgao Expeditor</dt>
            <dd>{{ $parametro->procu_orgao_expeditor }}</dd>
            <dt>Procu Cpf</dt>
            <dd>{{ $parametro->procu_cpf }}</dd>
            <dt>Procu Endereco</dt>
            <dd>{{ $parametro->procu_endereco }}</dd>
            <dt>Procu Bairro</dt>
            <dd>{{ $parametro->procu_bairro }}</dd>
            <dt>Procu Cidade</dt>
            <dd>{{ $parametro->procu_cidade }}</dd>
            <dt>Procu Estado</dt>
            <dd>{{ $parametro->procu_estado }}</dd>
            <dt>Cliente</dt>
            <dd>{{ isset($parametro->cliente->nome) ? $parametro->cliente->nome : '' }}</dd>
            <dt>Created By</dt>
            <dd>{{ isset($parametro->creator->name) ? $parametro->creator->name : '' }}</dd>
            <dt>Updated By</dt>
            <dd>{{ isset($parametro->updater->name) ? $parametro->updater->name : '' }}</dd>
            <dt>Franquia</dt>
            <dd>{{ isset($parametro->franquium->id) ? $parametro->franquium->id : '' }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('parametro.parametro.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection