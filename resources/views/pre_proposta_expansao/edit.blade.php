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

    @if(session('errors'))
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
                <form method="POST" action="{{ route('proposta.expansao.update', $preProposta->id) }}" accept-charset="UTF-8" id="edit_pre_proposta_form" name="edit_pre_proposta_form" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-solar style-primary">
                            <div>
                                <div class="badge-solar">
                                    <span class="badge badge-dark float-right span_preco_medio_instalado">R$ 0,00</span>
                                    <p>Valor Proposta</p>
                                </div>

                                <div class="badge-solar">

                                    <span class="badge badge-dark float-right span_valor_franqueadora">R$ </span>
                                    <p>Valor do Kit</p>
                                </div>

                                <div class="badge-solar">

                                    <span class="badge badge-dark float-right equipe_tecnica">R$ </span>
                                    <p>Equipe Técnica</p>
                                </div>

                                <div class="badge-solar badge-royalties">
                                    <span class="badge badge-dark float-right participacao">R$ </span>
                                    <p>Participação</p>
                                    <span class="royalties" >R$ 208,00 Royalties</span>

                                </div>

                                {{--<div class="badge-solar">--}}
                                    {{--<span class="badge badge-dark float-right royalties">R$ </span>--}}
                                    {{--<div>--}}
                                        {{--<span>8% </span>--}}
                                        {{--<span>Royalties</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>


                            <div class="tools">
                                <div class="btn-group btn-new-proposta">
                                    <a  target="_blank" href="/report/{{ $preProposta->id }}/proposta" + class="btn btn-primary" title="Proposta">
                                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                    </a>

                                </div>
                            </div>
                        </div>

                        @include ('pre_proposta_expansao.form', ['preProposta' => $preProposta, ])

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

    <script src="{{ asset('/js/pre_proposta_expansao/edit.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/util.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/pre_proposta_expansao/simulacao.js')}}" type="text/javascript"></script>
@stop
