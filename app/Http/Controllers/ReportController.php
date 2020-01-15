<?php

namespace Serbinario\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPJasper\PHPJasper;
use Serbinario\Entities\Contrato;
use Serbinario\Entities\PreProposta;
use Serbinario\Traits\UtilReports;

class ReportController extends Controller
{
    use UtilReports;
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
            public_path() .  '/reports/Ficha_elaboracao_projeto.jrxml',
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
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="cliente.pdf"');

    }

    public function reportPdfProcuracao($idProcuracao)
    {
        $options = [
            'format' => ['pdf'],
            'locale' => 'pt_BR',
            'params' => [ 'id_procuracao' => $idProcuracao],
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
            public_path() .  '/reports/Procuracao.jrxml',
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
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="cliente.pdf"');

    }

    public function reportPdfContrato($id)
    {
        try
        {
            $contrato = Contrato::with('reportLayout')->find($id);
            $nome_arquivo = $contrato->reportLayout->nome;
            $file = $this->gerarPdf($id, $nome_arquivo);
            return response($file, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
        } catch (Exception $e) {
            dd("sssssss");
        }
        //dd($id);


    }

    public function reportPdfDeclaracao($id)
    {
        try
        {
            $nome_arquivo = "Declaracao_ciencia";
            $file = $this->gerarPdf($id, $nome_arquivo);
            return response($file, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
        } catch (Exception $e) {
            dd("sssssss");
        }
        //dd($id);
    }

    public function reportPdfPreProposta($id)
    {
        $preProposta = PreProposta::find($id);
        $media = $this->getMediaMeses($preProposta);

        $qtdModulos = $this->getQtdModulos($media, '0','4.7', '5.71', '30', '0.14', '1.7');

        $potenciaGerador = $this->getGeradorKwp($qtdModulos, '330');

        $area = $this->getArea($qtdModulos, '2.1', '1.15');

        $co2 = $this->getCo2($potenciaGerador);

        $geracaoEnergiaFV = $this->getGeracaoEnergiaFV($qtdModulos, '30', '6.23', '1.72', '0.15');

        $reducaoMediaConsumo = $this->getReducaoMediaConsumo($media, '0',array_sum($geracaoEnergiaFV)/12 );

        echo "Potência do gerador (KWp) = " . $potenciaGerador . "<br>";
        echo "Área ( m²) = " . $area . "<br>";
        echo "MÉD REDUÇÃO DO CONSUMO (%) = " . $reducaoMediaConsumo. "<br>";
        echo "Emissão de CO2 evitadas (KG/a ) = " . $co2 . "<br>";
        echo "Média Fora da Ponta = " . $media . "<br>";
        echo "GERAÇÃO ENERGIA FV = " . "<br>";
        for($i=0; $i<12;$i++){
            echo "Mes " .  $i . " ".$geracaoEnergiaFV[$i] . "<br>";
        }
        echo "MÓDULO FV DAH             = " .  $qtdModulos . " -- R$ 860" . " -- R$" . $qtdModulos * 860 . "<br>";
        echo "INVERSOR KSTAR            = " .  1 . "     --  R$".  $qtdModulos * 860 * 0.48 . " -- R$" . $qtdModulos * 860 * 0.48 . "<br>";
        echo "ESTRUTURA                 = " .  1 . " -- R$ " .$qtdModulos * 860 * 0.2  . "    -- R$" .$qtdModulos * 860 * 0.2 . "<br>";
        echo "STRING BOX                = " .  1 . "  -- R$ ". (($qtdModulos * 860) +  ($qtdModulos * 860 * 0.48) + ($qtdModulos * 860 * 0.2) )*0.06 . " -- R$ " . (($qtdModulos * 860) +  ($qtdModulos * 860 * 0.48) + ($qtdModulos * 860 * 0.2) )*0.06 . "<br>";
        echo "KIT MONITORAMENTO WIFI    = " .  1 . " -- R$ " . (($qtdModulos * 860) +  ($qtdModulos * 860 * 0.48) + ($qtdModulos * 860 * 0.2) )*0.03 . " -- " . (($qtdModulos * 860) +  ($qtdModulos * 860 * 0.48) + ($qtdModulos * 860 * 0.2) )*0.03 . "<br>";
    }

}