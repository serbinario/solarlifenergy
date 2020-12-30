<div class="card-body">
    <div class="group-title">
        <span class="sc-fEVUGC title">Projeto</span>

    <div class="row">
        <div class="col-sm-6">
            @if(isset($preProposta->cliente->nome))
                <div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                    <label for="nome" class="col-sm-4 control-label text-bold">Cliente.:</label>
                    <input name="cep" type="hidden" id="cep" value="{{ old('cep', isset($preProposta->cliente->cep) ? $preProposta->cliente->cep : null) }}" >
                    <input name="id" type="hidden" id="id" value="{{ old('cep', isset($preProposta->id) ? $preProposta->id : null) }}" >
                    <input name="royalties" type="hidden" id="royalties" value="{{ old('royalties', isset($preProposta->royalties) ? $preProposta->royalties : null) }}" >
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
                    <label for="codigo" class="col-sm-6 control-label text-bold">Proposta N.:</label>
                    <div class="col-md-4">
                        <input class="form-control input-sm" name="codigo" type="text" id="codigo" readonly value="{{ old('codigo', isset($preProposta->codigo) ? $preProposta->codigo : null) }}" >
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
            <div class="form-group {{ $errors->has('qtd_paineis') ? 'has-error' : '' }}">
                <label for="qtd_paineis" class="col-sm-6 control-label text-bold">Qtd Paineis.:*</label>
                <div class="col-md-4">
                    <input readonly class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" value="{{ old('monthly_usage', isset($preProposta->qtd_paineis) ? $preProposta->qtd_paineis : null) }}" maxlength="10" placeholder="">

                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group {{ $errors->has('modulo_id') ? 'has-error' : '' }}">
                <label for="modulo_id" class="col-sm-8 control-label text-bold">Painel Potência.:*</label>
                <div class="col-md-4">
                    <input readonly class="form-control input-sm"  type="text" value="{{ old('monthly_usage', isset($preProposta->modulo->potencia) ? $preProposta->modulo->potencia : null) }}" maxlength="10" placeholder="">

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
    </div>

    <div class="row group-title">
        <span class="sc-fEVUGC title">Projeto do cliente</span>
        <div class="col-md-5">
            <div class="form-group {{ $errors->has('monthly_usage') ? 'has-error' : '' }}">
                <label for="monthly_usage" class="col-md-2 control-label text-bold">Inversor.:*</label>
                <div class="col-md-6">
                    <input readonly class="form-control input-sm " name="inversor" type="text" id="inversor" value="{{ old('inversor', isset($preProposta->clienteExpansao->inversor) ? $preProposta->clienteExpansao->inversor : "") }}" maxlength="10" >
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('qtd_modulos') ? 'has-error' : '' }}">
                <label for="qtd_modulos" class="col-md-6 control-label text-bold">Qtd Paineis.:*</label>
                <div class="col-md-4">
                    <input readonly class="form-control input-sm " name="qtd_modulos" type="text" id="qtd_modulos" value="{{ old('qtd_modulos', isset($preProposta->clienteExpansao->qtd_modulos) ? $preProposta->clienteExpansao->qtd_modulos : "") }}" maxlength="10" >

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('modulo_id1') ? 'has-error' : '' }}">
                <label for="modulo_id1" class="col-md-6 control-label text-bold">Painel Potência.:*</label>
                <div class="col-md-4">
                    <input readonly class="form-control input-sm " name="potencia_modulo" type="text" id="potencia_modulo" value="{{ old('potencia_modulo', isset($preProposta->clienteExpansao->potencia_modulo) ? $preProposta->clienteExpansao->potencia_modulo : "") }}" maxlength="10" >
                </div>
            </div>
        </div>

    </div>

    <!--Acordion -->
