<div class="card-body">


    <div class="row">
        <div class="col-sm-6">
            @if(isset($preProposta->cliente->nome))
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="nome" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($preProposta->cliente->cep) ? $preProposta->cliente->cep : null) }}" >
                    <input name="id" type="hidden" id="id" value="{{ old('cep', isset($preProposta->id) ? $preProposta->id : null) }}" >
                    <input type="hidden" id="valor_franqueadora" value="{{ old('valor_franqueadora', isset($preProposta->valor_franqueadora) ? $preProposta->valor_franqueadora : null) }}" >

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
                        @if(isset($preProposta->id))
                            <input readonly class="form-control input-sm numberWithoutDot" name="monthly_usage" type="text" id="monthly_usage" value="{{ old('monthly_usage', isset($preProposta->monthly_usage) ? $preProposta->monthly_usage : null) }}" maxlength="10" placeholder="">
                        @else
                            <input class="form-control input-sm numberWithoutDot" name="monthly_usage" type="text" id="monthly_usage" value="{{ old('monthly_usage', isset($preProposta->monthly_usage) ? $preProposta->monthly_usage : null) }}" maxlength="10" placeholder="">
                        @endif
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
         <div class="col-sm-3">
             <div class="form-group">
                 <label for="user_id" class="col-sm-4 control-label text-bold">Prioridade.:</label>
                 <div class="col-md-8">
                     <select   class="form-control input-sm" id="prioridade_id" name="prioridade_id">
                         @foreach ($prioridades as $key => $prioridade)
                             <option value="{{ $key }}" {{ old('prioridade_id', isset($preProposta->prioridade_id) ? $preProposta->prioridade_id : null) == $key ? 'selected' : '' }}>
                                 {{ $prioridade }}
                             </option>
                         @endforeach
                     </select>
                 </div>
             </div>
         </div>
         @else


             <div class="col-sm-3">
                 <div class="form-group">
                     <label for="" class="col-sm-4 control-label text-bold">Intergrador.:</label>
                     <div class="col-md-8">
                         <input class="form-control input-sm" type="text" readonly value="{{  isset($preProposta->user->name) ? $preProposta->user->name : null }}" >
                     </div>
                 </div>
             </div>
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
         @endrole
    </div>

    <!--Acordion -->
