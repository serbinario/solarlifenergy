<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 06/08/18
 * Time: 18:14
 */

namespace Serbinario\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class ReportController extends Controller
{
    private $vencimento_ini;
    private $vencimento_fim;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportPdfFinanceiroIndex()
    {
        return view('report.index');
    }



    public function reportPdfFichaElaboracaoProjeto($idProjeto)
    {
        $options = [
            'format' => ['pdf'],
            'locale' => 'pt_BR',
            'params' => [ 'idProjeto' => $idProjeto],
            'db_connection' => [
                'driver' => env('DB_CONNECTION'),
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                //'jdbc_driver' => 'com.mysql.jdbc.Driver',
                //'jdbc_url' => 'jdbc:mysql://localhost:3306',
                //'jdbc_dir' => '/usr/share/java/'
            ]
        ];

        // coloca na variavel o caminho do novo relatório que será gerado
        //$output = public_path() . '/reports/' . time() . '_Clientes';// instancia um novo objeto JasperPHP
        $output = public_path() . '/reports/' .  'Clientes';// instancia um novo objeto JasperPHP

        $report = new PHPJasper();// chama o método que irá gerar o relatório
        dd($report->process(
            public_path() . '/reports/Fixa_elaboracao_projeto.jrxml',
            $output,
            $options
        )->output());
        $file = $output . '.pdf';

        //dd($file);
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }//caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);//deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);// retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="cliente.pdf"');

    }

}