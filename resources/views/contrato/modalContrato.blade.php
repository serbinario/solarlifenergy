
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="modalContrato" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Novo Contrato</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Ano</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" name="ano" id="ano" class="form-control" value="2020" placeholder="Ano">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Modelo</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="minuta_contrato" class="form-control input-sm">
                                <option value="1">Minuta Contrato 2020</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="novoContrato" class="btn btn-primary">Criar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