<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion2">


    @if(isset($preProposta->id))
            <div class="card panel expanded">
                <div class="card-head card-head-xs" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-3">
                    <header class="text-bold">Detalhamento dos equipamentos</header>
                    <div class="col-6 ">
												<span class=" total_equipamentos badge badge-dark float-right-12">
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
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <select   class="form-control input-sm" id="moduloId" name="moduloId">
                                            <option value="2">MODULO FV SUNERGY 330</option>
                                            <option value="1">MODULO FV SUNERGY 440</option>
                                        </select>
                                    </td>
                                    <td><input  readonly class="form-control input-sm" name="qtd_paineis" type="text" id="qtd_paineis" value="{{ old('qtd_paineis', isset($preProposta->qtd_paineis) ? $preProposta->qtd_paineis : null) }}" min="0" max="10" placeholder="Quantidade de módulos"></td>
                                    <td><input  readonly class="form-control input-sm" name="produto1_nf" type="text" id="produto1_nf" value="{{ old('produto1_nf', isset($preProposta->produto1_nf) ? $preProposta->produto1_nf : null) }}" min="0" max="10" placeholder=""></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select   class="form-control input-sm" id="inversorId" name="inversorId">
                                            <option value="5">INVERSOR KSTAR 3k</option>
                                            <option value="7">INVERSOR KSTAR 5k</option>
                                            <option value="8">INVERSOR KSTAR 12k</option>
                                            <option value="9">INVERSOR KSTAR 15k</option>
                                            <option value="10">INVERSOR KSTAR 20k</option>
                                            <option value="11">INVERSOR KSTAR 30k</option>
                                        </select>
                                    </td>
                                    <td><input  {{ Auth::user()->hasRole('super-admin')? null : 'readonly' }} class="form-control input-sm" name="qtd_inversores" type="text" id="qtd_inversores" value="{{ old('qtd_inversores', isset($preProposta->qtd_inversores) ? $preProposta->qtd_inversores : '1') }}" min="0" max="10" placeholder="Quantidade de Inversores"></td>
                                    <td><input  {{ Auth::user()->hasRole('super-admin')? null : 'readonly' }} class="form-control input-sm" name="produto2_nf" type="text" id="produto2_nf" value="{{ old('produto2_nf', isset($preProposta->produto2_nf) ? $preProposta->produto2_nf : '1') }}" min="0" max="10" placeholder=""></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td><input class="form-control input-sm input-table-solar" name="produto3" type="text" id="produto3" value="{{ old('produto3', isset($preProposta->produto3) ? $preProposta->produto3 : "ESTRUTURA") }}" min="0" max="10" placeholder="Estrutura"></td>
                                    <td><input  readonly class="form-control input-sm input-table-solar" name="qtd_estrutura" type="text" id="qtd_estrutura" value="{{ old('qtd_estrutura', isset($preProposta->qtd_estrutura) ? $preProposta->qtd_estrutura : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                    <td><input  readonly class="form-control input-sm input-table-solar" name="qtd_estrutura" type="text" id="qtd_estrutura" value="{{ old('qtd_estrutura', isset($preProposta->produto3_nf) ? $preProposta->produto2_nf : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                    </tr>
                                <tr>
                                    <td><input class="form-control input-sm" name="produto4" type="text" id="produto4" value="{{ old('produto4', isset($preProposta->produto4) ? $preProposta->produto4 : "STRING BOX") }}" min="0" max="10" placeholder="Nome do inversor"></td>
                                    <td><input  readonly class="form-control input-sm input-table-solar" name="qtd_string_box" type="text" id="qtd_string_box" value="{{ old('qtd_mqtd_string_boxud_pde', isset($preProposta->qtd_string_box) ? $preProposta->qtd_string_box : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                    <td><input  readonly class="form-control input-sm input-table-solar" name="qtd_string_box" type="text" id="qtd_string_box" value="{{ old('qtd_mqtd_string_boxud_pde', isset($preProposta->produto4_nf) ? $preProposta->produto4_nf : '1') }}" min="0" max="10" placeholder="Quantidade de string box"></td>
                                  </tr>
                                <tr>
                                    <td><input class="form-control input-sm input-table-solar" name="produto5" type="text" id="produto5" value="{{ old('produto5', isset($preProposta->produto5) ? $preProposta->produto5 : "KIT MONITORAMENTO WIFI") }}" min="0" max="10" placeholder="Nome do inversor"></td>
                                    <td><input readonly readonly class="form-control input-sm input-table-solar" name="qtd_kit_monitoramento" type="text" id="qtd_kit_monitoramento" value="{{ old('qtd_kit_monitoramento', isset($preProposta->qtd_kit_monitoramento) ? $preProposta->qtd_kit_monitoramento : '1') }}" min="0" max="10" placeholder="Quantidade de kit inversores"></td>
                                    <td><input readonly readonly class="form-control input-sm input-table-solar" name="qtd_kit_monitoramento" type="text" id="qtd_kit_monitoramento" value="{{ old('qtd_kit_monitoramento', isset($preProposta->produto5_nf) ? $preProposta->produto5_nf : '1') }}" min="0" max="10" placeholder="Quantidade de kit inversores"></td>
                                   </tr>
                               {{-- <tr>
                                    <td colspan="3"><input readonly style="text-align:right; padding-right: 20px;" class="form-control input-sm" value="DESCONTOS"></td>
                                    <td><input  class="form-control input-sm money" name="desconto_equipamentos" type="text" id="desconto_equipamentos" value="{{ old('desconto_equipamentos', isset($preProposta->desconto_equipamentos) ? $preProposta->desconto_equipamentos : null) }}" min="0" max="10" placeholder="Desconto"></td>
                                </tr>--}}
                                <tr>
                                    <td colspan="2"><input readonly style="text-align:right; padding-right: 20px;" class="form-control input-sm input-table-solar" value="TOTAL"></td>
                                    <td><input readonly class="form-control input-sm money input-table-solar" name="total_equipamentos" type="text" id="total_equipamentos" value="{{ old('total_equipamentos', isset($preProposta->total_equipamentos) ? $preProposta->total_equipamentos : null) }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                                </tr>

                                <tr>
                                    <td  colspan="2" style="text-align:right; padding-right: 20px;">PARTICIPAÇÃO</td>
                                    <td><input  class="form-control input-sm money input-table-solar" name="valor_franquia" type="text" id="valor_franquia" value="{{ old('valor_franquia', isset($preProposta->valor_franquia) ? $preProposta->valor_franquia : null) }}" min="0" max="10" placeholder="Desconto"></td>

                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align:right; padding-right: 20px;">EQUIPE TÉCNICA</td>
                                    <td><input  {{ Auth::user()->hasRole('super-admin')? null : 'readonly' }} class="form-control input-sm money input-table-solar" name="equipe_tecnica" type="text" id="equipe_tecnica" value="{{ old('equipe_tecnica', isset($preProposta->equipe_tecnica) ? $preProposta->equipe_tecnica : null) }}" min="0" max="10" placeholder="Desconto"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align:right; {{ Auth::user()->hasRole('super-admin')? null : "display: none;" }} padding-right: 20px;">PREÇO DO MÓDULO</td>
                                    <td  style="text-align:right; {{ Auth::user()->hasRole('super-admin')? null : "display: none;" }}" ><input class="form-control input-sm money input-table-solar" name="valor_modulo" type="text" id="valor_modulo" value="{{ old('valor_modulo', isset($preProposta->valor_modulo) ? $preProposta->valor_modulo : null) }}" min="0" max="10" placeholder="Preço Módulo"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align:right; {{ Auth::user()->hasRole('super-admin')? null : "display: none;" }} padding-right: 20px;">PREÇO DO INVERSOR</td>
                                    <td  style="text-align:right; {{ Auth::user()->hasRole('super-admin')? null : "display: none;" }}" ><input class="form-control input-sm money input-table-solar" name="produto2_nf" type="text" id="produto2_nf" value="{{ old('produto2_nf', isset($preProposta->produto2_nf) ? $preProposta->produto2_nf : null) }}" min="0" max="10" placeholder="Preço Inversor"></td>
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
                    <div class="col-6 ">
												<span class="total_servico_operacional badge badge-dark float-right-12">
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
                                <td><input class="form-control input-sm money" name="produto7_nf" type="text" id="produto7_nf" value="{{ old('produto7_nf', isset($preProposta->produto7_nf) ? $preProposta->produto7_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>

                            </tr>
                            </tr>
                            <tr>
                                <td>INSTALAÇÃO DE NOVO PDE</td>
                               <td><input class="form-control input-sm money" name="produto8_nf" type="text" id="produto8_nf" value="{{ old('produto8_nf', isset($preProposta->produto8_nf) ? $preProposta->produto8_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>

                            </tr>
                            <tr>
                                <td>MUDANÇA DE PDE</td>
                                <td><input class="form-control input-sm money" name="produto9_nf" type="text" id="produto9_nf" value="{{ old('produto9_nf', isset($preProposta->produto9_nf) ? $preProposta->produto9_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                            </tr>
                            <tr>
                                <td>SUBESTAÇÃO</td>
                                <td><input class="form-control input-sm money" name="produto10_nf" type="text" id="produto10_nf" value="{{ old('produto10_nf', isset($preProposta->produto10_nf) ? $preProposta->produto10_nf : "0") }}" min="0" max="10" placeholder="Valor da NF-E"></td>
                            </tr>
                            <tr>
                                <td>REFORÇO ESTRUTURAL</td>
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
                    <input class="form-control input-sm money"  onblur="atualizaValores()" name="valor_descontos" type="text"   id="valor_descontos" value="{{ old('descontos', isset($preProposta->valor_descontos) ? $preProposta->valor_descontos : 0) }}"  min="0" max="10" placeholder="Descontos">
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

