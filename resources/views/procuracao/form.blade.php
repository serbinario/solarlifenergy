<div class="card-body">
    
<div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
    <label for="cliente_id" class="col-md-2 control-label">Cliente</label>
    <div class="col-md-10">
        <select class="form-control" id="cliente_id" name="cliente_id">
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
    <label for="data_validade" class="col-md-2 control-label">Data Validade</label>
    <div class="col-md-10">
        <input class="form-control" name="data_validade" type="text" id="data_validade" value="{{ old('data_validade', isset($procuracao->data_validade) ? $procuracao->data_validade : null) }}" placeholder="Enter data validade here...">
        {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

