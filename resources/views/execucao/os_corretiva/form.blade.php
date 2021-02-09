<div class="card-body">
    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
        <label for="nome" class="col-md-2 control-label text-bold">Proposta N.:</label>
        <div class="col-md-10">
            <input readonly class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($solicitacaoEntrega->projeto->PreProposta->codigo) ? $solicitacaoEntrega->projeto->PreProposta->codigo : null) }}" minlength="1" maxlength="200"  placeholder="Enter nome here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="cpf_cnpj" class="col-md-2 control-label text-bold">CLiente.:</label>
        <div class="col-md-10">
            <input readonly class="form-control input-sm" name="" type="text" id="" value="{{ old('', isset($solicitacaoEntrega->projeto->PreProposta->cliente->nome) ? $solicitacaoEntrega->projeto->PreProposta->cliente->nome : null) }}" minlength="1" maxlength="20" placeholder="Enter cpf cnpj here...">
            {!! $errors->first('cpf_cnpj', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="file" class="col-sm-2 control-label text-bold">Comprovante.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="file">
                        <input class="form-control input-sm" name="file" type="file" value="{{ old('file', isset($solicitacaoEntrega->file) ? $solicitacaoEntrega->file : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($solicitacaoEntrega->file)
                        <a target="_blank" href="{{ url("/storage/{$solicitacaoEntrega->file}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('status_entrega_id') ? 'has-error' : '' }}">
        <label for="franquia_id" class="col-md-2 control-label text-bold">Status.: *</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="status_entrega_id" name="status_entrega_id">
                <option value="" style="display: none;" {{ old('status_entrega_id', null) }} disabled selected>Selecione um status</option>
                @foreach ($status as $key => $statu)
                    <option value="{{ $key }}" {{ old('status_entrega_id', isset($solicitacaoEntrega->status_entrega_id) ? $solicitacaoEntrega->status_entrega_id : null) == $key ? 'selected' : '' }}>
                        {{ $statu }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="data_entrega" class="col-md-2 control-label text-bold">Data Entrega.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm date" name="data_entrega" type="text" id="data_entrega" value="{{ old('data_entrega', isset($solicitacaoEntrega->data_entrega) ? $solicitacaoEntrega->data_entrega : null) }}" maxlength="255" placeholder="Data Emissão">
            {!! $errors->first('data_emissao_rg', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
        <label for="obs" class="col-md-2 control-label text-bold">Obs.:</label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="obs" cols="50" rows="5" id="obs" >{{ old('obs', isset($solicitacaoEntrega->obs) ? $solicitacaoEntrega->obs : null) }}</textarea>
        </div>
    </div>

</div>