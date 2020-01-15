<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 12/20/19
 * Time: 2:41 PM
 */

namespace Serbinario\Traits;


use PHPJasper\PHPJasper;

trait UtilReports
{

    function gerarPdf($id, $nome_arquivo){
        $options = [
            'format' => ['pdf'],
            'locale' => 'pt_BR',
            'params' => [ 'id' => $id],
            'db_connection' => [
                'driver' => env('DB_CONNECTION'),
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => "'" . env('DB_PASSWORD') . "'"
                //'jdbc_driver' => 'com.mysql.jdbc.Driver',
                //'jdbc_url' => 'jdbc:mysql://localhost:3306',
                //'jdbc_dir' => '/usr/share/java/'
            ]
        ];

        // coloca na variavel o caminho do novo relatório que será gerado
        //$output = public_path() . '/reports/' . time() . '_Clientes';// instancia um novo objeto JasperPHP
        $output = public_path() . '/reports/' .  'Clientes';// instancia um novo objeto JasperPHP

        $report = new PHPJasper();// chama o método que irá gerar o relatório
        $report->process(
            public_path() .  '/reports/' . $nome_arquivo.'.jrxml',
            $output,
            $options
        )->execute();
        $file = $output . '.pdf';

        //dd($file);
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }//caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);//deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);// retornamos o conteudo para o navegador que íra abrir o PDF
        return $file;
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
    function getMediaMeses($model){
        return $media = ($model->jan + $model->feb + $model->mar + $model->apr + $model->may + $model->jun + $model->jul + $model->aug + $model->sep + $model->oct + $model->nov + $model->dec)/12;
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
    function getGeracaoEnergiaFV($qtdModulos, $qtdDias, $irradiacaoMes, $areaModulo, $rendimentoModulo){

        $geracao = array();
        $irradiacao = array(
            ['irradiacao' => '6.23', 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' =>'6.22', 'dias' => '28', 'rendimento' => '0.14'],
            ['irradiacao' =>'5.92', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'5.55', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'5', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'4.68', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'4.87', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'5.28', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'5.95', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'6.29', 'dias' => '30', 'rendimento' => '0.14'],
            ['irradiacao' =>'6.34', 'dias' => '30', 'rendimento' => '0.15'],
            ['irradiacao' =>'6.22', 'dias' => '30', 'rendimento' => '0.15']
        );

        for($i=0;$i<12;$i++){
            //$qtdModulos * $qtdDias * $irradiacaoMes * $areaModulo * $rendimentoModulo;
            $result = $qtdModulos * $irradiacao[$i]['dias'] *  $irradiacao[$i]['irradiacao'] * $areaModulo *  $irradiacao[$i]['rendimento'] ;
            //dd($irradiacao[$i]['rendimento']);
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