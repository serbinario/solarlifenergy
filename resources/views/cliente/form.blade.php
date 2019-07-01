<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    <div class="form-group">
        <label class="col-sm-2 control-label">Tipo Pessoa *</label>
        <div class="col-sm-10">
            <label class="radio-inline radio-styled radio-primary tipo_fisica">
                <input {{ isset($cliente->tipo) ? 'disabled' : '' }} id="tipo_fisica" class="tipoF" name="tipo" type="radio" value="Fisica" required="true" {{ old('tipo', isset($cliente->tipo) ? $cliente->tipo : null) == 'Fisica' ? 'checked' : '' }}>
                Fisica
            </label>
            <label class="radio-inline radio-styled radio-success tipo_juridico">
                <input {{ isset($cliente->tipo) ? 'disabled' : '' }} id="tipo_juridico" class="tipoJ" name="tipo" type="radio" value="Juridico" required="true" {{ old('tipo', isset($cliente->tipo) ? $cliente->tipo : null) == 'Juridico' ? 'checked' : '' }}>
                Juridico
            </label>
        </div><!--end .col -->
    </div><!--end .form-group -->
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($cliente->nome) ? $cliente->nome : null) }}" maxlength="255" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">Telefone: *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="celular" type="text" id="celular" value="{{ old('celular', isset($cliente->celular) ? $cliente->celular : null) }}" maxlength="20" placeholder="Enter celular here...">
                    {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('data_nascimento') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">É Whatsapp?</label>
                <div class="col-md-8">
                    <div class="checkbox checkbox-styled">
                        <label for="is_whatsapp">
                            <input id="is_whatsapp" class="input-sm" name="is_whatsapp" type="checkbox" value="1" {{ old('is_whatsapp', isset($cliente->is_whatsapp) ? $cliente->is_whatsapp : null) == '1' ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="email" type="text" id="email" value="{{ old('email', isset($cliente->email) ? $cliente->email : null) }}" maxlength="100" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nome_empresa') ? 'has-error' : '' }}">
    <label for="nome_empresa" class="col-md-2 control-label">Nome Empresa</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="nome_empresa" type="text" id="nome_empresa" value="{{ old('nome_empresa', isset($cliente->nome_empresa) ? $cliente->nome_empresa : null) }}" maxlength="255" placeholder="Enter nome empresa here...">
        {!! $errors->first('nome_empresa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
    <div class="form-group {{ $errors->has('cpf_cnpj') ? 'has-error' : '' }}">
        <label for="cpf_cnpj" class="col-md-2 control-label">CPF/CNPJ</label>
        <div class="col-md-10">
            <input class="form-control mascara-cpfcnpj input-sm" name="cpf_cnpj" type="text" id="cpf_cnpj" value="{{ old('cpf_cnpj', isset($cliente->cpf_cnpj) ? $cliente->cpf_cnpj : null) }}" maxlength="255" placeholder="CPF/CNPJ...">
            {!! $errors->first('cpf_cnpj', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Endereço</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>



<div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }}">
    <label for="cep" class="col-md-2 control-label">Cep</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="cep" type="text" id="cep" value="{{ old('cep', isset($cliente->cep) ? $cliente->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    <div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }}">
        <label for="endereco" class="col-md-2 control-label">Endereco</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="endereco" type="text" id="endereco" value="{{ old('endereco', isset($cliente->endereco) ? $cliente->endereco : null) }}" maxlength="200" placeholder="Enter endereco here...">
            {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

<div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }}">
    <label for="numero" class="col-md-2 control-label">Numero</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="numero" type="text" id="numero" value="{{ old('numero', isset($cliente->numero) ? $cliente->numero : null) }}" maxlength="10" placeholder="Enter numero here...">
        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }}">
    <label for="complemento" class="col-md-2 control-label">Complemento</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="complemento" type="text" id="complemento" value="{{ old('complemento', isset($cliente->complemento) ? $cliente->complemento : null) }}" maxlength="200" placeholder="Enter complemento here...">
        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
    <label for="estado" class="col-md-2 control-label">Estado</label>
    <div class="col-md-10">
        <input class="form-control input-sm" name="estado" type="text" id="estado" value="{{ old('estado', isset($cliente->estado) ? $cliente->estado : null) }}" maxlength="2" placeholder="Enter estado here...">
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="col-md-2 control-label">Obs</label>
    <div class="col-md-10">
        <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($cliente->obs) ? $cliente->obs : null) }}</textarea>
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

