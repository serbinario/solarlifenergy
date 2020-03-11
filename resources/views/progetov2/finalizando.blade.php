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

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="obter_protocolo" class="col-md-2 control-label text-bold">Obtido Protocolo?:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="obter_protocolo">
                        <input id="obter_protocolo" class="" name="obter_protocolo" type="checkbox" value="1" {{ old('obter_protocolo', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('preco_kwh') ? 'has-error' : '' }}">
            <label for="obter_protocolo_image" class="col-sm-2 control-label text-bold">Protocolo Documento.:*</label>
            <div class="col-md-10">
                <input class="form-control input-sm" name="obter_protocolo_image" type="file" id="obter_protocolo_image" value="{{ old('obter_protocolo_image', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}">

            </div>
        </div>

        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="bra_fechada" class="col-md-2 control-label text-bold">Obra Fechada?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="obra_fechada">
                        <input id="obra_fechada" class="" name="obra_fechada" type="checkbox" value="1" {{ old('obra_fechada', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
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

        <div class="form-group {{ $errors->has('preco_kwh') ? 'has-error' : '' }}">
            <label for="agendar_nota" class="col-sm-2 control-label text-bold">Vistoria Nota.:*</label>
            <div class="col-md-10">
                <input class="form-control input-sm" name="agendar_nota" type="text" id="agendar_nota" value="{{ old('agendar_nota', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}" maxlength="100" >

            </div>
        </div>

        <div class="form-group">
            <label for="agendar_data" class="col-sm-2 control-label text-bold">Vistoria Data.:</label>
            <div class="col-md-10">
                <input class="form-control input-sm date" name="agendar_data" type="text" id="agendar_data" value="{{ old('agendar_data', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
            </div>
        </div>

        <div class="form-group {{ $errors->has('preco_kwh') ? 'has-error' : '' }}">
            <label for="agendar_equipe" class="col-sm-2 control-label text-bold">Vistoria Equipe.:*</label>
            <div class="col-md-10">
                <input class="form-control input-sm" name="agendar_equipe" type="text" id="agendar_equipe" value="{{ old('agendar_equipe', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}" maxlength="100">

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

