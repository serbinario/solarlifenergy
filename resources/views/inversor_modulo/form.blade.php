<div class="card-body">
    <div class="form-group {{ $errors->has('max_modulos') ? 'has-error' : '' }}">

        <label for="produto_id" class="col-md-2 control-label text-bold">Inversor.:</label>
        <div class="col-md-2">
            <input readonly class="form-control input-sm" name="produto_id" type="text" id="produto_id" value="{{ old('valor_mao_obra', isset($inversorModulo->produto->produto) ? $inversorModulo->produto->produto : null) }}" placeholder="">
        </div>
        <label for="potencia" class="col-md-2 control-label text-bold">Potencia.:</label>
        <div class="col-md-2">
            <input readonly  class="form-control input-sm" name="potencia" type="text" id="potencia" value="{{ old('potencia', isset($inversorModulo->modulo->potencia) ? $inversorModulo->modulo->potencia : null) }}" placeholder="">
        </div>
        <label for="max_modulos" class="col-md-2 control-label text-bold">Máximo de Módulos.:</label>
        <div class="col-md-2">
            <input class="form-control input-sm" name="max_modulos" type="text" id="max_modulos" value="{{ old('max_modulos', isset($inversorModulo->max_modulos) ? $inversorModulo->max_modulos : null) }}" placeholder="">
        </div>
    </div>

    <div class="form-group {{ $errors->has('max_modulos') ? 'has-error' : '' }}">
        <label for="mc4" class="col-md-2 control-label text-bold">MC4.:</label>
        <div class="col-md-2">
            <input readonly class="form-control input-sm" name="mc4" type="text" id="mc4" value="{{ old('mc4', isset($inversorModulo->mc4) ? $inversorModulo->mc4 : null) }}" placeholder="">
        </div>
        <label for="staringbox" class="col-md-2 control-label text-bold">StringBox.:</label>
        <div class="col-md-2">
            <input readonly class="form-control input-sm" name="staringbox" type="text" id="staringbox" value="{{ old('valor_mao_obra', isset($inversorModulo->stringbox) ? $inversorModulo->stringbox : null) }}" placeholder="">
        </div>
    </div>







</div>

