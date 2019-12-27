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


    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('projeto.projeto.update', $projeto->id) }}" accept-charset="UTF-8" id="edit_projeto_form" name="edit_projeto_form" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Editar Projeto</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('projeto.projeto.index') }}" class="btn btn-primary" title="Show All Projeto">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('projeto.projeto.create') }}" class="btn btn-primary" title="Create New Projeto">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @include ('projeto.form', ['projeto' => $projeto, ])

                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a href="{{ route('projeto.projeto.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Update">
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