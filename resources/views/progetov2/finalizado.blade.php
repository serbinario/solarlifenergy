<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="contas_compensacao_cadastradas" class="col-md-2 control-label text-bold">Contas Compensação Cadastradas?:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="contas_compensacao_cadastradas">
                        <input id="contas_compensacao_cadastradas" class="" name="contas_compensacao_cadastradas" type="checkbox" value="1" {{ old('contas_compensacao_cadastradas', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
            <label for="obs" class="col-md-2 control-label  text-bold">Obs.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($projeto->obs) ? $projeto->obs : null) }}</textarea>
                {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


    </div> <!-- Fim do col-md-12 -->
</div>

