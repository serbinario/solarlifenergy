@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_projetov2_form" name="edit_projetov2_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('projetov2') }}" class="btn btn-primary" title="Show All projetov2">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Codigo</dt>
            <dd>{{ $projetov2->codigo }}</dd>
            <dt>Cliente</dt>
            <dd>{{ isset($projetov2->cliente->nome) ? $projetov2->cliente->nome : '' }}</dd>
            <dt>Projeto Status</dt>
            <dd>{{ isset($projetov2->ProjetosStatus->id) ? $projetov2->ProjetosStatus->id : '' }}</dd>
            <dt>Proposta</dt>
            <dd>{{ isset($projetov2->PreProposta->codigo) ? $projetov2->PreProposta->codigo : '' }}</dd>
            <dt>Endereco</dt>
            <dd>{{ isset($projetov2->Endereco->id) ? $projetov2->Endereco->id : '' }}</dd>
            <dt>Projeto Documento</dt>
            <dd>{{ isset($projetov2->ProjetosDocumento->id) ? $projetov2->ProjetosDocumento->id : '' }}</dd>
            <dt>Projeto Execurcao</dt>
            <dd>{{ isset($projetov2->ProjetosExecurcao->id) ? $projetov2->ProjetosExecurcao->id : '' }}</dd>
            <dt>Projeto Finalizando</dt>
            <dd>{{ isset($projetov2->ProjetosFinalizando->id) ? $projetov2->ProjetosFinalizando->id : '' }}</dd>
            <dt>Created At</dt>
            <dd>{{ $projetov2->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $projetov2->updated_at }}</dd>
            <dt>Obs</dt>
            <dd>{{ $projetov2->obs }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('projetov2') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection