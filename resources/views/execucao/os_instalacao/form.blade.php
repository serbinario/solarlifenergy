<div class="card-body">

    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="nome" class="col-md-2 control-label text-bold">Responsável:</label>
        <div class="col-md-3">
            <select   class="form-control input-sm" id="tecnico_id" name="tecnico_id">
                <option value="" style="display: none;" {{ old('tecnico_id', isset($ordemServico->tecnico_id) ? $ordemServico->tecnico_id : '') == '' ? 'selected' : '' }} disabled selected>Responsável</option>
                @foreach ($users as $key => $user)
                    <option value="{{ $key }}" {{ old('tecnico_id', isset($ordemServico->tecnico_id) ? $ordemServico->tecnico_id : null) == $key ? 'selected' : '' }}>
                        {{ $user }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="cpf_cnpj" class="col-md-2 control-label text-bold">CLiente.:</label>
        <div class="col-md-10">
            <input readonly class="form-control input-sm" name="" type="text" id="" value="{{ old('', isset($ordemServico->projeto->PreProposta->cliente->nome) ? $ordemServico->projeto->PreProposta->cliente->nome : null) }}" minlength="1" maxlength="20" placeholder="Enter cpf cnpj here...">
            {!! $errors->first('cpf_cnpj', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="cpf_cnpj" class="col-md-2 control-label text-bold">Data Visita.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm date" name="data_visita" type="text" id="data_visita" value="{{ old('data_visita', isset($ordemServico->data_visita) ? $ordemServico->data_visita : null) }}" maxlength="255" placeholder="Data Emissão">

        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="file" class="col-sm-2 control-label text-bold">Comprovante.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="file">
                        <input class="form-control input-sm" name="file" type="file" value="{{ old('file', isset($ordemServico->file) ? $ordemServico->file : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($ordemServico->file)
                        <a target="_blank" href="{{ url("/storage/{$ordemServico->file}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="status_visita_id" class="col-md-2 control-label text-bold">Status</label>
        <div class="col-md-3">
            <select   class="form-control input-sm" id="status_visita_id" name="status_visita_id">
                <option value="" style="display: none;" {{ old('status_visita_id', isset($ordemServico->status_visita_id) ? $ordemServico->status_visita_id : '') == '' ? 'selected' : '' }} disabled selected>Status</option>
                @foreach ($status as $key => $statu)
                    <option value="{{ $key }}" {{ old('status_visita_id', isset($ordemServico->status_visita_id) ? $ordemServico->status_visita_id : null) == $key ? 'selected' : '' }}>
                        {{ $statu }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('meio_captacao_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
        <label for="obs" class="col-md-2 control-label text-bold">Obs.:</label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="obs" cols="50" rows="5" id="obs" >{{ old('obs', isset($ordemServico->obs) ? $ordemServico->obs : null) }}</textarea>
        </div>
    </div>

</div>