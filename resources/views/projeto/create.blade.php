@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('projeto.projeto.store') }}" accept-charset="UTF-8" id="create_projeto_form" name="create_projeto_form" class="form-horizontal">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Novo Projeto</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('projeto.projeto.index') }}" class="btn btn-primary" title="Show All Projeto">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    @include ('projeto.form', [ 'projeto' => null,   ])

                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('projeto.projeto.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
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
    <script src="{{ asset('/js/projeto/edit.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop