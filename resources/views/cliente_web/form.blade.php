
<div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
    <label for="tipo" class="col-md-2 control-label">Tipo</label>
    <div class="col-md-10">
        <select class="form-control" id="tipo" name="tipo">
            <option value="" style="display: none;" {{ old('tipo', isset($clienteWeb->tipo) ? $clienteWeb->tipo : '') == '' ? 'selected' : '' }} disabled selected>Enter tipo here...</option>
            @foreach (['Juridico' => 'Juridico',
'Fisica' => 'Fisica'] as $key => $text)
                <option value="{{ $key }}" {{ old('tipo', isset($clienteWeb->tipo) ? $clienteWeb->tipo : null) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome *</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($clienteWeb->nome) ? $clienteWeb->nome : null) }}" maxlength="255" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
    <label for="cpf_cnpj" class="col-md-2 control-label">Cpf Cnpj *</label>
    <div class="col-md-10">
        <input class="form-control mascara-cpfcnpj" name="cpf_cnpj" type="text" id="cpf_cnpj" value="{{ old('cpf_cnpj', isset($clienteWeb->cpf_cnpj) ? $clienteWeb->cpf_cnpj : null) }}" maxlength="20" placeholder="Enter cpf cnpj here...">
        {!! $errors->first('cpf_cnpj', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nome_empresa') ? 'has-error' : '' }}">
    <label for="nome_empresa" class="col-md-2 control-label">Rasão Social</label>
    <div class="col-md-10">
        <input class="form-control" name="nome_empresa" type="text" id="nome_empresa" value="{{ old('nome_empresa', isset($clienteWeb->nome_empresa) ? $clienteWeb->nome_empresa : null) }}" maxlength="255" placeholder="Enter nome empresa here...">
        {!! $errors->first('nome_empresa', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('celular') ? 'has-error' : '' }}">
    <label for="celular" class="col-md-2 control-label">Celular *</label>
    <div class="col-md-10">
        <input class="form-control" name="celular" type="text" id="celular" value="{{ old('celular', isset($clienteWeb->celular) ? $clienteWeb->celular : null) }}" maxlength="20" placeholder="Enter celular here...">
        {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_whatsapp') ? 'has-error' : '' }}">
    <label for="is_whatsapp" class="col-md-2 control-label">Is Whatsapp</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_whatsapp_1">
                <input id="is_whatsapp_1" class="" name="is_whatsapp" type="checkbox" value="1" {{ old('is_whatsapp', isset($clienteWeb->is_whatsapp) ? $clienteWeb->is_whatsapp : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_whatsapp', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('consumo') ? 'has-error' : '' }}">
    <label for="consumo" class="col-md-2 control-label">Consumo *</label>
    <div class="col-md-10">
        <select class="form-control input-sm" id="consumo" name="consumo">
            <option value="" style="display: none;" {{ old('consumo', isset($projeto->consumo) ? $projeto->consumo : '') == '' ? 'selected' : '' }} disabled selected>Enter consumo here...</option>
            @foreach (['30 - 100' => '30 - 100',
'110 - 300' => '110 - 300',
'350 - 600' => '350 - 600',
'700 - 1.000' => '700 - 1.000',
'1.100 - 1.500' => '1.100 - 1.500',
'1.900 - 5.000' => '1.900 - 5.000',
'6.000 - 8.000' => '6.000 - 8.000',
'ACIMA DE 10.000' => 'ACIMA DE 10.000'] as $key => $text)
                <option value="{{ $key }}" {{ old('consumo', isset($projeto->consumo) ? $projeto->consumo : null) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('consumo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email *</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', isset($clienteWeb->email) ? $clienteWeb->email : null) }}" maxlength="100" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }}">
    <label for="cep" class="col-md-2 control-label">Cep *</label>
    <div class="col-md-10">
        <input class="form-control" name="cep" type="text" id="cep" value="{{ old('cep', isset($clienteWeb->cep) ? $clienteWeb->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
    </div>
</div>







