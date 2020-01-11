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


}