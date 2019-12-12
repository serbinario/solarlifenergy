@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="btn-group btn-group-sm pull-right" role="group">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('cliente_web.store') }}" accept-charset="UTF-8" id="create_cliente_web_form" name="create_cliente_web_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('cliente_web.form', [
                                        'clienteWeb' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop


