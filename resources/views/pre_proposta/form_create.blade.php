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
<div class="row" style="padding-top: 8px;">
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

                </div>
                        <!-- end tab -->

                    </div>
                </div>
            </div><!--end .panel -->


</div>

<div id="simulator" class="result-container">
    <div class="value">
        <h3 class="simulator-v1-result">Valor Proposta</h3>
        <p><span class="simulator-v1-result_info-value" id="max_one_payment">34.045,56</span></p>
    </div>
    <div class="value">
        <h3 class="simulator-v1-result">Potência</h3>
        <p><span class="simulator-v1-result_info-value" id="installed_power">10.7</span> kWp</p>
    </div>
    <div class="value">
        <h3 class="simulator-v1-result">Área</h3>
        <p><span class="simulator-v1-result_info-value" id="min_area">102</span> m2</p>
    </div>
</div>

