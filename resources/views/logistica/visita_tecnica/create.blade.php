@extends('layouts.menu')


@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('visita_tecnica.visita_tecnica.store') }}" accept-charset="UTF-8" id="create_visita_tecnica_form" name="create_visita_tecnica_form" class="form-horizontal">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Create an account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('visita_tecnica.visita_tecnica.index') }}" class="btn btn-primary" title="Show All Visita Tecnica">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    @include ('visita_tecnica.form', [ 'visitaTecnica' => null,   ])

                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('visita_tecnica.visita_tecnica.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                            <button type="submit" class="btn btn-flat btn-primary ink-reaction">Salvar</button>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection


