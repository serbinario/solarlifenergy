@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_preProposta_form" name="edit_preProposta_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('pre_proposta.pre_proposta.index') }}" class="btn btn-primary" title="Show All Pre Proposta">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Cliente</dt>
            <dd>{{ isset($preProposta->Cliente->nome) ? $preProposta->Cliente->nome : '' }}</dd>
            <dt>Power</dt>
            <dd>{{ $preProposta->power }}</dd>
            <dt>Quantity</dt>
            <dd>{{ $preProposta->quantity }}</dd>
            <dt>Minimum Area</dt>
            <dd>{{ $preProposta->minimum_area }}</dd>
            <dt>Average Weight</dt>
            <dd>{{ $preProposta->average_weight }}</dd>
            <dt>Value</dt>
            <dd>{{ $preProposta->value }}</dd>
            <dt>Yearly Usage</dt>
            <dd>{{ $preProposta->yearly_usage }}</dd>
            <dt>Jan</dt>
            <dd>{{ $preProposta->jan }}</dd>
            <dt>Feb</dt>
            <dd>{{ $preProposta->feb }}</dd>
            <dt>Mar</dt>
            <dd>{{ $preProposta->mar }}</dd>
            <dt>Apr</dt>
            <dd>{{ $preProposta->apr }}</dd>
            <dt>May</dt>
            <dd>{{ $preProposta->may }}</dd>
            <dt>Jun</dt>
            <dd>{{ $preProposta->jun }}</dd>
            <dt>Jul</dt>
            <dd>{{ $preProposta->jul }}</dd>
            <dt>Aug</dt>
            <dd>{{ $preProposta->aug }}</dd>
            <dt>Sep</dt>
            <dd>{{ $preProposta->sep }}</dd>
            <dt>Oct</dt>
            <dd>{{ $preProposta->oct }}</dd>
            <dt>Nov</dt>
            <dd>{{ $preProposta->nov }}</dd>
            <dt>Dec</dt>
            <dd>{{ $preProposta->dec }}</dd>
            <dt>Real Power</dt>
            <dd>{{ $preProposta->real_power }}</dd>
            <dt>Panel Power</dt>
            <dd>{{ $preProposta->panel_power }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('pre_proposta.pre_proposta.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection