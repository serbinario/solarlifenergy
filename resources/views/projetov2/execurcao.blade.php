<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="material_entrege" class="col-md-2 control-label text-bold">Material Entregue.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="material_entrege">
                        <input id="material_entrege" class="" name="material_entrege" type="checkbox" value="1" {{ old('material_entrege', isset($projetov2->ProjetosExecurcao->material_entrege) ? $projetov2->ProjetosExecurcao->material_entrege : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="validar_unidade_geradora" class="col-md-2 control-label text-bold">Validar Unidade Geradora.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="validar_unidade_geradora">
                        <input id="validar_unidade_geradora" class="" name="validar_unidade_geradora" type="checkbox" value="1" {{ old('validar_unidade_geradora', isset($projetov2->ProjetosExecurcao->validar_unidade_geradora) ? $projetov2->ProjetosExecurcao->validar_unidade_geradora : null) == '1' ? 'checked' : '' }}>
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
                        <input id="elaborar_projeto" class="" name="elaborar_projeto" type="checkbox" value="1" {{ old('elaborar_projeto', isset($projetov2->ProjetosExecurcao->elaborar_projeto) ? $projetov2->ProjetosExecurcao->elaborar_projeto : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="emitir_art" class="col-sm-8 control-label text-bold">Emitido ART?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="emitir_art">
                                <input id="emitir_art" class="" name="emitir_art" type="checkbox" value="1" {{ old('emitir_art', isset($projetov2->ProjetosExecurcao->emitir_art) ? $projetov2->ProjetosExecurcao->emitir_art : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="emitir_art_image" class="col-sm-2 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="emitir_art_image" type="file" id="emitir_art_image">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    @if($projetov2->ProjetosExecurcao->emitir_art_image)
                        <a target="_blank"  href="{{ url("/storage/{$projetov2->ProjetosExecurcao->emitir_art_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="solicitacao_acesso" class="col-sm-8 control-label text-bold">Solicitação de Acesso.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="solicitacao_acesso">
                                <input id="solicitacao_acesso" class="" name="solicitacao_acesso" type="checkbox" value="1" {{ old('solicitacao_acesso', isset($projetov2->ProjetosExecurcao->solicitacao_acesso) ? $projetov2->ProjetosExecurcao->solicitacao_acesso : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>

                        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo_data" class="col-sm-6 control-label text-bold">Data Protocolo.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="obter_protocolo_data" type="text" id="obter_protocolo_data" value="{{ old('data_validade', isset($projetov2->ProjetosExecurcao->obter_protocolo_data) ? $projetov2->ProjetosExecurcao->obter_protocolo_data : null) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo_data_prevista" class="col-sm-6 control-label text-bold">Data Prevista.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="obter_protocolo_data_prevista" type="text" id="obter_protocolo_data_prevista" value="{{ old('obter_protocolo_data_prevista', isset($projetov2->ProjetosExecurcao->obter_protocolo_data_prevista) ? $projetov2->ProjetosExecurcao->obter_protocolo_data_prevista : null) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo_numero" class="col-sm-7 control-label text-bold">Protocolo Número.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm" name="obter_protocolo_numero" type="text" id="obter_protocolo_numero" value="{{ old('obter_protocolo_numero', isset($projetov2->ProjetosExecurcao->obter_protocolo_numero) ? $projetov2->ProjetosExecurcao->obter_protocolo_numero : "") }}">
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
                                <input id="parecer_acesso" class="" name="parecer_acesso" type="checkbox" value="1" {{ old('parecer_acesso', isset($projetov2->ProjetosExecurcao->parecer_acesso) ? $projetov2->ProjetosExecurcao->parecer_acesso : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="parecer_acesso_image" class="col-sm-2 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="parecer_acesso_image" type="file" id="parecer_acesso_image" value="{{ old('parecer_acesso_image', isset($projetov2->ProjetosExecurcao->parecer_acesso_image) ? $projetov2->ProjetosExecurcao->parecer_acesso_image : "") }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    @if($projetov2->ProjetosExecurcao->parecer_acesso_image)
                        <a target="_blank"  href="{{ url("/storage/{$projetov2->ProjetosExecurcao->parecer_acesso_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
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
                                <input id="parecer_relacionamento" class="" name="parecer_relacionamento" type="checkbox" value="1" {{ old('parecer_relacionamento', isset($projetov2->ProjetosExecurcao->parecer_relacionamento) ? $projetov2->ProjetosExecurcao->parecer_relacionamento : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="parecer_relacionamento_image" class="col-sm-2 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="parecer_relacionamento_image" type="file" id="parecer_relacionamento_image" value="{{ old('parecer_relacionamento_image', isset($projetov2->ProjetosExecurcao->parecer_relacionamento_image) ? $projetov2->ProjetosExecurcao->parecer_relacionamento_image : "") }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    @if($projetov2->ProjetosExecurcao->parecer_relacionamento_image)
                        <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosExecurcao->parecer_relacionamento_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif

                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="obra_fechada" class="col-md-2 control-label text-bold">Obra Fechada?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="obra_fechada">
                        <input id="obra_fechada" class="" name="obra_fechada" type="checkbox" value="1" {{ old('obra_fechada', isset($projetov2->ProjetosExecurcao->obra_fechada) ? $projetov2->ProjetosExecurcao->obra_fechada : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('obs_execurcao') ? 'has-error' : '' }}">
            <label for="obs_execurcao" class="col-md-2 control-label  text-bold">obs_execurcao.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs_execurcao" cols="50" rows="10" id="obs_execurcao" placeholder="Enter obs_execurcao here...">{{ old('obs_execurcao', isset($projetov2->ProjetosExecurcao->obs_execurcao) ? $projetov2->ProjetosExecurcao->obs_execurcao : null) }}</textarea>
                {!! $errors->first('obs_execurcao', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


    </div> <!-- Fim do col-md-12 -->
</div>

