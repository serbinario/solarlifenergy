
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalVistoria" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Relatório de Vistoria</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar Por</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="vistoriaOrdenarPor" name="vistoriaOrdenarPor" class="form-control input-sm">
                                <option value="c.nome_empresa">Nome do Cliente</option>
                                <option value="s.status_nome">Status do Projeto</option>
                                <option value="pf.data_solicitacao_vistoria">Data da Vistoria</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="vistoriaOrder" name="vistoriaOrder" class="form-control input-sm">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="reportVistoria" class="btn btn-primary">Gerar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
