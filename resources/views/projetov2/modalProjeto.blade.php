
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalProjetos" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Relatório de Projetos</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Status</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="projetoStatus" name="projetoStatus" class="form-control input-sm" multiple="multiple">
                                <option value="1">Análise Preliminar</option>
                                <option value="2">Elaboração Projeto</option>
                                <option value="3">Finalizado p/ Inínicio de Obras</option>
                                <option value="4">Obras em Execução </option>
                                <option value="5">Obras em Fase Final</option>
                                <option value="6">Obras Finalizadas </option>
                                <option value="7">Obras Paradas</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar Por</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="ProjetoOrdenarPor" name="projetoOrdenarPor" class="form-control input-sm">
                                <option value="clientes.nome_empresa">Nome</option>
                                <option value="pre_propostas.data_financiamento_bancario">Data Assinatura</option>
                                <option value="pre_propostas.data_prevista_parcela">Data Parcela</option>
                                <option value="projetos_prioridades.id">Prioridade</option>
                                <option value="users.name">Intergrador</option>
                                <option value="banco_financiadora.nome">Banco</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ordenar</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="projetoOrder" name="projetoOrder" class="form-control input-sm">
                                <option value="">Selecione</option>
                                <option value="asc">Crescente</option>
                                <option value="desc">Decrescente</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="reportProjeto" class="btn btn-primary">Gerar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
