
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalPropotas" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Relatório de Propostas</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar Por</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="ordenarPor" name="ordenarPor" class="form-control input-sm">
                                <option value="c.nome_empresa">Nome do Cliente</option>
                                <option value="prio.id">Prioridade</option>
                                <option value="pp.preco_medio_instalado">Valor Proposta</option>
                                <option value="u.name">Integrador</option>
                                <option value="pp.created_at">Data do Cadastro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="order" name="order" class="form-control input-sm">
                                <option value="asc">Crescente</option>
                                <option value="desc">Decrescente</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Data Inicio</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control input-sm date" name="date_init_proposta" type="text" id="date_init_prioridade">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Data Fim</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control input-sm date" name="date_end_proposta" type="text" id="date_end_prioridade">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="franquia" class="control-label">Franquiar</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="franquiaPrioridade" name="franquiaProposta" class="form-control input-sm">
                                <option value="14,15,18,22,20">TODAS</option>
                                <option value="14">SLE CABO</option>
                                <option value="15">SLE MACEIO</option>
                                <option value="18">SLE RN</option>
                                <option value="22">SL RECIFE</option>
                                <option value="20">SLE PARAIBA</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="reportProposta" class="btn btn-primary">Gerar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
