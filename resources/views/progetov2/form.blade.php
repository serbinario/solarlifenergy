<div class="card-body">

    <div id="rootwizard1" class="form-wizard form-wizard-horizontal">
        <form class="form floating-label">
            <div class="form-wizard-nav">
                <div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
                <ul class="nav nav-justified" id="teste">
                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="step">1</span> <span class="title">Análise</span></a></li>
                    <li><a href="#tab2" data-toggle="tab"><span class="step">2</span> <span class="title">Em Execurção</span></a></li>
                    <li><a href="#tab3" data-toggle="tab"><span class="step">3</span> <span class="title">Finalizando</span></a></li>
                    <li><a href="#tab4" data-toggle="tab"><span class="step">4</span> <span class="title">Finalizado</span></a></li>
                </ul>
            </div><!--end .form-wizard-nav -->
            <div class="tab-content clearfix" id="tabs-solar">
                <div class="tab-pane active" id="tab1">
                    <br/><br/>
                    @include('progetov2.analize')

                </div><!--end #tab1 -->
                <div class="tab-pane" id="tab2">
                    <br/><br/>
                    @include('progetov2.execurcao')
                </div><!--end #tab2 -->
                <div class="tab-pane" id="tab3">
                    <br/><br/>
                    @include('progetov2.finalizando')
                </div><!--end #tab3 -->
                <div class="tab-pane" id="tab4">
                    <br/><br/>
                    @include('progetov2.finalizado')
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

