
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalUpload" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Importar Arquivo</h4>
            </div>
            <form id="formUpload" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="ano" class="control-label">Nome do Arquivo:</label>
                        </div>
                        <div class="col-sm-9">
                            <input id="uploadArquivos" name="arquivo" type="file" />
                            <input hidden id="documento_franquia_id" name="documento_franquia_id" type="text" value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="BtnUpload" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
