<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="contas_compensacao_cadastrada" class="col-md-2 control-label text-bold">Contas Compensação Cadastradas?:</label>
            <div class="col-md-10">
                <div class="checkbox checkbox-styled">
                    <label for="contas_compensacao_cadastrada">
                        <input id="contas_compensacao_cadastrada" class="" name="contas_compensacao_cadastrada" type="checkbox" value="1" {{ old('contas_compensacao_cadastrada', isset($projetov2->ProjetosFinalizado->contas_compensacao_cadastrada) ? $projetov2->ProjetosFinalizado->contas_compensacao_cadastrada : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>

                {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('data_conexao') ? 'has-error' : '' }}">
            <label for="data_conexao" class="col-sm-2 control-label text-bold">Data Conexão.:</label>
            <div class="col-md-10">
                <input class="form-control input-sm date" name="data_conexao" type="text" id="data_conexao"  value="{{ old('data_conexao', isset($projetov2->ProjetosFinalizado->data_conexao) ? $projetov2->ProjetosFinalizado->data_conexao : null) }}" placeholder="">
            </div>
        </div>

        <div class="form-group {{ $errors->has('obs_finalizado') ? 'has-error' : '' }}">
            <label for="obs_finalizado" class="col-md-2 control-label  text-bold">Obs.:</label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="obs_finalizado" cols="50" rows="10" id="obs_finalizado" placeholder="Enter obs_falizado here...">{{ old('obs_falobs_finalizadoizado', isset($projetov2->ProjetosFinalizado->obs_finalizado) ? $projetov2->ProjetosFinalizado->obs_finalizado : null) }}</textarea>
                {!! $errors->first('obs_finalizado', '<p class="help-block">:message</p>') !!}
            </div>
        </div>






    </div> <!-- Fim do col-md-12 -->
</div>

