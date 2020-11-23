<input  class="form-control input-sm hidden" name="roi_id" type="hidden" id="id" value="{{ old('id', isset($parametroRoi->id) ? $parametroRoi->id : null) }}" minlength="1" maxlength="20" placeholder="">

<div class="card-body">
    <div class="col-lg-12">
        <h4 class="text-bold">Propostas</h4>
        <hr class="ruler-lg"/>
    </div>
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">

    <label for="nome" class="col-md-4 control-label text-bold">{{ $parametroRoi->description }}.:</label>

    <div class="col-md-1">
            <div class="col-md-12">
                <input class="form-control input-sm " name="parameter_one" type="text" id="parameter_one" value="{{ old('parameter_one', isset($parametroRoi->parameter_one) ? $parametroRoi->parameter_one : null) }}" minlength="1" maxlength="20" placeholder="">
            </div>
    </div>

    <label for="active" class="col-md-2 control-label text-bold">Ativo?.:</label>
    <div class="col-md-3">
        <div class="checkbox checkbox-styled">
            <label for="active">
                <input id="active" class="" name="active" type="checkbox" value="1" {{ old('active', isset($parametroRoi->active) ? $parametroRoi->active : null) == '1' ? 'checked' : '' }}>
            </label>
        </div>
    </div>

</div>

    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">

        <label for="nome" class="col-md-4 control-label text-bold">{{ $parametroPorcentagen->description }}.:</label>

        <div class="col-md-1">
            <div class="col-md-12">
                <input class="form-control input-sm " name="participacao" type="text" id="participacao" value="{{ old('participacao', isset($parametroPorcentagen->parameter_one) ? $parametroPorcentagen->parameter_one : null) }}" minlength="1" maxlength="20" placeholder="">
            </div>
        </div>
    </div>

