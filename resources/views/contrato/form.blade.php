<div class="card-body">
    
<div class="form-group {{ $errors->has('projeto_id') ? 'has-error' : '' }}">
    <label for="projeto_id" class="col-md-2 control-label">Projeto</label>
    <div class="col-md-10">
        <select class="form-control" id="projeto_id" name="projeto_id" required="true">
        	    <option value="" style="display: none;" {{ old('projeto_id', isset($contrato->projeto_id) ? $contrato->projeto_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione um Projeto</option>
        	@foreach ($projetos as $key => $projeto)
			    <option value="{{ $key }}" {{ old('projeto_id', isset($contrato->projeto_id) ? $contrato->projeto_id : null) == $key ? 'selected' : '' }}>
			    	{{ $projeto }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('projeto_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('ano') ? 'has-error' : '' }}">
    <label for="ano" class="col-md-2 control-label">Ano</label>
    <div class="col-md-10">
        <input class="form-control" name="ano" type="text" id="ano" value="{{ old('ano', isset($contrato->ano) ? $contrato->ano : null) }}" maxlength="4" placeholder="Enter ano here...">
        {!! $errors->first('ano', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    <div class="form-group {{ $errors->has('report_layout_id') ? 'has-error' : '' }}">
        <label for="report_layout_id" class="col-md-2 control-label">Nome Layout</label>
        <div class="col-md-10">
            <select class="form-control" id="report_layout_id" name="report_layout_id" required="true">
                <option value="" style="display: none;" {{ old('report_layout_id', isset($contrato->report_layout_id) ? $contrato->report_layout_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione um Layout</option>
                @foreach ($layouts as $key => $layout)
                    <option value="{{ $key }}" {{ old('report_layout_id', isset($contrato->report_layout_id) ? $contrato->report_layout_id : null) == $key ? 'selected' : '' }}>
                        {{ $layout }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('report_layout_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

