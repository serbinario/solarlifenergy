<div class="card-body">
    
<div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
    <label for="cliente_id" class="col-md-2 control-label text-bold">Cliente.:</label>
    <div class="col-md-10">
        <select class="form-control input-sm" id="cliente_id" name="cliente_id">
        	    <option value="" style="display: none;" {{ old('cliente_id', isset($procuracao->cliente_id) ? $procuracao->cliente_id : '') == '' ? 'selected' : '' }} disabled selected>Select cliente</option>
        	@foreach ($clientes as $key => $cliente)
			    <option value="{{ $key }}" {{ old('cliente_id', isset($procuracao->cliente_id) ? $procuracao->cliente_id : null) == $key ? 'selected' : '' }}>
			    	{{ $cliente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('data_validade') ? 'has-error' : '' }}">
    <label for="data_validade" class="col-md-2 control-label text-bold">Data Validade.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm date" name="data_validade" type="text" id="data_validade" value="{{ old('data_validade', isset($procuracao->data_validade) ? $procuracao->data_validade : null) }}" placeholder="Enter data validade here...">
        {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('outorgante') ? 'has-error' : '' }}">
    <label for="outorgante" class="col-md-2 control-label text-bold">Outorgante.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="outorgante" type="text" id="outorgante" value="{{ old('outorgante', isset($procuracao->outorgante) ? $procuracao->outorgante : null) }}" maxlength="200" placeholder="Enter outorgante here...">
        {!! $errors->first('outorgante', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('rg') ? 'has-error' : '' }}">
    <label for="rg" class="col-md-2 control-label text-bold">Rg.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="rg" type="text" id="rg" value="{{ old('rg', isset($procuracao->rg) ? $procuracao->rg : null) }}" maxlength="20" placeholder="Enter rg here...">
        {!! $errors->first('rg', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('orgao_expeditor') ? 'has-error' : '' }}">
    <label for="orgao_expeditor" class="col-md-2 control-label text-bold">Orgao Expeditor.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="orgao_expeditor" type="text" id="orgao_expeditor" value="{{ old('orgao_expeditor', isset($procuracao->orgao_expeditor) ? $procuracao->orgao_expeditor : null) }}" maxlength="10" placeholder="Enter orgao expeditor here...">
        {!! $errors->first('orgao_expeditor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
    <label for="cpf" class="col-md-2 control-label text-bold">Cpf.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm cpf" name="cpf" type="text" id="cpf" value="{{ old('cpf', isset($procuracao->cpf) ? $procuracao->cpf : null) }}" maxlength="20" placeholder="Enter cpf here...">
        {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }}">
    <label for="endereco" class="col-md-2 control-label text-bold">Endereco.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="endereco" type="text" id="endereco" value="{{ old('endereco', isset($procuracao->endereco) ? $procuracao->endereco : null) }}" maxlength="200" placeholder="Enter endereco here...">
        {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }}">
    <label for="bairro" class="col-md-2 control-label text-bold">Bairro.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="bairro" type="text" id="bairro" value="{{ old('bairro', isset($procuracao->bairro) ? $procuracao->bairro : null) }}" maxlength="100" placeholder="Enter bairro here...">
        {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }}">
    <label for="cidade" class="col-md-2 control-label text-bold">Cidade.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="cidade" type="text" id="cidade" value="{{ old('cidade', isset($procuracao->cidade) ? $procuracao->cidade : null) }}" maxlength="100" placeholder="Enter cidade here...">
        {!! $errors->first('cidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
    <label for="estado" class="col-md-2 control-label text-bold">Estado.:</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="estado" type="text" id="estado" value="{{ old('estado', isset($procuracao->estado) ? $procuracao->estado : null) }}" maxlength="2" placeholder="Enter estado here...">
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

