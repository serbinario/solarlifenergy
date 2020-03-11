<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="col-md-2 control-label text-bold">Submetido Vistoria?:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="submeter_vistoria">
                        <input id="submeter_vistoria" class="" name="submeter_vistoria" type="checkbox" value="1" {{ old('submeter_vistoria', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo" class="col-sm-8 control-label text-bold">Obtido Protocolo?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="obter_protocolo">
                                <input id="obter_protocolo" class="" name="obter_protocolo" type="checkbox" value="1" {{ old('obter_protocolo', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>

                        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="monthly_usage" class="col-sm-7 control-label text-bold">Protocolo Número.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm" name="obter_protocolo_numero" type="text" id="obter_protocolo_numero" value="{{ old('probter_protocolo_numeroeco_kwh', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}">
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="agendar" class="col-md-2 control-label text-bold">Vistoria Agendada?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="agendar">
                        <input id="agendar" class="" name="agendar" type="checkbox" value="1" {{ old('agendar', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_data" class="col-sm-6 control-label text-bold">Vistoria Data.:</label>
                    <div class="col-md-6">
                        <input class="form-control input-sm date" name="agendar_data" type="text" id="agendar_data" value="{{ old('agendar_data', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_nota" class="col-sm-7 control-label text-bold">Vistoria Nota.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="agendar_nota" type="text" id="agendar_nota" value="{{ old('agendar_nota', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_equipe" class="col-sm-5 control-label text-bold">Vistoria Equipe.:</label>
                    <div class="col-md-7">
                        <input class="form-control input-sm" name="agendar_equipe" type="text" id="agendar_equipe" value="{{ old('agendar_equipe', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}" maxlength="100">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="finalizado" class="col-md-2 control-label text-bold">Projeto Finalizado?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="finalizado">
                        <input id="finalizado" class="" name="finalizado" type="checkbox" value="1" {{ old('finalizado', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
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

