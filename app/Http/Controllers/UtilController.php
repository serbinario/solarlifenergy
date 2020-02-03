<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Serbinario\Entities\Cidade;
use Serbinario\Entities\Cliente;
use Serbinario\Traits\UtilReports;


class UtilController extends Controller
{
    use UtilReports;
    private $token;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
	    //$this->middleware('auth');
	}
	
    /**
     * Display a listing of the pools.
     *
     * @return Illuminate\View\View
     */
    public function consultaCpfCnpf(Request $request)
    {
       $cpf_cnpj =  Cliente::where('cpf_cnpj', '=', $request->input('cpf_cnpj') )->first();
       //dd($cpf_cnpj);
       if(isset($cpf_cnpj->cpf_cnpj)){
           return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Ja existe um cliente cadastrado']);
       }
        return \Illuminate\Support\Facades\Response::json(['success' => false,  'msg' => $cpf_cnpj]);
    }

    public function getCidades($id){
        $cidades = Cidade::where('estado_id', '=', $id)->pluck('nome','id');
        return \Illuminate\Support\Facades\Response::json(['success' => false,  'cidades' => $cidades]);
    }

    public function simulador(Request $request){

        $ip = request()->ip();

        $validator = \Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required',
            'valor_tarifa' => 'required',
            'gasto_mensal' => 'required',
            'telefone' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
        ]);

        if ($validator->fails()) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,
                $validator->errors()
            ]);
        }

        $nome = $request->get('nome');
        $email = $request->get('email');
        $valor_tarifa = $request->get('valor_tarifa');
        $gasto_mensal = $request->get('gasto_mensal');
        $telefone = $request->get('telefone');
        $cidade = $request->get('cidade');

        $valor_medio_kw = $gasto_mensal * $valor_tarifa;

        switch ($valor_medio_kw) {
            case $valor_medio_kw < 300:
                $inversor_mult = 0.56;
                $estrutura_mult = 0.29;
                $infra_mult = 0.18;
                $kit_moni = 0.05;
                $valor_modulo = 840;
                break;
            case $valor_medio_kw > 301 && $valor_medio_kw < 500:
                $inversor_mult = 0.48;
                $estrutura_mult = 0.27;
                $infra_mult = 0.06;
                $kit_moni = 0.05;
                $valor_modulo = 790;
                break;
            case $valor_medio_kw > 501 && $valor_medio_kw < 800:
                $inversor_mult = 0.48;
                $estrutura_mult = 0.18;
                $infra_mult = 0.03;
                $kit_moni = 0.05;
                $valor_modulo = 780;
                break;
            case $valor_medio_kw > 801 && $valor_medio_kw < 1200:
                $inversor_mult = 0.4;
                $estrutura_mult = 0.2;
                $infra_mult = 0.04;
                $kit_moni = 0.016;
                $valor_modulo = 780;
                break;
            case $valor_medio_kw > 1201 && $valor_medio_kw < 4000:
                $inversor_mult = 0.28;
                $estrutura_mult = 0.11;
                $infra_mult = 0.03;
                $kit_moni = 0.01;
                $valor_modulo = 760;
                break;
            case $valor_medio_kw > 4001 && $valor_medio_kw < 5800:
                $inversor_mult = 0.28;
                $estrutura_mult = 0.11;
                $infra_mult = 0.03;
                $kit_moni = 0.01;
                $valor_modulo = 760;
                break;
            case $valor_medio_kw > 5801:
                $inversor_mult = 0.26;
                $estrutura_mult = 0.07;
                $infra_mult = 0.04;
                $kit_moni = 0.004;
                $valor_modulo = 760;
                break;
        }

        $cidade = Cidade::where('nome', '=', $cidade)->first();

        $qtdModulos = $this->getQtdModulos($valor_medio_kw, 0,'4.6', 5.71, '30', '0.14', '1.7');

        $potenciaGerador = $this->getGeradorKwp($qtdModulos, '330');

        $area = $this->getArea($qtdModulos, '2.1', '1.15');

        $co2 = $this->getCo2($potenciaGerador);

        $somaModulos = $qtdModulos * $valor_modulo;
        $somaInversor = $somaModulos * $inversor_mult;
        $somaestrutura = $somaModulos * $estrutura_mult;
        $somaInfra = ($somaModulos + $somaInversor + $somaestrutura) * $infra_mult;
        $somaKit = ($somaModulos + $somaInversor + $somaestrutura) * $kit_moni;

        $total_nvestimento = $somaModulos + $somaInversor + $somaestrutura + $somaInfra + $somaKit;

        return \Illuminate\Support\Facades\Response::json(
            [
                'success' => true,
                'qtd_modulos' => $qtdModulos,
                'potencia_gerador' => $potenciaGerador,
                'area_minima' => $area,
                'c02' => $co2,
                'valor_kw' => $valor_medio_kw,
                'total_nvestimento' => round($total_nvestimento, 2)
            ]
        );
    }






}
