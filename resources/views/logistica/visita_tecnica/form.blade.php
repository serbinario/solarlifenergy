<div class="card-body">
    
<div class="form-group {{ $errors->has('projeto_id') ? 'has-error' : '' }}">
    <label for="projeto_id" class="col-md-2 control-label">Projeto</label>
    <div class="col-md-10">

        
        {!! $errors->first('projeto_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_fibrocimento') ? 'has-error' : '' }}">
    <label for="ie_fibrocimento" class="col-md-2 control-label">Ie Fibrocimento</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_fibrocimento_1">
            	<input id="ie_fibrocimento_1" class="" name="ie_fibrocimento" type="checkbox" value="1" {{ old('ie_fibrocimento', isset($visitaTecnica->ie_fibrocimento) ? $visitaTecnica->ie_fibrocimento : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_fibrocimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_metalico') ? 'has-error' : '' }}">
    <label for="ie_metalico" class="col-md-2 control-label">Ie Metalico</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_metalico_1">
            	<input id="ie_metalico_1" class="" name="ie_metalico" type="checkbox" value="1" {{ old('ie_metalico', isset($visitaTecnica->ie_metalico) ? $visitaTecnica->ie_metalico : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_metalico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_barro') ? 'has-error' : '' }}">
    <label for="ie_barro" class="col-md-2 control-label">Ie Barro</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_barro_1">
            	<input id="ie_barro_1" class="" name="ie_barro" type="checkbox" value="1" {{ old('ie_barro', isset($visitaTecnica->ie_barro) ? $visitaTecnica->ie_barro : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_barro', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_fibrocim_alta') ? 'has-error' : '' }}">
    <label for="ie_fibrocim_alta" class="col-md-2 control-label">Ie Fibrocim Alta</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_fibrocim_alta_1">
            	<input id="ie_fibrocim_alta_1" class="" name="ie_fibrocim_alta" type="checkbox" value="1" {{ old('ie_fibrocim_alta', isset($visitaTecnica->ie_fibrocim_alta) ? $visitaTecnica->ie_fibrocim_alta : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_fibrocim_alta', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_laje') ? 'has-error' : '' }}">
    <label for="ie_laje" class="col-md-2 control-label">Ie Laje</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_laje_1">
            	<input id="ie_laje_1" class="" name="ie_laje" type="checkbox" value="1" {{ old('ie_laje', isset($visitaTecnica->ie_laje) ? $visitaTecnica->ie_laje : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_laje', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_outros') ? 'has-error' : '' }}">
    <label for="ie_outros" class="col-md-2 control-label">Ie Outros</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_outros_1">
            	<input id="ie_outros_1" class="" name="ie_outros" type="checkbox" value="1" {{ old('ie_outros', isset($visitaTecnica->ie_outros) ? $visitaTecnica->ie_outros : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_outros', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_area_suficiente') ? 'has-error' : '' }}">
    <label for="ie_area_suficiente" class="col-md-2 control-label">Ie Area Suficiente</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_area_suficiente_1">
            	<input id="ie_area_suficiente_1" class="" name="ie_area_suficiente" type="checkbox" value="1" {{ old('ie_area_suficiente', isset($visitaTecnica->ie_area_suficiente) ? $visitaTecnica->ie_area_suficiente : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_area_suficiente', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_estrutura_estar_apta') ? 'has-error' : '' }}">
    <label for="ie_estrutura_estar_apta" class="col-md-2 control-label">Ie Estrutura Estar Apta</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_estrutura_estar_apta_1">
            	<input id="ie_estrutura_estar_apta_1" class="" name="ie_estrutura_estar_apta" type="checkbox" value="1" {{ old('ie_estrutura_estar_apta', isset($visitaTecnica->ie_estrutura_estar_apta) ? $visitaTecnica->ie_estrutura_estar_apta : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_estrutura_estar_apta', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_reforcos_necessarios') ? 'has-error' : '' }}">
    <label for="ie_reforcos_necessarios" class="col-md-2 control-label">Ie Reforcos Necessarios</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_reforcos_necessarios_1">
            	<input id="ie_reforcos_necessarios_1" class="" name="ie_reforcos_necessarios" type="checkbox" value="1" {{ old('ie_reforcos_necessarios', isset($visitaTecnica->ie_reforcos_necessarios) ? $visitaTecnica->ie_reforcos_necessarios : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_reforcos_necessarios', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_ha_vazamentos') ? 'has-error' : '' }}">
    <label for="ie_ha_vazamentos" class="col-md-2 control-label">Ie Ha Vazamentos</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_ha_vazamentos_1">
            	<input id="ie_ha_vazamentos_1" class="" name="ie_ha_vazamentos" type="checkbox" value="1" {{ old('ie_ha_vazamentos', isset($visitaTecnica->ie_ha_vazamentos) ? $visitaTecnica->ie_ha_vazamentos : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_ha_vazamentos', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ie_altura') ? 'has-error' : '' }}">
    <label for="ie_altura" class="col-md-2 control-label">Ie Altura</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="ie_altura_1">
            	<input id="ie_altura_1" class="" name="ie_altura" type="checkbox" value="1" {{ old('ie_altura', isset($visitaTecnica->ie_altura) ? $visitaTecnica->ie_altura : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('ie_altura', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('qtd_materiais_reforco') ? 'has-error' : '' }}">
    <label for="qtd_materiais_reforco" class="col-md-2 control-label">Qtd Materiais Reforco</label>
    <div class="col-md-10">
        <textarea class="form-control" name="qtd_materiais_reforco" cols="50" rows="10" id="qtd_materiais_reforco" placeholder="Enter qtd materiais reforco here...">{{ old('qtd_materiais_reforco', isset($visitaTecnica->qtd_materiais_reforco) ? $visitaTecnica->qtd_materiais_reforco : null) }}</textarea>
        {!! $errors->first('qtd_materiais_reforco', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('riscos_acidentes') ? 'has-error' : '' }}">
    <label for="riscos_acidentes" class="col-md-2 control-label">Riscos Acidentes</label>
    <div class="col-md-10">
        <textarea class="form-control" name="riscos_acidentes" cols="50" rows="10" id="riscos_acidentes" placeholder="Enter riscos acidentes here...">{{ old('riscos_acidentes', isset($visitaTecnica->riscos_acidentes) ? $visitaTecnica->riscos_acidentes : null) }}</textarea>
        {!! $errors->first('riscos_acidentes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('material_especifico') ? 'has-error' : '' }}">
    <label for="material_especifico" class="col-md-2 control-label">Material Especifico</label>
    <div class="col-md-10">
        <textarea class="form-control" name="material_especifico" cols="50" rows="10" id="material_especifico" placeholder="Enter material especifico here...">{{ old('material_especifico', isset($visitaTecnica->material_especifico) ? $visitaTecnica->material_especifico : null) }}</textarea>
        {!! $errors->first('material_especifico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('distancia_circuito_placas') ? 'has-error' : '' }}">
    <label for="distancia_circuito_placas" class="col-md-2 control-label">Distancia Circuito Placas</label>
    <div class="col-md-10">
        <input class="form-control" name="distancia_circuito_placas" type="text" id="distancia_circuito_placas" value="{{ old('distancia_circuito_placas', isset($visitaTecnica->distancia_circuito_placas) ? $visitaTecnica->distancia_circuito_placas : null) }}" maxlength="255" placeholder="Enter distancia circuito placas here...">
        {!! $errors->first('distancia_circuito_placas', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('distancia_circuito_inversor_quadro_geral') ? 'has-error' : '' }}">
    <label for="distancia_circuito_inversor_quadro_geral" class="col-md-2 control-label">Distancia Circuito Inversor Quadro Geral</label>
    <div class="col-md-10">
        <input class="form-control" name="distancia_circuito_inversor_quadro_geral" type="text" id="distancia_circuito_inversor_quadro_geral" value="{{ old('distancia_circuito_inversor_quadro_geral', isset($visitaTecnica->distancia_circuito_inversor_quadro_geral) ? $visitaTecnica->distancia_circuito_inversor_quadro_geral : null) }}" maxlength="255" placeholder="Enter distancia circuito inversor quadro geral here...">
        {!! $errors->first('distancia_circuito_inversor_quadro_geral', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_metalico') ? 'has-error' : '' }}">
    <label for="pe_metalico" class="col-md-2 control-label">Pe Metalico</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_metalico_1">
            	<input id="pe_metalico_1" class="" name="pe_metalico" type="checkbox" value="1" {{ old('pe_metalico', isset($visitaTecnica->pe_metalico) ? $visitaTecnica->pe_metalico : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_metalico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_barro') ? 'has-error' : '' }}">
    <label for="pe_barro" class="col-md-2 control-label">Pe Barro</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_barro_1">
            	<input id="pe_barro_1" class="" name="pe_barro" type="checkbox" value="1" {{ old('pe_barro', isset($visitaTecnica->pe_barro) ? $visitaTecnica->pe_barro : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_barro', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_fibrocim_alta') ? 'has-error' : '' }}">
    <label for="pe_fibrocim_alta" class="col-md-2 control-label">Pe Fibrocim Alta</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_fibrocim_alta_1">
            	<input id="pe_fibrocim_alta_1" class="" name="pe_fibrocim_alta" type="checkbox" value="1" {{ old('pe_fibrocim_alta', isset($visitaTecnica->pe_fibrocim_alta) ? $visitaTecnica->pe_fibrocim_alta : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_fibrocim_alta', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_dijuntor_geral') ? 'has-error' : '' }}">
    <label for="pe_dijuntor_geral" class="col-md-2 control-label">Pe Dijuntor Geral</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_dijuntor_geral_1">
            	<input id="pe_dijuntor_geral_1" class="" name="pe_dijuntor_geral" type="checkbox" value="1" {{ old('pe_dijuntor_geral', isset($visitaTecnica->pe_dijuntor_geral) ? $visitaTecnica->pe_dijuntor_geral : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_dijuntor_geral', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_tampa_medidor') ? 'has-error' : '' }}">
    <label for="pe_tampa_medidor" class="col-md-2 control-label">Pe Tampa Medidor</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_tampa_medidor_1">
            	<input id="pe_tampa_medidor_1" class="" name="pe_tampa_medidor" type="checkbox" value="1" {{ old('pe_tampa_medidor', isset($visitaTecnica->pe_tampa_medidor) ? $visitaTecnica->pe_tampa_medidor : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_tampa_medidor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_caixa_medidor') ? 'has-error' : '' }}">
    <label for="pe_caixa_medidor" class="col-md-2 control-label">Pe Caixa Medidor</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_caixa_medidor_1">
            	<input id="pe_caixa_medidor_1" class="" name="pe_caixa_medidor" type="checkbox" value="1" {{ old('pe_caixa_medidor', isset($visitaTecnica->pe_caixa_medidor) ? $visitaTecnica->pe_caixa_medidor : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_caixa_medidor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_caixa_disjuntor') ? 'has-error' : '' }}">
    <label for="pe_caixa_disjuntor" class="col-md-2 control-label">Pe Caixa Disjuntor</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_caixa_disjuntor_1">
            	<input id="pe_caixa_disjuntor_1" class="" name="pe_caixa_disjuntor" type="checkbox" value="1" {{ old('pe_caixa_disjuntor', isset($visitaTecnica->pe_caixa_disjuntor) ? $visitaTecnica->pe_caixa_disjuntor : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_caixa_disjuntor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_bitola_cabo_medidor_disjuntor_geral') ? 'has-error' : '' }}">
    <label for="pe_bitola_cabo_medidor_disjuntor_geral" class="col-md-2 control-label">Pe Bitola Cabo Medidor Disjuntor Geral</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_bitola_cabo_medidor_disjuntor_geral_1">
            	<input id="pe_bitola_cabo_medidor_disjuntor_geral_1" class="" name="pe_bitola_cabo_medidor_disjuntor_geral" type="checkbox" value="1" {{ old('pe_bitola_cabo_medidor_disjuntor_geral', isset($visitaTecnica->pe_bitola_cabo_medidor_disjuntor_geral) ? $visitaTecnica->pe_bitola_cabo_medidor_disjuntor_geral : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_bitola_cabo_medidor_disjuntor_geral', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pe_bitola_rede_publica') ? 'has-error' : '' }}">
    <label for="pe_bitola_rede_publica" class="col-md-2 control-label">Pe Bitola Rede Publica</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="pe_bitola_rede_publica_1">
            	<input id="pe_bitola_rede_publica_1" class="" name="pe_bitola_rede_publica" type="checkbox" value="1" {{ old('pe_bitola_rede_publica', isset($visitaTecnica->pe_bitola_rede_publica) ? $visitaTecnica->pe_bitola_rede_publica : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('pe_bitola_rede_publica', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

