<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 12/20/19
 * Time: 2:41 PM
 */

namespace Serbinario\Traits;


use http\Env\Request;
use PHPJasper\PHPJasper;
use Serbinario\Entities\Cidade;

trait Simulador
{

    function simularGeracao($request){

        $cidade = $request->get('cidade_id');
        //dd($cidade);
        $valor_medio_kw = (int)$request->get('monthly_usage');
        //dd($request->all());
        $ip = request()->ip();

        switch ($valor_medio_kw) {
            case $valor_medio_kw <= 300:
                $inversor_mult = 0.56;
                $estrutura_mult = 0.29;
                $infra_mult = 0.18;
                $kit_moni = 0.05;
                $valor_modulo = 840;
                break;
            case $valor_medio_kw >= 301 && $valor_medio_kw <= 500:
                $inversor_mult = 0.48;
                $estrutura_mult = 0.27;
                $infra_mult = 0.06;
                $kit_moni = 0.05;
                $valor_modulo = 790;
                break;
            case $valor_medio_kw >= 501 && $valor_medio_kw <= 800:
                $inversor_mult = 0.48;
                $estrutura_mult = 0.18;
                $infra_mult = 0.03;
                $kit_moni = 0.05;
                $valor_modulo = 780;
                break;
            case $valor_medio_kw >= 801 && $valor_medio_kw <= 1200:
                $inversor_mult = 0.4;
                $estrutura_mult = 0.2;
                $infra_mult = 0.04;
                $kit_moni = 0.016;
                $valor_modulo = 780;
                break;
            case $valor_medio_kw >= 1201 && $valor_medio_kw <= 4000:
                $inversor_mult = 0.28;
                $estrutura_mult = 0.11;
                $infra_mult = 0.03;
                $kit_moni = 0.01;
                $valor_modulo = 760;
                break;
            case $valor_medio_kw >= 4001 && $valor_medio_kw <= 5800:
                $inversor_mult = 0.26;
                $estrutura_mult = 0.07;
                $infra_mult = 0.04;
                $kit_moni = 0.004;
                $valor_modulo = 760;
                break;
            case $valor_medio_kw >= 5801:
                $inversor_mult = 0.28;
                $estrutura_mult = 0.08;
                $infra_mult = 0.04;
                $kit_moni = 0.004;
                $valor_modulo = 760;
                break;
        }



        $cidade = Cidade::where('id', '=', $cidade)->first();


        $mediaForaPonta = $request->get('monthly_usage');
        //$mediaNaPonta = $this->getMediaMesesNaPonta($preProposta);

        $qtdModulos = $this->getQtdModulos($valor_medio_kw, 0,'4.6', 5.71, '30', '0.14', '1.7');

        $potenciaGerador = $this->getGeradorKwp($qtdModulos, '330');

        $area = $this->getArea($qtdModulos, '2.1', '1.15');

        $co2 = $this->getCo2($potenciaGerador);

        $geracaoEnergiaFV = $this->getGeracaoEnergiaFV($cidade, $qtdModulos, '1.72');

        $reducaoMediaConsumo = $this->getReducaoMediaConsumo($mediaForaPonta, '0',array_sum($geracaoEnergiaFV)/12 );

       // dd($reducaoMediaConsumo);

        $somaModulos = $qtdModulos * $valor_modulo;
        $somaInversor = $somaModulos * $inversor_mult;
        //dd($somaInversor);
        $somaestrutura = $somaModulos * $estrutura_mult;
        $somaInfra = ($somaModulos + $somaInversor + $somaestrutura) * $infra_mult;
        $somaKit = ($somaModulos + $somaInversor + $somaestrutura) * $kit_moni;

        $total_nvestimento = $somaModulos + $somaInversor + $somaestrutura + $somaInfra + $somaKit;

        return
            [
                'success' => true,
                'valor_modulo' => $valor_modulo,
                'qtd_modulos' => $qtdModulos,
                'potencia_gerador' => $potenciaGerador,
                'area_minima' => $area,
                'co2' => $co2,
                'valor_kw' => $valor_medio_kw,
                'total_nvestimento' => round($total_nvestimento, 2),
                'valor_modulo' => $valor_modulo,
                'soma_modulos' => $somaModulos,
                'soma_inversor' => $somaInversor,
                'soma_estrutura' => $somaestrutura,
                'soma_infra' => $somaInfra,
                'soma_kit' => $somaKit,
                'reducao_media_consumo' => $reducaoMediaConsumo,
                'geracao_fv' => $geracaoEnergiaFV
            ]
        ;
    }

