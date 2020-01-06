<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Procuração: Dados do outorgado</h4>
        <hr class="ruler-lg"/>
    </div>
<div class="form-group {{ $errors->has('procu_nome') ? 'has-error' : '' }}">
    <label for="procu_nome" class="col-md-2 control-label text-bold">Nome.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_nome" type="text" id="procu_nome" value="{{ old('procu_nome', isset($parametro->procu_nome) ? $parametro->procu_nome : null) }}" minlength="1" maxlength="200" required="true" placeholder="Enter nome here...">
        {!! $errors->first('procu_nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('procu_rg') ? 'has-error' : '' }}">
    <label for="procu_rg" class="col-md-2 control-label text-bold">Rg.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_rg" type="text" id="procu_rg" value="{{ old('procu_rg', isset($parametro->procu_rg) ? $parametro->procu_rg : null) }}" maxlength="10" placeholder="Enter rg here...">
        {!! $errors->first('procu_rg', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('procu_orgao_expeditor') ? 'has-error' : '' }}">
    <label for="procu_orgao_expeditor" class="col-md-2 control-label text-bold">Orgao Expeditor.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_orgao_expeditor" type="text" id="procu_orgao_expeditor" value="{{ old('procu_orgao_expeditor', isset($parametro->procu_orgao_expeditor) ? $parametro->procu_orgao_expeditor : null) }}" maxlength="10" placeholder="Enter orgao expeditor here...">
        {!! $errors->first('procu_orgao_expeditor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('procu_cpf') ? 'has-error' : '' }}">
    <label for="procu_cpf" class="col-md-2 control-label text-bold">Cpf.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_cpf" type="text" id="procu_cpf" value="{{ old('procu_cpf', isset($parametro->procu_cpf) ? $parametro->procu_cpf : null) }}" maxlength="20" placeholder="Enter cpf here...">
        {!! $errors->first('procu_cpf', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('procu_endereco') ? 'has-error' : '' }}">
    <label for="procu_endereco" class="col-md-2 control-label text-bold">Endereco.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_endereco" type="text" id="procu_endereco" value="{{ old('procu_endereco', isset($parametro->procu_endereco) ? $parametro->procu_endereco : null) }}" maxlength="200" placeholder="Enter endereco here...">
        {!! $errors->first('procu_endereco', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('procu_bairro') ? 'has-error' : '' }}">
    <label for="procu_bairro" class="col-md-2 control-label text-bold">Bairro.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_bairro" type="text" id="procu_bairro" value="{{ old('procu_bairro', isset($parametro->procu_bairro) ? $parametro->procu_bairro : null) }}" maxlength="100" placeholder="Enter bairro here...">
        {!! $errors->first('procu_bairro', '<p class="help-block">:message</p>') !!}
    </div>
</div>
    <div class="form-group {{ $errors->has('procu_estado') ? 'has-error' : '' }}">
        <label for="procu_estado" class="col-md-2 control-label text-bold">Estado.:*</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="procu_estado" type="text" id="procu_estado" value="{{ old('procu_estado', isset($parametro->procu_estado) ? $parametro->procu_estado : null) }}" maxlength="2" placeholder="Enter estado here...">
            {!! $errors->first('procu_estado', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
<div class="form-group {{ $errors->has('procu_cidade') ? 'has-error' : '' }}">
    <label for="procu_cidade" class="col-md-2 control-label text-bold">Cidade.:*</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="procu_cidade" type="text" id="procu_cidade" value="{{ old('procu_cidade', isset($parametro->procu_cidade) ? $parametro->procu_cidade : null) }}" maxlength="100" placeholder="Enter cidade here...">
        {!! $errors->first('procu_cidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>


</div>

