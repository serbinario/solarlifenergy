<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="solicitacao_vistoria" class="col-sm-8 control-label text-bold">Vistoria Aprovada?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="solicitacao_vistoria">
                                <input id="solicitacao_vistoria" class="" name="solicitacao_vistoria" type="checkbox" value="1" {{ old('solicitacao_vistoria', isset($projetov2->ProjetosFinalizando->solicitacao_vistoria) ? $projetov2->ProjetosFinalizando->solicitacao_vistoria : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>

                        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="obter_protocolo_vistoria_numero" class="col-sm-5 control-label text-bold">N/Protocolo.:</label>
                    <div class="col-md-7">
                        <input class="form-control input-sm" name="obter_protocolo_vistoria_numero" type="text" id="obter_protocolo_vistoria_numero" value="{{ old('obter_protocolo_vistoria_numero', isset($projetov2->ProjetosFinalizando->obter_protocolo_vistoria_numero) ? $projetov2->ProjetosFinalizando->obter_protocolo_vistoria_numero : "") }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="data_solicitacao_vistoria" class="col-sm-6 control-label text-bold">Data Solicitação.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="data_solicitacao_vistoria" type="text" id="data_solicitacao_vistoria" value="{{ old('data_solicitacao_vistoria', isset($projetov2->ProjetosFinalizando->data_solicitacao_vistoria) ? $projetov2->ProjetosFinalizando->data_solicitacao_vistoria : null) }}">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="data_prevista_vistoria" class="col-sm-6 control-label text-bold">Data Prevista.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="data_prevista_vistoria" type="text" id="data_prevista_vistoria" value="{{ old('data_prevista_vistoria', isset($projetov2->ProjetosFinalizando->data_prevista_vistoria) ? $projetov2->ProjetosFinalizando->data_prevista_vistoria : null) }}">
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_nota" class="col-sm-6 control-label text-bold">Nota de Vistoria.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm" name="agendar_nota" type="text" id="agendar_nota" value="{{ old('agendar_nota', isset($projetov2->ProjetosFinalizando->agendar_nota) ? $projetov2->ProjetosFinalizando->agendar_nota : null) }}">
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-sm-3">
                <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
                    <label for="agendar" class="col-md-8 control-label text-bold">Vistoria Agendada?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="agendar">
                                <input id="agendar" class="" name="agendar" type="checkbox" value="1" {{ old('agendar', isset($projetov2->ProjetosFinalizando->agendar) ? $projetov2->ProjetosFinalizando->agendar : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_data" class="col-sm-6 control-label text-bold">Data Agendamento.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm date" name="agendar_data" type="text" id="agendar_data" value="{{ old('agendar_data', isset($projetov2->ProjetosFinalizando->agendar_data) ? $projetov2->ProjetosFinalizando->agendar_data : null) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_equipe" class="col-sm-6 control-label text-bold">Vistoria Equipe.:</label>
                    <div class="col-md-6">
                        <input class="form-control input-sm" name="agendar_equipe" type="text" id="agendar_equipe" value="{{ old('agendar_equipe', isset($projetov2->ProjetosFinalizando->agendar_equipe) ? $projetov2->ProjetosFinalizando->agendar_equipe : "") }}" maxlength="100">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="emitir_art" class="col-sm-8 control-label text-bold">Selo de Vistoria?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="selo_vistoria">
                                <input id="selo_vistoria" class="" name="selo_vistoria" type="checkbox" value="1" {{ old('selo_vistoria', isset($projetov2->ProjetosFinalizando->selo_vistoria) ? $projetov2->ProjetosFinalizando->selo_vistoria : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ProjetosFinalizando" class="col-sm-2 control-label text-bold">Documento.:</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="selo_vistoria_image" type="file" id="selo_vistoria_image">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    @if($projetov2->ProjetosFinalizando->selo_vistoria_image)
                        <a target="_blank"  href="{{ url("/storage/{$projetov2->ProjetosFinalizando->selo_vistoria_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="finalizado" class="col-md-2 control-label text-bold">Projeto Finalizado?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="finalizado">
                        <input id="finalizado" class="" name="finalizado" type="checkbox" value="1" {{ old('finalizado', isset($projetov2->ProjetosFinalizando->finalizado) ? $projetov2->ProjetosFinalizando->finalizado : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('obs_falizando') ? 'has-error' : '' }}">
            <label for="obs_falizando" class="col-md-2 control-label  text-bold">Obs.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs_falizando" cols="50" rows="10" id="obs_falizando" placeholder="Enter obs_falizando here...">{{ old('obs_falizando', isset($projetov2->ProjetosFinalizando->obs_falizando) ? $projetov2->ProjetosFinalizando->obs_falizando : null) }}</textarea>
                {!! $errors->first('obs_falizando', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


    </div> <!-- Fim do col-md-12 -->
</div>

