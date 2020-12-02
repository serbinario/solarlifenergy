<div class="card-body">

    <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
        <label for="franquia_id" class="col-md-2 control-label">Franquia.: *</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="franquia_id" name="franquia_id">
                @foreach ($franquias as $key => $franquia)
                    <option value="{{ $key }}" {{ old('franquia_id', isset($alert->franquia->id) ? $alert->franquia->id : null) == $key ? 'selected' : '' }}>
                        {{ $franquia }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('franquia_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-2 control-label text-bold">Titulo</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="title" type="text" id="title" value="{{ old('title', isset($alert->title) ? $alert->title : null) }}" minlength="1" maxlength="30">
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-2 control-label text-bold">Descrição.:</label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="description" cols="50" rows="10" id="description" placeholder="Enter obs here...">{{ old('obs', isset($alert->description) ? $alert->description : null) }}</textarea>
            {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


</div>

