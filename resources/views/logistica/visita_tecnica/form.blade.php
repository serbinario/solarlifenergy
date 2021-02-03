<div class="card-body">

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Responsável:</label>
                <div class="col-md-6">
                    <select   class="form-control input-sm" id="tecnico_id" name="tecnico_id">
                        <option value="" style="display: none;" {{ old('tecnico_id', isset($visitaTecnica->tecnico_id) ? $visitaTecnica->tecnico_id : '') == '' ? 'selected' : '' }} disabled selected>Responsável</option>
                        @foreach ($users as $key => $user)
                            <option value="{{ $key }}" {{ old('tecnico_id', isset($visitaTecnica->tecnico_id) ? $visitaTecnica->tecnico_id : null) == $key ? 'selected' : '' }}>
                                {{ $user }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="data_previsao" class="col-md-4 control-label text-bold">Data Prevista.:</label>
                <div class="col-md-8">
                    <input  class="form-control input-sm date" name="data_previsao" type="text" id="data_previsao" value="{{ old('data_previsao', isset($visitaTecnica->data_previsao) ? $visitaTecnica->data_previsao : null) }}" maxlength="10" >

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="data_visita" class="col-md-4 control-label text-bold">Data Visita.:</label>
                <div class="col-md-8">
                    <input  class="form-control input-sm date" name="data_visita" type="text" id="data_visita" value="{{ old('data_visita', isset($visitaTecnica->data_visita) ? $visitaTecnica->data_visita : null) }}" maxlength="10">
                    {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-12">
        <h4 class="text-bold">Endereço de Instalação</h4>
        <hr class="ruler-lg"/>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cep" class="col-md-4 control-label text-bold">Cep.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="cep" type="text" id="cep" value="{{ old('cep', isset($visitaTecnica->projeto->Endereco->cep) ? $visitaTecnica->projeto->Endereco->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
                    {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="coordenadas" class="col-md-4 control-label text-bold">Coordenadas.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="coordenadas" type="text" id="coordenadas"  value="{{ old('coordenadas', isset($visitaTecnica->projeto->Endereco->coordenadas) ? $visitaTecnica->projeto->Endereco->coordenadas : null) }}" placeholder="">
                    {!! $errors->first('coordenadas', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="logradouro" class="col-md-4 control-label text-bold">End. de Instalação.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="logradouro" type="text" id="logradouro" value="{{ old('logradouro', isset($visitaTecnica->projeto->Endereco->logradouro) ? $visitaTecnica->projeto->Endereco->logradouro : null) }}" maxlength="200" placeholder="Endereço">
                    {!! $errors->first('end_intalacao', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="bairro" class="col-sm-4 control-label text-bold">Bairro.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="bairro" type="text" id="bairro" value="{{ old('bairro', isset($visitaTecnica->projeto->Endereco->bairro) ? $visitaTecnica->projeto->Endereco->bairro : null) }}" maxlength="100" placeholder="Bairro">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }}">
                <label for="numero" class="col-sm-4 control-label text-bold">Numero.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="numero" type="text" id="numero" value="{{ old('numero', isset($visitaTecnica->projeto->Endereco->numero) ? $visitaTecnica->projeto->Endereco->numero : null) }}" maxlength="10" placeholder="Enter numero here...">
                    {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }}">
                <label for="complemento" class="col-sm-4 control-label text-bold">Complemento.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="complemento" type="text" id="complemento" value="{{ old('complemento', isset($visitaTecnica->projeto->Endereco->complemento) ? $visitaTecnica->projeto->Endereco->complemento : null) }}" maxlength="200" placeholder="Enter complemento here...">
                    {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="uf" class="col-sm-4 control-label text-bold">Estado.:</label>
                <div class="col-md-8">
                    <input readonly class="form-control input-sm" name="uf" type="text" id="estado" value="{{ old('uf', isset($visitaTecnica->projeto->Endereco->uf) ? $visitaTecnica->projeto->Endereco->uf : null) }}" maxlength="2" placeholder="Enter estado here...">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cidade" class="col-sm-4 control-label text-bold">Cidade.:</label>
                <div class="col-md-8">
                    <input  readonly class="form-control input-sm" name="cidade" type="text" id="cidade" value="{{ old('cidade', isset($visitaTecnica->projeto->Endereco->cidade) ? $visitaTecnica->projeto->Endereco->cidade : null) }}" placeholder="Cidade">
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-12">
        <h4 class="text-bold">Tipo Telhado</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Fibrocimento?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_fibrocimento_1">
                            <input id="ie_fibrocimento_1" class="" name="ie_fibrocimento" type="checkbox" value="1" {{ old('ie_fibrocimento', isset($visitaTecnica->ie_fibrocimento) ? $visitaTecnica->ie_fibrocimento : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                <label for="franquia_id" class="col-md-6 control-label">Metálico?</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_metalico_1">
                            <input id="ie_metalico_1" class="" name="ie_metalico" type="checkbox" value="1" {{ old('ie_metalico', isset($visitaTecnica->ie_metalico) ? $visitaTecnica->ie_metalico : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="integrador" class="col-sm-6 control-label">Barro?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_barro_1">
                            <input id="ie_barro_1" class="" name="ie_barro" type="checkbox" value="1" {{ old('ie_barro', isset($visitaTecnica->ie_barro) ? $visitaTecnica->ie_barro : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Fibrocim Alta?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_fibrocim_alta_1">
                            <input id="ie_fibrocim_alta_1" class="" name="ie_fibrocim_alta" type="checkbox" value="1" {{ old('ie_fibrocim_alta', isset($visitaTecnica->ie_fibrocim_alta) ? $visitaTecnica->ie_fibrocim_alta : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                <label for="franquia_id" class="col-md-6 control-label">Laje?</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_laje_1">
                            <input id="ie_laje_1" class="" name="ie_laje" type="checkbox" value="1" {{ old('ie_laje', isset($visitaTecnica->ie_laje) ? $visitaTecnica->ie_laje : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="integrador" class="col-sm-6 control-label">Outros?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_outros_1">
                            <input id="ie_outros_1" class="" name="ie_outros" type="checkbox" value="1" {{ old('ie_outros', isset($visitaTecnica->ie_outros) ? $visitaTecnica->ie_outros : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Quantide de Painéis a ser instalado</h4>
        <hr class="ruler-lg"/>
    </div>


    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Área é sufuciente?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_area_suficiente_1">
                            <input id="ie_area_suficiente_1" class="" name="ie_area_suficiente" type="checkbox" value="1" {{ old('ie_area_suficiente', isset($visitaTecnica->ie_area_suficiente) ? $visitaTecnica->ie_area_suficiente : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                <label for="franquia_id" class="col-md-6 control-label">Estrutura estar ápta?</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_estrutura_estar_apta_1">
                            <input id="ie_estrutura_estar_apta_1" class="" name="ie_estrutura_estar_apta" type="checkbox" value="1" {{ old('ie_estrutura_estar_apta', isset($visitaTecnica->ie_estrutura_estar_apta) ? $visitaTecnica->ie_estrutura_estar_apta : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="integrador" class="col-sm-6 control-label">Há Vazamentos?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="ie_ha_vazamentos_1">
                            <input id="ie_ha_vazamentos_1" class="" name="ie_ha_vazamentos" type="checkbox" value="1" {{ old('ie_ha_vazamentos', isset($visitaTecnica->ie_ha_vazamentos) ? $visitaTecnica->ie_ha_vazamentos : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('distancia_circuito_placas') ? 'has-error' : '' }}">
        <label for="distancia_circuito_placas" class="col-md-2 control-label">Quais reforços necessários?</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="distancia_circuito_placas" type="text" id="distancia_circuito_placas" value="{{ old('distancia_circuito_placas', isset($visitaTecnica->distancia_circuito_placas) ? $visitaTecnica->distancia_circuito_placas : null) }}" maxlength="255">
            {!! $errors->first('distancia_circuito_placas', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('distancia_circuito_placas') ? 'has-error' : '' }}">
        <label for="distancia_circuito_placas" class="col-md-2 control-label">Altura</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="distancia_circuito_placas" type="text" id="distancia_circuito_placas" value="{{ old('distancia_circuito_placas', isset($visitaTecnica->distancia_circuito_placas) ? $visitaTecnica->distancia_circuito_placas : null) }}" maxlength="255">
            {!! $errors->first('distancia_circuito_placas', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-lg-12">
        <hr class="ruler-lg"/>
    </div>



<div class="form-group {{ $errors->has('qtd_materiais_reforco') ? 'has-error' : '' }}">
    <label for="qtd_materiais_reforco" class="col-md-2 control-label">Qtd Materiais Reforco</label>
    <div class="col-md-10">
        <textarea class="form-control input-sm" name="qtd_materiais_reforco" cols="50" rows="2" id="qtd_materiais_reforco" >{{ old('qtd_materiais_reforco', isset($visitaTecnica->qtd_materiais_reforco) ? $visitaTecnica->qtd_materiais_reforco : null) }}</textarea>
        {!! $errors->first('qtd_materiais_reforco', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('riscos_acidentes') ? 'has-error' : '' }}">
    <label for="riscos_acidentes" class="col-md-2 control-label">Riscos Acidentes</label>
    <div class="col-md-10">
        <textarea class="form-control input-sm" name="riscos_acidentes" cols="50" rows="2" id="riscos_acidentes" >{{ old('riscos_acidentes', isset($visitaTecnica->riscos_acidentes) ? $visitaTecnica->riscos_acidentes : null) }}</textarea>
        {!! $errors->first('riscos_acidentes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('material_especifico') ? 'has-error' : '' }}">
    <label for="material_especifico" class="col-md-2 control-label">Material Especifico</label>
    <div class="col-md-10">
        <textarea class="form-control input-sm" name="material_especifico" cols="50" rows="2" id="material_especifico" >{{ old('material_especifico', isset($visitaTecnica->material_especifico) ? $visitaTecnica->material_especifico : null) }}</textarea>
        {!! $errors->first('material_especifico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('distancia_circuito_placas') ? 'has-error' : '' }}">
    <label for="distancia_circuito_placas" class="col-md-2 control-label">Distancia Circuito Placas</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="distancia_circuito_placas" type="text" id="distancia_circuito_placas" value="{{ old('distancia_circuito_placas', isset($visitaTecnica->distancia_circuito_placas) ? $visitaTecnica->distancia_circuito_placas : null) }}" maxlength="255">
        {!! $errors->first('distancia_circuito_placas', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('distancia_circuito_inversor_quadro_geral') ? 'has-error' : '' }}">
    <label for="distancia_circuito_inversor_quadro_geral" class="col-md-2 control-label">Distancia Circuito Inversor Quadro Geral</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="distancia_circuito_inversor_quadro_geral" type="text" id="distancia_circuito_inversor_quadro_geral" value="{{ old('distancia_circuito_inversor_quadro_geral', isset($visitaTecnica->distancia_circuito_inversor_quadro_geral) ? $visitaTecnica->distancia_circuito_inversor_quadro_geral : null) }}" maxlength="255" >
        {!! $errors->first('distancia_circuito_inversor_quadro_geral', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    <div class="col-lg-12">
        <h4 class="text-bold">Inspeção do padrão de entrada</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Metálico?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_metalico_1">
                            <input id="pe_metalico_1" class="input-sm" name="pe_metalico" type="checkbox" value="1" {{ old('pe_metalico', isset($visitaTecnica->pe_metalico) ? $visitaTecnica->pe_metalico : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                <label for="franquia_id" class="col-md-6 control-label">Barro?</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_barro_1">
                            <input id="pe_barro_1" class="input-sm" name="pe_barro" type="checkbox" value="1" {{ old('pe_barro', isset($visitaTecnica->pe_barro) ? $visitaTecnica->pe_barro : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="integrador" class="col-sm-6 control-label">Fibrocim Alta?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_fibrocim_alta_1">
                            <input id="pe_fibrocim_alta_1" class="input-sm" name="pe_fibrocim_alta" type="checkbox" value="1" {{ old('pe_fibrocim_alta', isset($visitaTecnica->pe_fibrocim_alta) ? $visitaTecnica->pe_fibrocim_alta : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Disjuntor Geral?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_dijuntor_geral_1">
                            <input id="pe_dijuntor_geral_1" class="input-sm" name="pe_dijuntor_geral" type="checkbox" value="1" {{ old('pe_dijuntor_geral', isset($visitaTecnica->pe_dijuntor_geral) ? $visitaTecnica->pe_dijuntor_geral : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                <label for="franquia_id" class="col-md-6 control-label">Tampa Medidor PDE?</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_tampa_medidor_1">
                            <input id="pe_tampa_medidor_1" class="input-sm" name="pe_tampa_medidor" type="checkbox" value="1" {{ old('pe_tampa_medidor', isset($visitaTecnica->pe_tampa_medidor) ? $visitaTecnica->pe_tampa_medidor : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="integrador" class="col-sm-6 control-label">Caixa Medidor PDE?:</label>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label for="pe_caixa_medidor_1">
                            <input id="pe_caixa_medidor_1" class="input-sm" name="pe_caixa_medidor" type="checkbox" value="1" {{ old('pe_caixa_medidor', isset($visitaTecnica->pe_caixa_medidor) ? $visitaTecnica->pe_caixa_medidor : null) == '1' ? 'checked' : '' }}>
                             Sim
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label for="nome" class="col-sm-6 control-label">Caixa Disjuntor PDE?:</label>
                <div class="col-md-6">
                    <div class="col-md-10">
                        <input class="form-control input-sm" name="pe_caixa_disjuntor_1" type="text" id="pe_caixa_disjuntor_1" value="{{ old('pe_caixa_disjuntor_1', isset($visitaTecnica->pe_caixa_disjuntor_1) ? $visitaTecnica->pe_caixa_disjuntor_1 : null) }}" maxlength="255">
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="form-group {{ $errors->has('pe_bitola_cabo_medidor_disjuntor_geral') ? 'has-error' : '' }}">
    <label for="pe_bitola_cabo_medidor_disjuntor_geral" class="col-md-2 control-label">Bitola Cabo Medidor Disjuntor Geral</label>
    <div class="col-md-10">
            <div class="col-md-10">
                <input class="form-control input-sm" name="pe_bitola_cabo_medidor_disjuntor_geral" type="text" id="pe_bitola_cabo_medidor_disjuntor_geral" value="{{ old('pe_bitola_cabo_medidor_disjuntor_geral', isset($visitaTecnica->pe_bitola_cabo_medidor_disjuntor_geral) ? $visitaTecnica->pe_bitola_cabo_medidor_disjuntor_geral : null) }}" maxlength="255">
            </div>

    </div>
</div>

<div class="form-group {{ $errors->has('pe_bitola_rede_publica') ? 'has-error' : '' }}">
    <label for="pe_bitola_rede_publica" class="col-md-2 control-label">Bitola Rede Pública</label>
    <div class="col-md-10">
        <div class="col-md-10">
            <input class="form-control input-sm" name="pe_bitola_rede_publica" type="text" id="pe_bitola_rede_publica" value="{{ old('pe_bitola_rede_publica', isset($visitaTecnica->pe_bitola_rede_publica) ? $visitaTecnica->pe_bitola_rede_publica : null) }}" maxlength="255">
        </div>

        {!! $errors->first('pe_bitola_rede_publica', '<p class="help-block">:message</p>') !!}
    </div>
</div>



    <div class="row">
        <div class="form-group">
            <label for="foto_estrutura_image" class="col-sm-2 control-label text-bold">Fotos Estrutura.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="foto_estrutura">
                        <input class="form-control input-sm" name="foto_estrutura_image" type="file" value="{{ old('file', isset($visitaTecnica->foto_estrutura_image) ? $visitaTecnica->foto_estrutura_image : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($visitaTecnica->foto_estrutura_image)
                        <a target="_blank" href="{{ url("/storage/{$visitaTecnica->foto_estrutura_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="medicao_area_image" class="col-sm-2 control-label text-bold">Medição de Área.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="medicao_area">
                        <input class="form-control input-sm" name="medicao_area_image" type="file" value="{{ old('medicao_area_image', isset($visitaTecnica->medicao_area_image) ? $visitaTecnica->medicao_area_image : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($visitaTecnica->medicao_area_image)
                        <a target="_blank" href="{{ url("/storage/{$visitaTecnica->medicao_area_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="localizacao_image" class="col-sm-2 control-label text-bold">Localização.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="localizacao">
                        <input class="form-control input-sm" name="localizacao_image" type="file" value="{{ old('localizacao_image', isset($visitaTecnica->localizacao_image) ? $visitaTecnica->localizacao_image : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($visitaTecnica->localizacao_image)
                        <a target="_blank" href="{{ url("/storage/{$visitaTecnica->localizacao_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="disjuntor_geral_image" class="col-sm-2 control-label text-bold">Disjuntor Geral.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="disjuntor_geral">
                        <input class="form-control input-sm" name="disjuntor_geral_image" type="file" value="{{ old('disjuntor_geral_image', isset($visitaTecnica->disjuntor_geral_image) ? $visitaTecnica->disjuntor_geral_image : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($visitaTecnica->disjuntor_geral_image)
                        <a target="_blank" href="{{ url("/storage/{$visitaTecnica->disjuntor_geral_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="disjuntor_geral_image" class="col-sm-2 control-label text-bold">Comprovante.:</label>
            <div class="col-md-4">
                <div class="checkbo">
                    <label for="comprovante_image">
                        <input class="form-control input-sm" name="comprovante_image" type="file" value="{{ old('comprovante_image', isset($visitaTecnica->comprovante_image) ? $visitaTecnica->comprovante_image : "") }}">
                    </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    @if($visitaTecnica->comprovante_image)
                        <a target="_blank" href="{{ url("/storage/{$visitaTecnica->comprovante_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <label for="status_visita_id" class="col-md-4 text-bold control-label">Status</label>
                <div class="col-md-4">
                    <select   class="form-control input-sm" id="status_visita_id" name="status_visita_id">
                        <option value="" style="display: none;" {{ old('status_visita_id', isset($visitaTecnica->status_visita_id) ? $visitaTecnica->status_visita_id : '') == '' ? 'selected' : '' }} disabled selected>Status</option>
                        @foreach ($status as $key => $statu)
                            <option value="{{ $key }}" {{ old('status_visita_id', isset($visitaTecnica->status_visita_id) ? $visitaTecnica->status_visita_id : null) == $key ? 'selected' : '' }}>
                                {{ $statu }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('meio_captacao_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>

    </div>

    <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
        <label for="obs" class="col-md-2 control-label">Obs.:</label>
        <div class="col-md-10">
            <textarea class="form-control" name="obs" cols="50" rows="2" id="obs" >{{ old('obs', isset($visitaTecnica->obs) ? $visitaTecnica->obs : null) }}</textarea>
            {!! $errors->first('material_especifico', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