<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion2">
            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-1">
                    <header class="text-bold">Histórico de consumo</header>
                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="accordion2-1" class="collapse">
                    <div class="card-body">
                        <!-- tab -->
                            <div class="card-head">
                    <ul class="nav nav-tabs pull-left" data-toggle="tabs">
                        <li class="active"><a href="#fora-da-ponta">Fora da ponta</a></li>
                        <li><a href="#second2">Na ponta</a></li>
                    </ul>

                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="fora-da-ponta">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('jan') ? 'has-error' : '' }}">
                                    <label for="jan" class="col-sm-4 control-label text-bold">Jan.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="jan" type="text" id="jan" value="{{ old('minimum_area', isset($preProposta->jan) ? $preProposta->jan : null) }}" maxlength="10" placeholder="">
                                        {!! $errors->first('jan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('feb') ? 'has-error' : '' }}">
                                    <label for="feb" class="col-sm-4 control-label text-bold">Fev.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="feb" type="text" id="feb" value="{{ old('feb', isset($preProposta->feb) ? $preProposta->feb : null) }}" placeholder="" step="any">
                                        {!! $errors->first('feb', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('mar') ? 'has-error' : '' }}">
                                    <label for="mar" class="col-sm-4 control-label text-bold">Mar.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="mar" type="text" id="mar" value="{{ old('mar', isset($preProposta->mar) ? $preProposta->mar : null) }}" placeholder="" step="any">
                                        {!! $errors->first('mar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('apr') ? 'has-error' : '' }}">
                                    <label for="apr" class="col-sm-4 control-label text-bold">Abr.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="apr" type="text" id="apr" value="{{ old('apr', isset($preProposta->apr) ? $preProposta->apr : null) }}" placeholder="" step="any">
                                        {!! $errors->first('apr', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('may') ? 'has-error' : '' }}">
                                    <label for="may" class="col-sm-4 control-label text-bold">Mai.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  fora-da-ponta numberWithoutDot" name="may" type="text" id="may" value="{{ old('may', isset($preProposta->may) ? $preProposta->may : null) }}" maxlength="10" placeholder="">
                                        {!! $errors->first('may', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('jun') ? 'has-error' : '' }}">
                                    <label for="jun" class="col-sm-4 control-label text-bold">Jun.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="jun" type="text" id="jun" value="{{ old('jun', isset($preProposta->jun) ? $preProposta->jun : null) }}" placeholder="" step="any">
                                        {!! $errors->first('jun', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('jul') ? 'has-error' : '' }}">
                                    <label for="jul" class="col-sm-4 control-label text-bold">Jul.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="jul" type="text" id="jul" value="{{ old('jul', isset($preProposta->jul) ? $preProposta->jul : null) }}" placeholder="" step="any">
                                        {!! $errors->first('jul', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('aug') ? 'has-error' : '' }}">
                                    <label for="aug" class="col-sm-4 control-label  text-bold">Ago.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  fora-da-ponta numberWithoutDot" name="aug" type="text" id="aug" value="{{ old('aug', isset($preProposta->aug) ? $preProposta->aug : null) }}" placeholder="" step="any">
                                        {!! $errors->first('aug', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('sep') ? 'has-error' : '' }}">
                                    <label for="sep" class="col-sm-4 control-label text-bold">Set.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  fora-da-ponta numberWithoutDot" name="sep" type="text" id="sep" value="{{ old('sep', isset($preProposta->sep) ? $preProposta->sep : null) }}" maxlength="10" placeholder="">
                                        {!! $errors->first('sep', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('oct') ? 'has-error' : '' }}">
                                    <label for="oct" class="col-sm-4 control-label text-bold">Out.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="oct" type="text" id="oct" value="{{ old('oct', isset($preProposta->oct) ? $preProposta->oct : null) }}" placeholder="" step="any">
                                        {!! $errors->first('oct', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('nov') ? 'has-error' : '' }}">
                                    <label for="nov" class="col-sm-4 control-label text-bold">Nov.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm fora-da-ponta numberWithoutDot" name="nov" type="text" id="nov" value="{{ old('nov', isset($preProposta->nov) ? $preProposta->nov : null) }}" placeholder="" step="any">
                                        {!! $errors->first('nov', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('dec') ? 'has-error' : '' }}">
                                    <label for="dec" class="col-sm-4 control-label text-bold">Dez.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  fora-da-ponta numberWithoutDot" name="dec" type="text" id="dec" value="{{ old('dec', isset($preProposta->dec) ? $preProposta->dec : null) }}" placeholder="" step="any">
                                        {!! $errors->first('dec', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-sm btn-primary"  id="calcular_media" type="button" value="Calcular Média">
                        <input class="btn btn-sm btn-primary"  id="copiar_media" type="button" value="Copiar Média de Consumo para Meses">
                    </div>
                    <div class="tab-pane" id="second2">

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_jan') ? 'has-error' : '' }}">
                                    <label for="na_ponta_jan" class="col-sm-4 control-label text-bold">Jan.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_jan" type="text" id="na_ponta_jan" value="{{ old('minimum_area', isset($preProposta->na_ponta_jan) ? $preProposta->na_ponta_jan : null) }}" maxlength="10" placeholder="">
                                        {!! $errors->first('na_ponta_jan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_feb') ? 'has-error' : '' }}">
                                    <label for="na_ponta_feb" class="col-sm-4 control-label text-bold">Fev.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_feb" type="text" id="na_ponta_feb" value="{{ old('na_ponta_feb', isset($preProposta->na_ponta_feb) ? $preProposta->na_ponta_feb : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_feb', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_mar') ? 'has-error' : '' }}">
                                    <label for="na_ponta_mar" class="col-sm-4 control-label text-bold">Mar.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_mar" type="text" id="na_ponta_mar" value="{{ old('na_ponta_mar', isset($preProposta->na_ponta_mar) ? $preProposta->na_ponta_mar : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_mar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_apr') ? 'has-error' : '' }}">
                                    <label for="na_ponta_apr" class="col-sm-4 control-label text-bold">Abr.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_apr" type="text" id="na_ponta_apr" value="{{ old('na_ponta_apr', isset($preProposta->na_ponta_apr) ? $preProposta->na_ponta_apr : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_apr', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_may') ? 'has-error' : '' }}">
                                    <label for="na_ponta_may" class="col-sm-4 control-label text-bold">Mai.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_may" type="text" id="na_ponta_may" value="{{ old('na_ponta_may', isset($preProposta->na_ponta_may) ? $preProposta->na_ponta_may : null) }}" maxlength="10" placeholder="">
                                        {!! $errors->first('na_ponta_may', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_jun') ? 'has-error' : '' }}">
                                    <label for="na_ponta_jun" class="col-sm-4 control-label text-bold">Jun.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_jun" type="text" id="na_ponta_jun" value="{{ old('na_ponta_jun', isset($preProposta->na_ponta_jun) ? $preProposta->na_ponta_jun : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_jun', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_jul') ? 'has-error' : '' }}">
                                    <label for="na_ponta_jul" class="col-sm-4 control-label text-bold">Jul.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_jul" type="text" id="na_ponta_jul" value="{{ old('na_ponta_jul', isset($preProposta->na_ponta_jul) ? $preProposta->na_ponta_jul : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_jul', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_aug') ? 'has-error' : '' }}">
                                    <label for="na_ponta_aug" class="col-sm-4 control-label text-bold">Ago.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_aug" type="text" id="na_ponta_aug" value="{{ old('na_ponta_aug', isset($preProposta->na_ponta_aug) ? $preProposta->na_ponta_aug : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_aug', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_sep') ? 'has-error' : '' }}">
                                    <label for="na_ponta_sep" class="col-sm-4 control-label text-bold">Set.::</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_sep" type="text" id="na_ponta_sep" value="{{ old('na_ponta_sep', isset($preProposta->na_ponta_sep) ? $preProposta->na_ponta_sep : null) }}" maxlength="10" placeholder=".">
                                        {!! $errors->first('na_ponta_sep', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_oct') ? 'has-error' : '' }}">
                                    <label for="na_ponta_oct" class="col-sm-4 control-label text-bold">Out.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_oct" type="text" id="na_ponta_oct" value="{{ old('na_ponta_oct', isset($preProposta->na_ponta_oct) ? $preProposta->na_ponta_oct : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_oct', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_nov') ? 'has-error' : '' }}">
                                    <label for="na_ponta_nov" class="col-sm-4 control-label text-bold">Nov.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_nov" type="text" id="na_ponta_nov" value="{{ old('na_ponta_nov', isset($preProposta->na_ponta_nov) ? $preProposta->na_ponta_nov : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_nov', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"{{ $errors->has('na_ponta_dec') ? 'has-error' : '' }}">
                                    <label for="na_ponta_dec" class="col-sm-4 control-label text-bold">Dez.:</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm  numberWithoutDot" name="na_ponta_dec" type="text" id="na_ponta_dec" value="{{ old('na_ponta_dec', isset($preProposta->na_ponta_dec) ? $preProposta->na_ponta_dec : null) }}" placeholder="" step="any">
                                        {!! $errors->first('na_ponta_dec', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                        <!-- end tab -->

                    </div>
                </div>
            </div><!--end .panel -->

    @if(isset($preProposta->id))
            <div class="card panel expanded">
                <div class="card-head card-head-xs" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-3">
                    <header class="text-bold">Detalhamento dos equipamentos</header>
                    <div class="col-6 total_equipamentos">
												<span class=" badge badge-dark float-right-12">
														R$
												</span>
                    </div>
                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="accordion2-3" class="collapse in">
                    <div class="card-body">
                        <table class="table table table-condensed no-margin">
                            <thead>
                            <tr>
                                <th>PRODUTO</th>
                                <th>QTD</th>
                                <th>PREÇO UNIT. COM PIS-COFINS-ICMS</th>
                                <th>VALOR NF-E</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><input class="form-control input-sm" name="produto1" type="text" id="produto1" value="{{ old('produto1', isset($preProposta->produto1) ? $preProposta->produto1 : "MÓDULO FV DAH") }}" min="0" max="10" placeholder="Nome do módulo"></td>
                                    <td><input  readonly class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" value="{{ old('qtd_paineis', isset($preProposta->qtd_paineis) ? $preProposta->qtd_paineis : null) }}" min="0" max="10" placeholder="Quantidade de módulos"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm money" name="produto1_preco" type="text" id="produto1_preco" value="{{ old('produto1_preco', isset($preProposta->produto1_preco) ? $preProposta->produto1_preco : null) }}" min="0" max="10" placeholder="Preço do Módulo"></td>
                                    <td><input readonly class="form-control input-sm money" name="produto1_nf" type="text" id="produto1_nf" value="{{ old('produto1_nf', isset($preProposta->produto1_nf) ? $preProposta->produto1_nf : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control input-sm" name="produto2" type="text" id="produto2" value="{{ old('produto2', isset($preProposta->produto2) ? $preProposta->produto2 : "INVERSOR KSTAR") }}" min="0" max="10" placeholder="Nome do inversor"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm" name="qtd_inversores" type="text" id="qtd_inversores" value="{{ old('qtd_inversores', isset($preProposta->qtd_inversores) ? $preProposta->qtd_inversores : '1') }}" min="0" max="10" placeholder="Quantidade de Inversores"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm money" name="produto2_preco" type="text" id="produto2_preco" value="{{ old('produto2_preco', isset($preProposta->produto2_preco) ? $preProposta->produto2_preco : null) }}" min="0" max="10" placeholder="Preço do Módulo"></td>
                                    <td><input readonly class="form-control input-sm money" name="produto2_nf" type="text" id="produto2_nf" value="{{ old('produto2_nf', isset($preProposta->produto2_nf) ? $preProposta->produto2_nf : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td><input class="form-control input-sm" name="produto3" type="text" id="produto3" value="{{ old('produto3', isset($preProposta->produto3) ? $preProposta->produto3 : "ESTRUTURA") }}" min="0" max="10" placeholder="Estrutura"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm" name="qtd_estrutura" type="text" id="qtd_estrutura" value="{{ old('qtd_estrutura', isset($preProposta->qtd_estrutura) ? $preProposta->qtd_estrutura : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm money" name="produto3_preco" type="text" id="produto3_preco" value="{{ old('produto3_preco', isset($preProposta->produto3_preco) ? $preProposta->produto3_preco : null) }}" min="0" max="10" placeholder="Preço da Estrutura"></td>
                                    <td><input readonly class="form-control input-sm money" name="produto3_nf" type="text" id="produto3_nf" value="{{ old('produto3_nf', isset($preProposta->produto3_nf) ? $preProposta->produto3_nf : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control input-sm" name="produto4" type="text" id="produto4" value="{{ old('produto4', isset($preProposta->produto4) ? $preProposta->produto4 : "STRING BOX") }}" min="0" max="10" placeholder="Nome do inversor"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm" name="qtd_string_box" type="text" id="qtd_string_box" value="{{ old('qtd_mqtd_string_boxud_pde', isset($preProposta->qtd_string_box) ? $preProposta->qtd_string_box : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                    <td><input  {{ Auth::user()->id == 17? null : 'readonly' }} class="form-control input-sm money" name="produto4_preco" type="text" id="produto4_preco" value="{{ old('produto4_preco', isset($preProposta->produto4_preco) ? $preProposta->produto4_preco : null) }}" min="0" max="10" placeholder="Preço do String Box"></td>
                                    <td><input readonly class="form-control input-sm money" name="produto4_nf" type="text" id="produto4_nf" value="{{ old('produto4_nf', isset($preProposta->produto4_nf) ? $preProposta->produto4_nf : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control input-sm" name="produto5" type="text" id="produto5" value="{{ old('produto5', isset($preProposta->produto5) ? $preProposta->produto5 : "KIT MONITORAMENTO WIFI") }}" min="0" max="10" placeholder="Nome do inversor"></td>
                                    <td><input {{ Auth::user()->id == 17? null : 'readonly' }} readonly class="form-control input-sm" name="qtd_kit_monitoramento" type="text" id="qtd_kit_monitoramento" value="{{ old('qtd_kit_monitoramento', isset($preProposta->qtd_kit_monitoramento) ? $preProposta->qtd_kit_monitoramento : '1') }}" min="0" max="10" placeholder="Quantidade de kit inversores"></td>
                                    <td><input {{ Auth::user()->id == 17? null : 'readonly' }} readonly class="form-control input-sm money" name="produto5_preco" type="text" id="produto5_preco" value="{{ old('produto5_preco', isset($preProposta->produto5_preco) ? $preProposta->produto5_preco : null) }}" min="0" max="10" placeholder="Preço do kit monitoramento"></td>
                                    <td><input readonly class="form-control input-sm money" name="produto5_nf" type="text" id="produto5_nf" value="{{ old('produto5_nf', isset($preProposta->produto5_nf) ? $preProposta->produto5_nf : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>
                               {{-- <tr>
                                    <td colspan="3"><input readonly style="text-align:right; padding-right: 20px;" class="form-control input-sm" value="DESCONTOS"></td>
                                    <td><input  class="form-control input-sm money" name="desconto_equipamentos" type="text" id="desconto_equipamentos" value="{{ old('desconto_equipamentos', isset($preProposta->desconto_equipamentos) ? $preProposta->desconto_equipamentos : null) }}" min="0" max="10" placeholder="Desconto"></td>
                                </tr>--}}
                                <tr>
                                    <td colspan="3"><input readonly style="text-align:right; padding-right: 20px;" class="form-control input-sm" value="TOTAL"></td>
                                    <td><input readonly class="form-control input-sm money" name="total_equipamentos" type="text" id="total_equipamentos" value="{{ old('total_equipamentos', isset($preProposta->total_equipamentos) ? $preProposta->total_equipamentos : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="text-align:right; padding-right: 20px;">PARTICIPAÇÃO</td>
                                    <td><input  class="form-control input-sm money" name="valor_franquia" type="text" id="valor_franquia" value="{{ old('valor_franquia', isset($preProposta->valor_franquia) ? $preProposta->valor_franquia : null) }}" min="0" max="10" placeholder="Desconto"></td>

                                </tr>

                                <tr>
                                    <td colspan="3" style="text-align:right; padding-right: 20px;">EQUIPE TÉCNICA</td>
                                    <td><input  readonly class="form-control input-sm money" name="equipe_tecnica" type="text" id="equipe_tecnica" value="{{ old('equipe_tecnica', isset($preProposta->equipe_tecnica) ? $preProposta->equipe_tecnica : null) }}" min="0" max="10" placeholder="Desconto"></td>
                                </tr>

                                <tr>
                                    <td  colspan="3" style="display: none;" style="text-align:right; padding-right: 20px;">PREÇO DO MÓDULO</td>
                                    <td  ><input  style="display: none;" class="form-control input-sm money" name="valor_modulo" type="text" id="valor_modulo" value="{{ old('valor_modulo', isset($preProposta->valor_modulo) ? $preProposta->valor_modulo : null) }}" min="0" max="10" placeholder="Preço Módulo"></td>
                                </tr>




                            </tbody>
                        </table>

                        <div style="text-align: center; display: none" >
                            <spa  > Obs: O Valor da PARTICIPAÇÃO será descontado 8% </spa>
                        </div>



                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-2">
                    <header class="text-bold">Serviços Operacionais</header>
                    <div class="col-6 total_servico_operacional">
												<span class=" badge badge-dark float-right-12">
														R$
												</span>
                    </div>

                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="accordion2-2" class="collapse">
                    <div class="card-body">

                        <table class="table table table-condensed no-margin">
                            <thead>
                            <tr>
                                <th>SERVIÇO</th>
                                <th>QTD</th>
                                <th>PREÇO UNIT. COM PIS-COFINS-ICMS</th>
                                <th>VALOR NF-E</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--<tr>--}}
                                {{--<td>HOMOLOGAÇÃO PROJETO</td>--}}
                                {{--<td><input class="form-control input-sm" name="qtd_homologacao_projeto" type="text" id="qtd_homologacao_projeto" value="{{ old('qtd_homologacao_projeto', isset($preProposta->qtd_homologacao_projeto) ? $preProposta->qtd_homologacao_projeto : "1") }}" min="0" max="10" placeholder="HOMOLOGAÇÃO PROJETO"></td>--}}
                                {{--<td><input class="form-control input-sm money" name="produto12_preco" type="text" id="produto12_preco" value="{{ old('produto12_preco', isset($preProposta->produto12_preco) ? $preProposta->produto12_preco : "0") }}" min="0" max="10" placeholder="R$"></td>--}}
                                {{--<td><input class="form-control input-sm money" name="produto12_nf" type="text" id="produto12_nf" value="{{ old('produto12_nf', isset($preProposta->produto12_nf) ? $preProposta->produto12_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>--}}

                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>HOMOLOGAÇÃO CONCESSIONÁRIA</td>--}}
                                {{--<td><input class="form-control input-sm" name="qtd_homologacao" type="text" id="qtd_homologacao" value="{{ old('qtd_homologacao', isset($preProposta->qtd_homologacao) ? $preProposta->qtd_homologacao : "1") }}" min="0" max="10" placeholder="HOMOLOGAÇÃO CELPE"></td>--}}
                                {{--<td><input class="form-control input-sm money" name="produto6_preco" type="text" id="produto6_preco" value="{{ old('produto6_preco', isset($preProposta->produto6_preco) ? $preProposta->produto6_preco : "0") }}" min="0" max="10" placeholder="R$"></td>--}}
                                {{--<td><input class="form-control input-sm money" name="produto6_nf" type="text" id="produto6_nf" value="{{ old('produto6_nf', isset($preProposta->produto6_nf) ? $preProposta->produto6_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>--}}

                            {{--</tr>--}}
                            <tr style="display: none">
                                <td>MÃO-DE-OBRA DE INSTALAÇÃO (EQUIPE TÉCNICA)</td>
                                <td ><input class="form-control input-sm" name="qtd_mao_obra" type="text" id="qtd_mao_obra" value="{{ old('qtd_mao_obra', isset($preProposta->qtd_mao_obra) ? $preProposta->qtd_mao_obra : '1') }}" min="0" max="10" placeholder="Quantidade de Inversores"></td>
                                <td><input class="form-control input-sm money" name="produto7_preco" type="text" id="produto7_preco" value="{{ old('produto7_preco', isset($preProposta->produto7_preco) ? $preProposta->produto7_preco : "0") }}" min="0" max="10" placeholder="R$"></td>
                                <td><input class="form-control input-sm money" name="produto7_nf" type="text" id="produto7_nf" value="{{ old('produto7_nf', isset($preProposta->produto7_nf) ? $preProposta->produto7_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>

                            </tr>
                            </tr>
                            <tr>
                                <td>INSTALAÇÃO DE NOVO PDE</td>
                                <td><input class="form-control input-sm" name="qtd_inst_pde" type="text" id="qtd_inst_pde" value="{{ old('qtd_inst_pde', isset($preProposta->qtd_inst_pde) ? $preProposta->qtd_inst_pde : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                <td><input class="form-control input-sm money" name="produto8_preco" type="text" id="produto8_preco" value="{{ old('produto8_preco', isset($preProposta->produto8_preco) ? $preProposta->produto8_preco : "0") }}" min="0" max="10" placeholder="R$"></td>
                                <td><input class="form-control input-sm money" name="produto8_nf" type="text" id="produto8_nf" value="{{ old('produto8_nf', isset($preProposta->produto8_nf) ? $preProposta->produto8_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>

                            </tr>
                            <tr>
                                <td>MUDANÇA DE PDE</td>
                                <td><input class="form-control input-sm" name="qtd_mud_pde" type="text" id="qtd_mud_pde" value="{{ old('qtd_mud_pde', isset($preProposta->qtd_mud_pde) ? $preProposta->qtd_mud_pde : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                <td><input class="form-control input-sm money" name="produto9_preco" type="text" id="produto9_preco" value="{{ old('produto9_preco', isset($preProposta->produto9_preco) ? $preProposta->produto9_preco : "0") }}" min="0" max="10" placeholder="R$"></td>
                                <td><input class="form-control input-sm money" name="produto9_nf" type="text" id="produto9_nf" value="{{ old('produto9_nf', isset($preProposta->produto9_nf) ? $preProposta->produto9_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                            </tr>
                            <tr>
                                <td>SUBESTAÇÃO</td>
                                <td><input class="form-control input-sm" name="qtd_substacao" type="text" id="qtd_substacao" value="{{ old('qtd_substacao', isset($preProposta->qtd_substacao) ? $preProposta->qtd_substacao : '1') }}" min="0" max="10" placeholder="Quantidade de kit inversores"></td>
                                <td><input class="form-control input-sm money" name="produto10_preco" type="text" id="produto10_preco" value="{{ old('produto10_preco', isset($preProposta->produto10_preco) ? $preProposta->produto10_preco : "0") }}" min="0" max="10" placeholder="R$"></td>
                                <td><input class="form-control input-sm money" name="produto10_nf" type="text" id="produto10_nf" value="{{ old('produto10_nf', isset($preProposta->produto10_nf) ? $preProposta->produto10_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                            </tr>
                            <tr>
                                <td>REFORÇO ESTRUTURAL</td>
                                <td><input class="form-control input-sm" name="qtd_refor_estrutura" type="text" id="qtd_refor_estrutura" value="{{ old('qtd_refor_estrutura', isset($preProposta->qtd_refor_estrutura) ? $preProposta->qtd_refor_estrutura : '1') }}" min="0" max="10" placeholder="Quantidade de kit inversores"></td>
                                <td><input class="form-control input-sm money" name="produto11_preco" type="text" id="produto11_preco" value="{{ old('produto11_preco', isset($preProposta->produto11_preco) ? $preProposta->produto11_preco : "0") }}" min="0" max="10" placeholder="R$"></td>
                                <td><input class="form-control input-sm money" name="produto11_nf" type="text" id="produto11_nf" value="{{ old('produto11_nf', isset($preProposta->produto11_nf) ? $preProposta->produto11_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                            </tr>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div><!--end .panel -->

            <div class="card panel">
                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-4">
                    <header class="text-bold">Formas de Pagamento</header>
                    <div class="tools">
                        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
                <div id="accordion2-4" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf" class="col-sm-5 control-label text-bold">Banco Finan.:</label>
                                    <div class="col-sm-6">
                                        <select   class="form-control input-sm" id="baco_fin_id" name="baco_fin_id">
                                            <option value="" style="display: none;" {{ old('baco_fin_id', isset($preProposta->bancoFinanciadora->id) ? $preProposta->bancoFinanciadora->id : '') == '' ? 'selected' : '' }} disabled selected>Financiadora</option>
                                            @foreach ($bfs as $key => $bf)
                                                <option value="{{ $key }}" {{ old('baco_fin_id', isset($preProposta->bancoFinanciadora->id) ? $preProposta->bancoFinanciadora->id : null) == $key ? 'selected' : '' }}>
                                                    {{ $bf }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="rg" class="col-md-3 control-label text-bold">Recurso Bancário.:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" name="recurso1_banco" type="text" id="recurso1_banco" value="{{ old('recurso1_banco', isset($preProposta->recurso1_banco) ? $preProposta->recurso1_banco : null) }}" maxlength="255" >
                                        {!! $errors->first('recurso1_banco', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-entrada2_valor">
                                    <label for="cpf" class="col-sm-5 control-label text-bold">Entrada opção B.:</label>
                                    <div class="col-sm-6">
                                        <input class="form-control input-sm money" name="entrada2_valor" type="text" id="entrada2_valor" value="{{ old('entrada2_valor', isset($preProposta->entrada2_valor) ? $preProposta->entrada2_valor : null) }}" maxlength="11" >
                                        {!! $errors->first('entrada2_valor', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="rg" class="col-md-3 control-label text-bold">Recurso Bancário.:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" name="recurso2_banco" type="text" id="recurso2_banco" value="{{ old('recurso2_banco', isset($preProposta->recurso2_banco) ? $preProposta->recurso2_banco : null) }}" maxlength="255" >
                                        {!! $errors->first('recurso2_banco', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf" class="col-sm-5 control-label text-bold">Entrada.:</label>
                                    <div class="col-sm-6">
                                        <input class="form-control input-sm money" name="entrada3_valor" type="text" id="entrada3_valor" value="{{ old('entrada3_valor', isset($preProposta->entrada3_valor) ? $preProposta->entrada3_valor : null) }}" maxlength="11">
                                        {!! $errors->first('entrada3_valor', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="rg" class="col-md-3 control-label text-bold">Qtd Parcelas.:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" name="qtd_parcelas_entrada2" type="text" id="qtd_parcelas_entrada2" value="{{ old('qtd_parcelas_entrada2', isset($preProposta->qtd_parcelas_entrada2) ? $preProposta->qtd_parcelas_entrada2 : null) }}" maxlength="255">
                                        {!! $errors->first('qtd_parcelas_entrada2', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf" class="col-sm-5 control-label text-bold">Recurso SLE.:</label>
                                    <div class="col-sm-6">
                                        <input class="form-control input-sm money" name="recurso_proprio" type="text" id="recurso_proprio" value="{{ old('recurso_proprio', isset($preProposta->recurso_proprio) ? $preProposta->recurso_proprio : null) }}" >
                                        {!! $errors->first('recurso_proprio', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="rg" class="col-md-3 control-label text-bold">Valor Vencimento.:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm money" name="valor_vencimento" type="text" id="valor_vencimento" value="{{ old('valor_vencimento', isset($preProposta->valor_vencimento) ? $preProposta->valor_vencimento : null) }}" maxlength="255" >
                                        {!! $errors->first('valor_vencimento', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf" class="col-sm-5 control-label text-bold">Data Assinatura.:</label>
                                    <div class="col-sm-4">
                                        <input class="form-control input-sm date" name="data_financiamento_bancario" type="text" id="data_financiamento_bancario" value="{{ old('data_financiamento_bancario', isset($preProposta->data_financiamento_bancario) ? $preProposta->data_financiamento_bancario : null) }}" >
                                        {!! $errors->first('data_financiamento_bancario', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="rg" class="col-md-6 control-label text-bold">Tempo Carência.:</label>
                                    <div class="col-sm-3">
                                        <input class="form-control input-sm" name="tempo_carencia" type="text" id="tempo_carencia" value="{{ old('tempo_carencia', isset($preProposta->tempo_carencia) ? $preProposta->tempo_carencia : null) }}" maxlength="3" >
                                        {!! $errors->first('valor_vencimento', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="rg" class="col-md-6 control-label text-bold">Previsão Parcela.:</label>
                                    <div class="col-sm-4">
                                        <input class="form-control input-sm date" name="data_prevista_parcela" type="text" id="data_prevista_parcela" value="{{ old('data_prevista_parcela', isset($preProposta->data_prevista_parcela) ? $preProposta->data_prevista_parcela : null) }}" maxlength="255" >
                                        {!! $errors->first('data_prevista_parcela', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end card-body -->
                </div>
            </div><!--end .panel -->


        </div><!--end .panel-group -->
    </div><!--end .Acordion -->

</div>



    <div class="row">
        <div class="col-sm-4">
            <div class="form-group"{{ $errors->has('potencia_instalada') ? 'has-error' : '' }}">
                <label for="potencia_instalada" class="col-sm-6 control-label text-bold">Pot. do gerador (KWp).:</label>
                <div class="col-md-4">
                    <input readonly class="form-control input-sm"  type="text" value="{{ old('potencia_instalada', isset($preProposta->potencia_instalada) ? $preProposta->potencia_instalada : null) }}" maxlength="10" placeholder="Enter quantity here...">
                    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group"{{ $errors->has('panel_potencia') ? 'has-error' : '' }}">
                <label for="reducao_media_consumo" class="col-sm-6 control-label text-bold">Redução Consumo %.:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm money" name="reducao_media_consumo" type="text" id="value" value="{{ old('economia_anula', isset($preProposta->reducao_media_consumo) ? $preProposta->reducao_media_consumo : null) }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group"{{ $errors->has('minima_area') ? 'has-error' : '' }}">
                <label for="minima_area" class="col-sm-6 control-label text-bold">Área ( m²).::</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" name="minima_area" type="text" id="minima_area" value="{{ old('minimum_area', isset($preProposta->minima_area) ? $preProposta->minima_area : null) }}" maxlength="10" placeholder="">
                    {!! $errors->first('minima_area', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group"{{ $errors->has('valor_descontos') ? 'has-error' : '' }}">
                <label for="valor_descontos" class="col-sm-6 control-label text-bold">Descontos.:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm money" onblur="atualizaValores()" name="valor_descontos" type="text"   id="valor_descontos" value="{{ old('descontos', isset($preProposta->valor_descontos) ? $preProposta->valor_descontos : 0) }}"  min="0" max="10" placeholder="Descontos">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group"{{ $errors->has('preco_medio_instalado') ? 'has-error' : '' }}">
                <label for="preco_medio_instalado" class="col-sm-6 control-label text-bold">Valor Proposta R$.:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm money" readonly name="preco_medio_instalado" type="text" id="preco_medio_instalado" value="{{ old('preco_medio_instalado', isset($preProposta->preco_medio_instalado) ? $preProposta->preco_medio_instalado : null) }}" maxlength="12" placeholder="Enter power here...">
                </div>
            </div>
        </div>
            <div class="col-sm-4">
                <div class="form-group"{{ $errors->has('roi') ? 'has-error' : '' }}">
                <label for="roi" class="col-sm-6 control-label text-bold">ROI.:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" readonly  type="text" value="{{ old('roi', isset($preProposta->roi) ? $preProposta->roi : null) }}" maxlength="12" placeholder="Enter power here...">
                </div>
            </div>

    </div>

    <div class="form-group">
        <label for="estar_finalizado" class="col-md-2 control-label text-bold">Proposta Fechada?.:</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="estar_finalizado">
                    <input id="estar_finalizado" class="" name="estar_finalizado" type="checkbox" value="1" {{ old('estar_finalizado', isset($preProposta->estar_finalizado) ? $preProposta->estar_finalizado : null) == '1' ? 'checked' : '' }}>
                </label>
            </div>
        </div>
    </div>



@role('franquia|super-admin')
   <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="agendar" class="col-md-8 control-label text-bold">Pendente?.:</label>
                    <div class="col-md-4">
                        <div class="checkbox checkbox-styled">
                            <label for="pendencia">
                                <input id="pendencia" class="" name="pendencia" type="checkbox" value="1" {{ old('pendencia', isset($preProposta->pendencia) ? $preProposta->pendencia : null) == '1' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="agendar_data" class="col-sm-1 control-label text-bold">Obs.:</label>
                    <div class="col-md-11">
                        <textarea class="form-control input-sm" name="pendencia_obs" cols="50" rows="1" id="pendencia_obs" placeholder="Obs.">{{ old('pendencia_obs', isset($preProposta->pendencia_obs) ? $preProposta->pendencia_obs : null) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
@endrole

<div class="form-group">
    <label for="pre_proposta_obs" class="col-md-2 control-label text-bold">Obs.:</label>
    <div class="col-md-10">
        <textarea class="form-control input-sm" name="pre_proposta_obs" cols="50" rows="3" id="pre_proposta_obs" placeholder="Obs.">{{ old('pre_proposta_obs', isset($preProposta->pre_proposta_obs) ? $preProposta->pre_proposta_obs : null) }}</textarea>
    </div>
</div>
            @endif



</div>

