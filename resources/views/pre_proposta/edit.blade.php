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

    @if(Session::has('$error_message'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times&times;</a>
            @foreach($errors->all() as $error)
                <div>{{ $error_message }}</div>
            @endforeach
        </div>
    @endif

    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('pre_proposta.pre_proposta.update', $preProposta->id) }}" accept-charset="UTF-8" id="edit_pre_proposta_form" name="edit_pre_proposta_form" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Editar Pré-Proposta</header>
                            <div class="col-6 span_preco_medio_instalado">
                                <span class="badge badge-dark float-right">
                                    R$
                                </span>
                            </div>
                            @if(Auth::user()->franquia->franqueadora != 1)
                                <header>Valor do Kit</header>
                                <div class="col-6 span_valor_franqueadora">
                                    <span class="badge badge-dark float-right">
                                        R$
                                    </span>
                                </div>
                            @endif
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('pre_proposta.pre_proposta.index') }}" class="btn btn-primary" title="Show All Pre Proposta">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('pre_proposta.pre_proposta.create') }}" class="btn btn-primary" title="Create New Pre Proposta">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>

                                </div>
                            </div>
                        </div>

                        @include ('pre_proposta.form', ['preProposta' => $preProposta, ])

                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                @if(!isset($preProposta->projetov2()->first()->id) && $preProposta->estar_finalizado == 1)
                                     <input class="btn btn-primary" id="novo_projeto" type="button" value="Criar Projeto">
                                @endif
                                <a href="{{ route('pre_proposta.pre_proposta.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                                <input id="submit" class="btn btn-primary" type="submit" value="Atualizar">
                            </div>
                        </div>
                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')

    <script src="{{ asset('/js/pre_proposta/edit.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/util.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/pre_proposta/simulacao.js')}}" type="text/javascript"></script>
@stop
