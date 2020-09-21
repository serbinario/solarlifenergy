<div class="card-body">
    <div class="form-group {{ $errors->has('max_modulos') ? 'has-error' : '' }}">
        <label for="max_modulos" class="col-md-2 control-label text-bold">Máximo de Módulos.:</label>
        <div class="col-md-2">
            <input readonly class="form-control input-sm" name="max_modulos" type="text" id="max_modulos" value="{{ old('max_modulos', isset($maoObraModulo->max_modulos) ? $maoObraModulo->max_modulos : null) }}" placeholder="">
        </div>
        <label for="valor_mao_obra" class="col-md-2 control-label text-bold">Valor.:</label>
        <div class="col-md-2">
            <input class="form-control input-sm" name="valor_mao_obra" type="text" id="valor_mao_obra" value="{{ old('valor_mao_obra', isset($maoObraModulo->valor_mao_obra) ? $maoObraModulo->valor_mao_obra : null) }}" placeholder="">
        </div>
        <label for="potencia" class="col-md-2 control-label text-bold">Potencia.:</label>
        <div class="col-md-2">
            <input readonly  class="form-control input-sm" name="potencia" type="text" id="potencia" value="{{ old('potencia', isset($maoObraModulo->modulo->potencia) ? $maoObraModulo->modulo->potencia : null) }}" placeholder="">
        </div>
    </div>







</div>

