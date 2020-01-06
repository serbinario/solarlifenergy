@extends('layouts.menu')

@section('content')

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
            <form method="POST" action="{{ route('procuracao.procuracao.store') }}" accept-charset="UTF-8" id="create_procuracao_form" name="create_procuracao_form" class="form-horizontal">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Nova Procuração</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('procuracao.procuracao.index') }}" class="btn btn-primary" title="Show All Procuracao">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    @include ('procuracao.form', [ 'procuracao' => null,   ])

                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('procuracao.procuracao.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                            <button type="submit" class="btn btn-flat btn-primary ink-reaction">Salvar</button>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection


