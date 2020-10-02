
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalEdit" tabindex="-1" role="dialog" aria-labelledby="formModalEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalEdit">Editar</h4>
            </div>
            <form id="formModalEdit" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Status.: *</label>
                            <div class="col-md-10">
                            <select   class="form-control input-sm" id="documento_status_id" name="documento_status_id">

                                <option value="" style="display: none;" {{ old('id', isset($status_documento->documento_status_id) ? $status_documento->documento_status_id : '') == '' ? 'selected' : '' }} disabled selected>Status</option>
                                @foreach ($status_documentos as $key => $status_documento)
                                    <option value="{{ $key }}" {{ old('meio_captacao_id', isset($status_documento->documento_status_id) ? $status_documento->documento_status_id : null) == $key ? 'selected' : '' }}>
                                        {{ $status_documento }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="obs" class="col-md-2 control-label text-bold">Obs.:</label>
                            <div class="col-md-10">
                                <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($cliente->obs) ? $cliente->obs : null) }}</textarea>
                                {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnModalEdit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->
