<div class="card-body">
    
<div class="form-group {{ $errors->has('num_contrato') ? 'has-error' : '' }}">
    <label for="num_contrato" class="col-md-2 control-label">Num Contrato</label>
    <div class="col-md-10">
        <input class="form-control" name="num_contrato" type="text" id="num_contrato" value="{{ old('num_contrato', isset($contratoCelpe->num_contrato) ? $contratoCelpe->num_contrato : null) }}" maxlength="100" placeholder="Enter num contrato here...">
        {!! $errors->first('num_contrato', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('projetos_id') ? 'has-error' : '' }}">
    <label for="projetos_id" class="col-md-2 control-label">Projetos</label>
    <div class="col-md-10">
        <select class="form-control" id="projetos_id" name="projetos_id">
        	    <option value="" style="display: none;" {{ old('projetos_id', isset($contratoCelpe->projetos_id) ? $contratoCelpe->projetos_id : '') == '' ? 'selected' : '' }} disabled selected>Select projetos</option>
        	@foreach ($projetos as $key => $projeto)
			    <option value="{{ $key }}" {{ old('projetos_id', isset($contratoCelpe->projetos_id) ? $contratoCelpe->projetos_id : null) == $key ? 'selected' : '' }}>
			    	{{ $projeto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('projetos_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

