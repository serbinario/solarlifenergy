@extends('layouts.menu')

@section("css")
    <style type="text/css">
        .list .tile .tile-text{
            padding: 8px 0px;
            font-size: 12px;
            padding-right: 0px;
        }
        .list .tile .tile-text small {
            font-size: 12px;
        }

        .list .tile .tile-content:last-child {
            padding-right: 0px;
        }
        .list .tile .tile-content {
            padding-left: 7px;
        }
        .list {
            line-height: 15px;
        }
    </style>
@stop

@section('content')
    <!-- BEGIN SITE ACTIVITY -->
    <div class="col-md-4">
        <div class="card ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-head">
                        <header>Histórico de Projetos</header>
                    </div><!--end .card-head -->
                    <div id="graph"></div>
                    <div class="morris-hover-point"></div>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->
@endsection

@section('javascript')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="{{ asset('/js/dashboard/index.js')}}" type="text/javascript"></script>
@stop