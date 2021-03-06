<div class="card-body">


    <div class="row">
        <div class="col-sm-6">
            @if(isset($preProposta->cliente->nome))
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="nome" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($preProposta->cliente->cep) ? $preProposta->cliente->cep : null) }}" >
                    <input name="id" type="hidden" id="id" value="{{ old('cep', isset($preProposta->id) ? $preProposta->id : null) }}" >
                    <input type="hidden" id="valor_franqueadora" value="{{ old('valor_franqueadora', isset($preProposta->valor_franqueadora) ? $preProposta->valor_franqueadora : null) }}" >

                    <input name="total_equipamentos" type="hidden" id="total_equipamentos" value="{{ old('total_equipamentos', isset($preProposta->total_equipamentos) ? $preProposta->total_equipamentos : null) }}" >
                    <input name="total_servico_operacional" type="hidden" id="total_servico_operacional" value="{{ old('total_servico_operacional', isset($preProposta->total_servico_operacional) ? $preProposta->total_servico_operacional : null) }}" >

                    <input name="cliente_id" type="hidden" id="cliente_id" value="{{ old('id', isset($preProposta->cliente->id) ? $preProposta->cliente->id : null) }}" >
                    <input name="estado" type="hidden" id="estado" value="{{ old('estado', isset($preProposta->cliente->estado) ? $preProposta->cliente->estado : null) }}" >
                    <input name="user_id" type="hidden" id="user_id" value="{{  isset($preProposta->user_id) ? $preProposta->user_id : null }}" >
                    <input name="prioridade_id" type="hidden" id="prioridade_id" value="{{  isset($preProposta->prioridade_id) ? $preProposta->prioridade_id : null }}" >

                    <div class="col-md-8">
                        <input class="form-control input-sm" name="nome_empresa" type="text" id="nome_empresa" value="{{ old('nome', isset($preProposta->cliente->nome_empresa) ? $preProposta->cliente->nome_empresa : null) }}" readonly >
                    </div>
                </div>
            @else
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="cliente_id" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <div class="col-md-8">
                        <select name="cliente_id" class="form-control select2_clientes" data-placeholder="Selecione">
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="data_validade" class="col-sm-5 control-label text-bold">Data Validade.:</label>
                <div class="col-md-7">
                    <input class="form-control input-sm date" name="data_validade" type="text" id="data_validade" value="{{ old('data_validade', isset($preProposta->data_validade) ? $preProposta->data_validade : null) }}">
                </div>
            </div>
        </div>
        @if(isset($preProposta->cliente->nome))
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="codigo" class="col-sm-4 control-label text-bold">Codigo.:</label>
                    <div class="col-md-8">
                        <input class="form-control input-sm" name="codigo" type="number" id="codigo" readonly value="{{ old('codigo', isset($preProposta->codigo) ? $preProposta->codigo : null) }}" >
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group {{ $errors->has('monthly_usage') ? 'has-error' : '' }}">
                <label for="monthly_usage" class="col-sm-6 control-label text-bold">Média consumo Kwh.:*</label>
                <div class="col-md-6">
                    <input class="form-control input-sm numberWithoutDot" name="monthly_usage" type="text" id="monthly_usage" value="{{ old('monthly_usage', isset($preProposta->monthly_usage) ? $preProposta->monthly_usage : null) }}" maxlength="10" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group {{ $errors->has('preco_kwh') ? 'has-error' : '' }}">
                <label for="preco_kwh" class="col-sm-6 control-label text-bold">Preço do KWh R$.:*</label>
                <div class="col-md-4">
                    <input class="form-control input-sm 7 kwh " name="preco_kwh" type="text" id="preco_kwh" value="{{ old('preco_kwh', isset($preProposta->preco_kwh) ? $preProposta->preco_kwh : "0.8000") }}" maxlength="10" placeholder="#,####">

                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group {{ $errors->has('modulo_id') ? 'has-error' : '' }}">
                <label for="modulo_id" class="col-sm-8 control-label text-bold">Painel Potência.:*</label>
                <div class="col-md-4">
                    <select   class="form-control input-sm" id="modulo_id" name="modulo_id">
                        @foreach ($modulos as $key => $modulo)
                            <option value="{{ $key }}" {{ old('modulo_id', isset($preProposta->modulo_id) ? $preProposta->modulo_id : null) == $key ? 'selected' : '' }}>
                                {{ $modulo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>

     <div class="row">
        <div class="col-sm-3">
            <div class="form-group {{ $errors->has('estado_id') ? 'has-error' : '' }}">
                <label for="estado_id" class="col-sm-4 control-label text-bold">Estado:*</label>
                <div class="col-md-8">
                    <select   class="form-control input-sm" id="estado_id" name="estado_id">
                        <option value="" style="display: none;" {{ old('users_id', isset($preProposta->cidade->estado_id) ? $preProposta->cidade->estado_id : '') == '' ? 'selected' : '' }} disabled selected>Estado</option>
                        @foreach ($estados as $key => $estado)
                            <option value="{{ $key }}" {{ old('estado_id', isset($preProposta->cidade->estado_id) ? $preProposta->cidade->estado_id : null) == $key ? 'selected' : '' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group {{ $errors->has('cidade_id') ? 'has-error' : '' }}">
                <label for="cidade_id" class="col-sm-4 control-label text-bold">Cidade.:*</label>
                <div class="col-md-8">
                    <select   class="form-control input-sm" id="cidade_id" name="cidade_id">
                        <option value="" style="display: none;" {{ old('cidade_id', isset($preProposta->cidade_id) ? $preProposta->cidade_id : '') == '' ? 'selected' : '' }} disabled selected>Cidade</option>
                        @foreach ($cidades as $key => $cidade)
                            <option value="{{ $key }}" {{ old('cidade_id', isset($preProposta->cidade_id) ? $preProposta->cidade_id : null) == $key ? 'selected' : '' }}>
                                {{ $cidade }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
         @role('franquia|super-admin')
         <div class="col-sm-3">
             <div class="form-group {{ $errors->has('cidade_id') ? 'has-error' : '' }}">
                 <label for="user_id" class="col-sm-4 control-label text-bold">Integrador.:</label>
                 <div class="col-md-8">
                     <select   class="form-control input-sm" id="user_id" name="user_id">
                         <option value="" style="display: none;" {{ old('user_id', isset($preProposta->user_id) ? $preProposta->user_id : '') == '' ? 'selected' : '' }} disabled selected>Intergrador</option>
                         @foreach ($users as $key => $user)
                             <option value="{{ $key }}" {{ old('user_id', isset($preProposta->user_id) ? $preProposta->user_id : null) == $key ? 'selected' : '' }}>
                                 {{ $user }}
                             </option>
                         @endforeach
                     </select>
                 </div>
             </div>
         </div>
         @else
         <div class="col-sm-3">
             <div class="form-group">
                 <label for="user_id" class="col-sm-4 control-label text-bold">Prioridade.:</label>
                 <div class="col-md-8">
                     <select   class="form-control input-sm" id="prioridade_id" name="prioridade_id">
                         <option value="" style="display: none;" {{ old('prioridade_id', isset($preProposta->prioridade_id) ? $preProposta->prioridade_id : '') == '' ? 'selected' : '' }} disabled selected>Prioridade</option>
                         @foreach ($prioridades as $key => $prioridade)
                             <option value="{{ $key }}" {{ old('prioridade_id', isset($preProposta->prioridade_id) ? $preProposta->prioridade_id : null) == $key ? 'selected' : '' }}>
                                 {{ $prioridade }}
                             </option>
                         @endforeach
                     </select>
                 </div>
             </div>
         </div>

             <div class="col-sm-3">
                 <div class="form-group">
                     <label for="" class="col-sm-4 control-label text-bold">Intergrador.:</label>
                     <div class="col-md-8">
                         <input class="form-control input-sm" type="text" readonly value="{{  isset($preProposta->user->name) ? $preProposta->user->name : null }}" >
                     </div>
                 </div>
             </div>
         @endrole
    </div>



</div>

