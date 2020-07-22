<div class="card-body">
    <div class="form-group {{ $errors->has('data_validade') ? 'has-error' : '' }}">
        <label for="data_validade" class="col-md-2 control-label text-bold">Produto.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="produto" type="text" id="produto" value="{{ old('produto', isset($produto->produto) ? $produto->produto : null) }}" placeholder="">
            {!! $errors->first('data_validade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('outorgante') ? 'has-error' : '' }}">
        <label for="unidade_id" class="col-md-2 control-label text-bold">Unidade.:</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="unidade_id" name="unidade_id">
                <option value="" style="display: none;" {{ old('unidade_id', isset($produto->unidade_id) ? $produto->unidade_id : '') == '' ? 'selected' : '' }} disabled selected>Unidade</option>
                @foreach ($unidades as $key => $unidade)
                    <option value="{{ $key }}" {{ old('unidade_id', isset($produto->unidade_id) ? $produto->unidade_id : null) == $key ? 'selected' : '' }}>
                        {{ $unidade }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-group {{ $errors->has('rg') ? 'has-error' : '' }}">
        <label for="preco" class="col-md-2 control-label text-bold">Preço.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm money" name="preco" type="text" id="preco" value="{{ old('preco', isset($produto->preco) ? $produto->preco : null) }}" maxlength="20" placeholder="Enter rg here...">
            {!! $errors->first('rg', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('orgao_expeditor') ? 'has-error' : '' }}">
        <label for="estoque" class="col-md-2 control-label text-bold">Estoque.:</label>
        <div class="col-md-10">
            <input class="form-control input-sm numberWithoutDot" name="estoque" type="text" id="estoque" value="{{ old('estoque', isset($produto->estoque) ? $produto->estoque : null) }}" maxlength="10" placeholder="Enter orgao expeditor here...">
            {!! $errors->first('orgao_expeditor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
        <label for="cpf" class="col-md-2 control-label text-bold">Grupo.:</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="grupo_id" name="grupo_id">
                <option value="" style="display: none;" {{ old('grupo_id', isset($produto->grupo_id) ? $produto->grupo_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione uma Tabela de Preço</option>
                @foreach ($grupos as $key => $grupo)
                    <option value="{{ $key }}" {{ old('grupo_id', isset($produto->grupo_id) ? $produto->grupo_id : null) == $key ? 'selected' : '' }}>
                        {{ $grupo }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('marca') ? 'has-error' : '' }}">
        <label for="marca" class="col-md-2 control-label text-bold">Fabricante.:</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="marca_id" name="marca_id">
                <option value="" style="display: none;" {{ old('marca_id', isset($produto->marca_id) ? $produto->marca_id : '') == '' ? 'selected' : '' }} disabled selected>Selecione uma Tabela de Preço</option>
                @foreach ($marcas as $key => $marca)
                    <option value="{{ $key }}" {{ old('marca_id', isset($produto->marca_id) ? $produto->marca_id : null) == $key ? 'selected' : '' }}>
                        {{ $marca }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>



</div>

