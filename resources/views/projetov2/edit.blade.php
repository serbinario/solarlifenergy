@extends('layouts.menu')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times&times;</span>
            </button>

        </div>
    @endif

    @if(Session::has('errors'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times&times;</a>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('projetov2.projetov2.update', $projetov2->id) }}" accept-charset="UTF-8" id="edit_projetov2_form" name="edit_projetov2_form" class="form-horizontal" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Editar Projeto - {{ $projetov2->PreProposta->cliente->nome }}

                            </header>
                            <div class="col-6 span_preco_medio_instalado">
                                <span class="badge badge-dark float-right">R$ {{ $projetov2->PreProposta->preco_medio_instalado }}</span>
                            </div>
                        </div>
                        @include ('projetov2.form', ['projetov2' => $projetov2 ])
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">

                                @if(!isset($projetov2->solicitacaoEntrega) && $projetov2->projeto_status_id !=1 &&  $projetov2->projeto_status_id !=8 && isset($projetov2->PreProposta->produtos[0]) && Auth::user()->franquia->id == 14)
                                    <input class="btn btn-primary" id="solicitacaoEntrega" type="button" value="Criar Solicitação de Entrega">
                                @endif
                                @if(!isset($projetov2->contrato->id))
                                    <input class="btn btn-primary" id="modalContrato" type="button" value="Criar Contrato">
                                @endif
                                <a href="{{ route('projetov2.projetov2.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Atualizar">
                            </div>
                        </div>

                    </div><!--end .card -->
                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

    @include ('projetov2.modalContrato', ['projetov2' => $projetov2 ])

@endsection

@section('javascript')
    <script src="{{ asset('/js/projetov2/edit.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/projetov2/visitaTecnica.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/projetov2/ordemServico.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop
