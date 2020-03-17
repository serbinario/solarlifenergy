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
                <form method="POST" action="{{ route('progetov2.progetov2.update', $progetov2->id) }}" accept-charset="UTF-8" id="edit_progetov2_form" name="edit_progetov2_form" class="form-horizontal" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Editar Projeto - {{ $progetov2->PreProposta->cliente->nome }} - R$  {{ $progetov2->PreProposta->preco_medio_instalado }}</header>
                        </div>
                        @include ('progetov2.form', ['progetov2' => $progetov2, ])
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a href="{{ route('progetov2.progetov2.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Atualizar">
                            </div>
                        </div>
                    </div><!--end .card -->
                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/progetov2/edit.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop
