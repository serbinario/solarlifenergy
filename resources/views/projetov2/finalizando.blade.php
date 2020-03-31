<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="solicitacao_vistoria" class="col-sm-8 control-label text-bold">Solicitação de Vistoria.:</label>
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="obter_protocolo_vistoria_numero" class="col-sm-7 control-label text-bold">Protocolo Número.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm" name="obter_protocolo_vistoria_numero" type="text" id="obter_protocolo_vistoria_numero" value="{{ old('obter_protocolo_vistoria_numero', isset($projetov2->ProjetosFinalizando->obter_protocolo_vistoria_numero) ? $projetov2->ProjetosFinalizando->obter_protocolo_vistoria_numero : "") }}">
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group {{ $errors->has('emitir_art') ? 'has-emitir_art' : '' }}">
            <label for="agendar" class="col-md-2 control-label text-bold">Vistoria Agendada?.:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="agendar">
                        <input id="agendar" class="" name="agendar" type="checkbox" value="1" {{ old('agendar', isset($projetov2->ProjetosFinalizando->agendar) ? $projetov2->ProjetosFinalizando->agendar : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_data" class="col-sm-6 control-label text-bold">Vistoria Data.:</label>
                    <div class="col-md-6">
                        <input class="form-control input-sm date" name="agendar_data" type="text" id="agendar_data" value="{{ old('agendar_data', isset($projetov2->ProjetosFinalizando->agendar_data) ? $projetov2->ProjetosFinalizando->agendar_data : null) }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_nota" class="col-sm-7 control-label text-bold">Vistoria Nota.:</label>
                    <div class="col-md-5">
                        <input class="form-control input-sm" name="agendar_nota" type="text" id="agendar_nota" value="{{ old('agendar_nota', isset($projetov2->ProjetosFinalizando->agendar_nota) ? $projetov2->ProjetosFinalizando->agendar_nota : null) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="agendar_equipe" class="col-sm-5 control-label text-bold">Vistoria Equipe.:</label>
                    <div class="col-md-7">
                        <input class="form-control input-sm" name="agendar_equipe" type="text" id="agendar_equipe" value="{{ old('agendar_equipe', isset($projetov2->ProjetosFinalizando->agendar_equipe) ? $projetov2->ProjetosFinalizando->agendar_equipe : "") }}" maxlength="100">
                    </div>
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
            <label for="obs_falizando" class="col-md-2 control-label  text-bold">obs_falizando.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs_falizando" cols="50" rows="10" id="obs_falizando" placeholder="Enter obs_falizando here...">{{ old('obs_falizando', isset($projetov2->ProjetosFinalizando->obs_falizando) ? $projetov2->ProjetosFinalizando->obs_falizando : null) }}</textarea>
                {!! $errors->first('obs_falizando', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


    </div> <!-- Fim do col-md-12 -->
</div>