    /*
     * Potência do gerador (KWp)
     */
    function getGeradorKwp($qtdModulos, $potencia){
        //dd(round($qtdModulos, 0));
        $result = ($qtdModulos * $potencia)/1000;
        return round($result, 2);
    }

    /*
     * MÓDULO FV DAH
     * Quantidade de módulos
     * 4.7 fator de compensaçao, 5,71 - irradiação media, 30 qtd de dias, 0,14 é o rendimento, e 1,7 area
     */
    function getQtdModulos($mediaMeses, $mediaMesesPonta, $fatorCompensacao, $irradiacao, $qtdDias, $rendimentoModulo, $areaModulo){

        $result = ($mediaMeses + $mediaMesesPonta * $fatorCompensacao) / ($irradiacao * $qtdDias * $rendimentoModulo * $areaModulo);
        return round($result, 0);
    }

    /*
     * CONSUMO FORA DE PONTA
     * É a média aritimética de todos os consumos mensais
     */
    function getMediaMesesForaPonta($model){
        return $media = ($model->jan + $model->feb + $model->mar + $model->apr + $model->may + $model->jun + $model->jul + $model->aug + $model->sep + $model->oct + $model->nov + $model->dec)/12;
    }
    /*
    * CONSUMO NA PONTA
    * É a média aritimética de todos os consumos mensais
    */
    function getMediaMesesNaPonta($model){
        return $media = (
                $model->na_ponta_jan +
                $model->na_ponta_feb +
                $model->na_ponta_mar +
                $model->na_ponta_apr +
                $model->na_ponta_may +
                $model->na_ponta_jun +
                $model->na_ponta_jul +
                $model->na_ponta_aug +
                $model->na_ponta_sep +
                $model->na_ponta_oct +
                $model->na_ponta_nov +
                $model->na_ponta_dec
            )/12;
    }


    /*
    * Área ( m²)
     * Quantidade de módulos * área total do painel * sobra
    */
    function getArea($qtdModulos, $areaTotalModulo, $sobra ){
        $result = $qtdModulos * $areaTotalModulo * $sobra;
        return round($result, 1);
    }

    /*
     * Emissão de CO2 evitadas (KG/a )
     */
    function getCo2($potenciaGerador){
        $result = 464.3269 * $potenciaGerador;
        return round($result, 0);
    }

    /*
     * GERAÇÃO ENERGIA FV
     * Qtd de dias, irradiação no mês, área do módulo, e rendimento do módulo
     */
    function getGeracaoEnergiaFV($cidade, $qtdModulos, $areaModulo){

        $geracao = array();
        $irradiacao = array(
            ['irradiacao' => $cidade->irradiacao_jan, 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' => $cidade->irradiacao_fev, 'dias' => '28', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_mar, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_abri, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_mai, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_jun, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_jul, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_ago, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_set, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_out, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' => $cidade->irradiacao_nov, 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' => $cidade->irradiacao_dez, 'dias' => '30', 'rendimento' => '0.15']
        );

        //dd($irradiacao);

        for($i=0;$i<12;$i++){
            $result = $qtdModulos * $irradiacao[$i]['dias'] *  $irradiacao[$i]['irradiacao']/1000 * $areaModulo *  $irradiacao[$i]['rendimento'] ;
            array_push($geracao, round($result, 1));
        }
        //dd($geracao);
        return $geracao;
    }

    /*
     * MÉD REDUÇÃO DO CONSUMO (%)
     */
    function getReducaoMediaConsumo($mediaMes, $mediaMesesPonta, $mediaGeracaoEnergiaFV){
        //dd($mediaGeracaoEnergiaFV);
        $result = ($mediaGeracaoEnergiaFV * 100)/($mediaMes + ($mediaMesesPonta * 4.7) );
        return round($result, 2);
    }

}