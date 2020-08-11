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
            <form method="POST" action="{{ route('pre_proposta.pre_proposta.store') }}" accept-charset="UTF-8" id="create_pre_proposta_form" name="create_pre_proposta_form" onsubmit="return validateForm()" class="form-horizontal">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Nova Proposta</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('pre_proposta.pre_proposta.index') }}" class="btn btn-primary" title="Show All Pre Proposta">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    @include ('pre_proposta.form_create', [ 'preProposta' => null,   ])

                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <button id="simular" type="button" class="btn btn-flat btn-primary ink-reaction">Simular</button>
                            <a href="{{ route('pre_proposta.pre_proposta.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                            <button type="submit" class="btn btn-flat btn-primary ink-reaction">Salvar</button>

                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')

    <script>
        $("#create_pre_proposta_form").submit(function(evt) {
            $('.money').each(function(index, elem){
                $(elem).val(realDolar($(elem).val()));
            });

            $("#preco_kwh").val(realDolar($("#preco_kwh").val()));
            $("#potencia_instalada").val(realDolar($("#potencia_instalada").val()));

        });
    </script>

    <script src="{{ asset('/js/pre_proposta/create.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/util.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/select2_util.js')}}" type="text/javascript"></script>
@stop

