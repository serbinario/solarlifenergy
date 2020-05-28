<div class="card-body">
    <input name="id" type="hidden" id="id" value="{{ old('cep', isset($projetov2->id) ? $projetov2->id : null) }}" >
    <input type="hidden" id="projeto_status_id" value="{{ old('projeto_status_id', isset($projetov2->projeto_status_id) ? $projetov2->projeto_status_id : null) }}" >

    <input name="proposta_id" type="hidden" id="proposta_id" value="{{ old('proposta_id', isset($projetov2->proposta_id) ? $projetov2->proposta_id : null) }}" >
    <input name="endereco_id" type="hidden" id="endereco_id" value="{{ old('endereco_id', isset($projetov2->endereco_id) ? $projetov2->endereco_id : null) }}" >
    <input name="projeto_documento_id" type="hidden" id="projeto_documento_id" value="{{ old('projeto_documento_id', isset($projetov2->projeto_documento_id) ? $projetov2->projeto_documento_id : null) }}" >
    <input name="projeto_execurcao_id" type="hidden" id="projeto_execurcao_id" value="{{ old('projeto_execurcao_id', isset($projetov2->projeto_execurcao_id) ? $projetov2->projeto_execurcao_id : null) }}" >
    <input name="projeto_finalizando_id" type="hidden" id="projeto_finalizando_id" value="{{ old('projeto_finalizando_id', isset($projetov2->projeto_finalizando_id) ? $projetov2->projeto_finalizando_id : null) }}" >
    <input name="projeto_finalizado_id" type="hidden" id="projeto_finalizado_id" value="{{ old('projeto_finalizado_id', isset($projetov2->projeto_finalizado_id) ? $projetov2->projeto_finalizado_id : null) }}" >

    <div id="rootwizard1" class="form-wizard form-wizard-horizontal">
        <form class="form floating-label">
            <div class="form-wizard-nav">
                <div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
                <ul class="nav nav-justified" id="projetos_wizard">
                    <li class="active"><a  href="#tab1" data-toggle="tab"><span data-tab_li="0"  class="step">1</span> <span class="title">Análise</span></a></li>

                    @role('admin|super-admin')
                        <li ><a href="#tab2"   data-toggle="tab"><span data-tab_li="1" class="step">2</span> <span class="title">Em Execução</span></a></li>
                        <li  ><a href="#tab3" data-toggle="tab"><span data-tab_li="2" class="step">3</span> <span class="title">Finalizando</span></a></li>
                        <li  ><a href="#tab4" data-toggle="tab"><span data-tab_li="3" class="step">4</span> <span class="title">Finalizado</span></a></li>
                    @endrole
                </ul>
            </div><!--end .form-wizard-nav -->
            <div class="tab-content clearfix" id="tabs-solar">
                <div class="tab-pane" id="tab1">
                    <br/><br/>
                    @include('projetov2.analize')

                </div><!--end #tab1 -->
                <div class="tab-pane" id="tab2">
                    <br/><br/>
                    @include('projetov2.execucao')
                </div><!--end #tab2 -->
                <div class="tab-pane" id="tab3">
                    <br/><br/>
                    @include('projetov2.finalizando')
                </div><!--end #tab3 -->
                <div class="tab-pane" id="tab4">
                    <br/><br/>
                    @include('projetov2.finalizado')

                </div><!--end #tab4 -->
            </div><!--end .tab-content -->
            <ul class="pager wizard">
                <li class="previous first"><a class="btn-raised" href="javascript:void(0);">Primeiro</a></li>
                <li class="previous"><a class="btn-raised" href="javascript:void(0);">Anterior</a></li>
                <li class="next last"><a class="btn-raised" href="javascript:void(0);">Último</a></li>
                <li class="next"><a class="btn-raised" href="javascript:void(0);">Próximo</a></li>
            </ul>
        </form>
    </div><!--end #rootwizard -->




</div>

