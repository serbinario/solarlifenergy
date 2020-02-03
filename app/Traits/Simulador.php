<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 12/20/19
 * Time: 2:41 PM
 */

namespace Serbinario\Traits;


use PHPJasper\PHPJasper;

trait Simulador
{

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
    function getGeracaoEnergiaFV($preProposta, $qtdModulos, $areaModulo){

        $geracao = array();
        $irradiacao = array(
            ['irradiacao' => $preProposta->cidade->irradiacao_jan, 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_fev, 'dias' => '28', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_mar, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_abri, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_mai, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_jun, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_jul, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_ago, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_set, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_out, 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_nov, 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' =>$preProposta->cidade->irradiacao_dez, 'dias' => '30', 'rendimento' => '0.15']
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