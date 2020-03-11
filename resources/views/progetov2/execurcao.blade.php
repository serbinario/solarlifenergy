<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="col-md-2 control-label text-bold">Material Entrege.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="estar_finalizado">
                        <input id="estar_finalizado" class="" name="estar_finalizado" type="checkbox" value="1" {{ old('estar_finalizado', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="unidade_geradora" class="col-md-2 control-label text-bold">Validar Unidade Geradora.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="unidade_geradora">
                        <input id="unidade_geradora" class="" name="unidade_geradora" type="checkbox" value="1" {{ old('estar_finalizado', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="elaborar_projeto" class="col-md-2 control-label text-bold">Projeto Elaborado?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="elaborar_projeto">
                        <input id="elaborar_projeto" class="" name="elaborar_projeto" type="checkbox" value="1" {{ old('elaborar_projeto', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="emitir_art" class="col-md-2 control-label text-bold">Emitido ART?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="emitir_art">
                        <input id="emitir_art" class="" name="emitir_art" type="checkbox" value="1" {{ old('emitir_art', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>




        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="monthly_usage" class="col-sm-8 control-label text-bold">Submeter Projeto.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="submeter_projeto">
                                <input id="submeter_projeto" class="" name="submeter_projeto" type="checkbox" value="1" {{ old('submeter_projeto', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>

                        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo_data" class="col-sm-7 control-label text-bold">Data Protocolo.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="obter_protocolo_data" type="text" id="obter_protocolo_data" value="{{ old('data_validade', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
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

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="parecer_acesso" class="col-sm-8 control-label text-bold">Parecer de Acesso.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="parecer_acesso">
                                <input id="parecer_acesso" class="" name="parecer_acesso" type="checkbox" value="1" {{ old('parecer_acesso', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="parecer_acesso_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="parecer_acesso_image" type="file" id="parecer_acesso_image" value="{{ old('parecer_acesso_image', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}">
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="parecer_relacionamento" class="col-sm-8 control-label text-bold">Parecer de Relacionamento.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="parecer_relacionamento">
                                <input id="parecer_relacionamento" class="" name="parecer_relacionamento" type="checkbox" value="1" {{ old('parecer_relacionamento', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="parecer_relacionamento_image" class="col-sm-3 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="parecer_relacionamento_image" type="file" id="parecer_relacionamento_image" value="{{ old('parecer_relacionamento_image', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "") }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="obra_fechada" class="col-md-2 control-label text-bold">Obra Fechada?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="obra_fechada">
                        <input id="obra_fechada" class="" name="obra_fechada" type="checkbox" value="1" {{ old('obra_fechada', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
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

