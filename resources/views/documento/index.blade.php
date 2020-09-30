@extends('layouts.menu')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Franquias - Lista de documentos</header>
                        <div class="tools">
                            <div class="btn-group">
                            </div>
                        </div>
                    </div>
                    @include('documento.filtro')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body panel-body-with-table">
                                <div class="table-responsive">
                                    <table id="documentos" class="table order-column hover">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Id</th>
                                            <th>Franquia</th>
                                            <th>Documento</th>
                                            <th>Data</th>
                                            <th>Assinado</th>
                                            <th>Data</th>
                                            <th>Status</th>
                                            <th>Acao</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div><!--end .table-responsive -->
                            </div>
                        </div><!--end .col -->
                    </div><!--end .row -->
                    <!-- END DATATABLE 1 -->

                    <div class="card-actionbar">

                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

    @include('documento.modalUpload')

@endsection

@section('javascript')
    <script src="{{ asset('js/documento/index.js')}}" type="text/javascript"></script>
@stop