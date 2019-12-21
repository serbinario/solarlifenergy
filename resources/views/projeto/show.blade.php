@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_projeto_form" name="edit_projeto_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('projeto.projeto.index') }}" class="btn btn-primary" title="Show All Projeto">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Clientes</dt>
            <dd>{{  isset($projeto->cliente->nome) ? $projeto->cliente->nome : ''  }}</dd>
            <dt>Consumo</dt>
            <dd>{{ $projeto->consumo }}</dd>
            <dt>Area Disponivel</dt>
            <dd>{{ $projeto->area_disponivel }}</dd>
            <dt>Users</dt>
            <dd>{{  isset($projeto->user->id) ? $projeto->user->id : ''  }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('projeto.projeto.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection