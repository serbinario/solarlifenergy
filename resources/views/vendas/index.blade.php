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
                        <header>Pedidos</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('franquia.franquia.create') }}" class="btn btn-primary" title="Pedido">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- BEGIN LAYOUT LEFT ALIGNED -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-head">
                                    <ul class="nav nav-tabs" data-toggle="tabs">
                                        <li class="active"><a href="#inversores">INVERSORES</a></li>
                                        <li><a href="#modulos">MÓDULOS</a></li>
                                        <li><a href="#estrutura">ESTRUTURA</a></li>
                                        <li><a href="#eletrica">ELÉTRICA</a></li>
                                    </ul>
                                </div><!--end .card-head -->
                                <div class="card-body tab-content">
                                    <div class="tab-pane active" id="inversores">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Estoque</th>
                                                <th>Produto</th>
                                                <th>Valor</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>123</td>
                                                <td>INVERSOR KSTAR KSG 15K</td>
                                                <td>R$ 15.200,00</td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-icon-toggle"  data-placement="top" data-original-title="Edit row"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>123</td>
                                                <td>INVERSOR KSTAR KSG 30K</td>
                                                <td>R$ 26.400,00</td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-icon-toggle" data-placement="top" data-original-title="Edit row"><i class="glyphicon glyphicon-plus"></i></button>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>123</td>
                                                <td>INVERSOR KSTAR KSG 5K</td>
                                                <td>R$ 15.000,00</td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-icon-toggle"  data-placement="top" data-original-title="Edit row"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="modulos"><p>Ad ius duis dissentiunt, an sit harum primis persecuti, adipisci tacimates mediocrem sit et. Id illud voluptaria omittantur qui, te affert nostro mel. Cu conceptam vituperata temporibus has.</p>
                                    </div>
                                    <div class="tab-pane" id="estrutura"><p>Duo semper accumsan ea, quidam convenire cum cu, oportere maiestatis incorrupte est eu. Soluta audiam timeam ius te, idque gubergren forensibus ad mel, persius urbanitas usu id. Civibus nostrum fabellas mea te, ne pri lucilius iudicabit. Ut cibo semper vituperatoribus vix, cum in error elitr. Vix molestiae intellegat omittantur an, nam cu modo ullum scriptorem.</p>
                                        <p>Quod option numquam vel in, et fuisset delicatissimi duo, qui ut animal noluisse erroribus. Ea eum veniam audire. Per at postea mediocritatem, vim numquam aliquid eu, in nam sale gubergren. Dicant vituperata consequuntur at sea, mazim commodo</p>
                                    </div>
                                    <div class="tab-pane" id="eletrica"><p>Duo semper accumsan ea, quidam convenire cum cu, oportere maiestatis incorrupte est eu. Soluta audiam timeam ius te, idque gubergren forensibus ad mel, persius urbanitas usu id. Civibus nostrum fabellas mea te, ne pri lucilius iudicabit. Ut cibo semper vituperatoribus vix, cum in error elitr. Vix molestiae intellegat omittantur an, nam cu modo ullum scriptorem.</p>
                                        <p>Quod option numquam vel in, et fuisset delicatissimi duo, qui ut animal noluisse erroribus. Ea eum veniam audire. Per at postea mediocritatem, vim numquam aliquid eu, in nam sale gubergren. Dicant vituperata consequuntur at sea, mazim commodo</p>
                                    </div>
                                </div><!--end .card-body -->
                            </div><!--end .card -->

                        </div><!--end .col -->
                        <!-- END LAYOUT LEFT ALIGNED -->

                    </div><!--end .row -->
                    <!-- END DATATABLE 1 -->

                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/franquia/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop