@extends('layouts.app')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_visitaTecnica_form" name="edit_visitaTecnica_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('visita_tecnica.visita_tecnica.index') }}" class="btn btn-primary" title="Show All Visita Tecnica">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Projeto</dt>
            <dd>{{ isset($visitaTecnica->Projetosv2->id) ? $visitaTecnica->Projetosv2->id : '' }}</dd>
            <dt>Ie Fibrocimento</dt>
            <dd>{{ ($visitaTecnica->ie_fibrocimento) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Metalico</dt>
            <dd>{{ ($visitaTecnica->ie_metalico) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Barro</dt>
            <dd>{{ ($visitaTecnica->ie_barro) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Fibrocim Alta</dt>
            <dd>{{ ($visitaTecnica->ie_fibrocim_alta) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Laje</dt>
            <dd>{{ ($visitaTecnica->ie_laje) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Outros</dt>
            <dd>{{ ($visitaTecnica->ie_outros) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Area Suficiente</dt>
            <dd>{{ ($visitaTecnica->ie_area_suficiente) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Estrutura Estar Apta</dt>
            <dd>{{ ($visitaTecnica->ie_estrutura_estar_apta) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Reforcos Necessarios</dt>
            <dd>{{ ($visitaTecnica->ie_reforcos_necessarios) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Ha Vazamentos</dt>
            <dd>{{ ($visitaTecnica->ie_ha_vazamentos) ? 'Yes' : 'No' }}</dd>
            <dt>Ie Altura</dt>
            <dd>{{ ($visitaTecnica->ie_altura) ? 'Yes' : 'No' }}</dd>
            <dt>Qtd Materiais Reforco</dt>
            <dd>{{ $visitaTecnica->qtd_materiais_reforco }}</dd>
            <dt>Riscos Acidentes</dt>
            <dd>{{ $visitaTecnica->riscos_acidentes }}</dd>
            <dt>Material Especifico</dt>
            <dd>{{ $visitaTecnica->material_especifico }}</dd>
            <dt>Distancia Circuito Placas</dt>
            <dd>{{ $visitaTecnica->distancia_circuito_placas }}</dd>
            <dt>Distancia Circuito Inversor Quadro Geral</dt>
            <dd>{{ $visitaTecnica->distancia_circuito_inversor_quadro_geral }}</dd>
            <dt>Pe Metalico</dt>
            <dd>{{ ($visitaTecnica->pe_metalico) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Barro</dt>
            <dd>{{ ($visitaTecnica->pe_barro) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Fibrocim Alta</dt>
            <dd>{{ ($visitaTecnica->pe_fibrocim_alta) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Dijuntor Geral</dt>
            <dd>{{ ($visitaTecnica->pe_dijuntor_geral) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Tampa Medidor</dt>
            <dd>{{ ($visitaTecnica->pe_tampa_medidor) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Caixa Medidor</dt>
            <dd>{{ ($visitaTecnica->pe_caixa_medidor) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Caixa Disjuntor</dt>
            <dd>{{ ($visitaTecnica->pe_caixa_disjuntor) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Bitola Cabo Medidor Disjuntor Geral</dt>
            <dd>{{ ($visitaTecnica->pe_bitola_cabo_medidor_disjuntor_geral) ? 'Yes' : 'No' }}</dd>
            <dt>Pe Bitola Rede Publica</dt>
            <dd>{{ ($visitaTecnica->pe_bitola_rede_publica) ? 'Yes' : 'No' }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('visita_tecnica.visita_tecnica.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection