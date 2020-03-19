<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\Entities\Cliente;
use Serbinario\Entities\Endereco;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Projetov2;
use Serbinario\Entities\ProjetosDocumento;
use Serbinario\Entities\ProjetosExecurcao;
use Serbinario\Entities\ProjetosFinalizado;
use Serbinario\Entities\ProjetosFinalizando;
use Serbinario\Entities\ProjetoStatus;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\Progetov2FormRequest;
use Serbinario\Traits\UtilFiles;
use Yajra\DataTables\DataTables;
use Exception;

class Projetov2Controller extends Controller
{
    use UtilFiles;
    private $token;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the progetov2s.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $projetov2s = Projetov2::with('cliente','projetosstatus','preproposta','endereco','projetosdocumento','projetosexecurcao','projetosfinalizando')->paginate(25);

        return view('projetov2.index', compact('projetov2s'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid()
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('projetosv2')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftJoin('projetos_status', 'projetos_status.id', '=', 'projetosv2.projeto_status_id')
            ->leftJoin('projetos_finalizado', 'projetos_finalizado.id', '=', 'projetosv2.projeto_finalizado_id')
            ->select([
                'projetosv2.id',
                'clientes.nome_empresa',
                'pre_propostas.codigo',
                'pre_propostas.monthly_usage',
                \DB::raw('DATE_FORMAT(projetos_finalizado.data_conexao,"%d/%m/%Y") as data_conexao'),
                \DB::raw('DATE_FORMAT(projetosv2.data_prevista,"%d/%m/%Y") as data_prevista'),
                'projetos_status.status_nome'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="projetov2/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                               
                                <a href="projetov2/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                               
                            </div>
                        </form>
                        ';
        })->make(true);
    }

    /**
     * Show the form for creating a new projetov2.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::pluck('nome','id')->all();
        $ProjetosStatus = ProjetoStatus::pluck('id','id')->all();
        $PrePropostas = PreProposta::pluck('codigo','id')->all();
        $Enderecos = Endereco::pluck('id','id')->all();
        $ProjetosDocumentos = ProjetosDocumento::pluck('id','id')->all();
        $ProjetosExecurcaos = ProjetosExecurcao::pluck('id','id')->all();
        $ProjetosFinalizandos = ProjetosFinalizando::pluck('id','id')->all();

        return view('projetov2.create', compact('clientes','ProjetosStatus','PrePropostas','Enderecos','ProjetosDocumentos','ProjetosExecurcaos','ProjetosFinalizandos'));
    }

    /**
     * Store a new projetov2 in the storage.
     *
     * @param Serbinario\Http\Requests\Progetov2FormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Progetov2FormRequest $request)
    {
        try {

            $data = $request->getData();

            Projetov2::create($data);

            return redirect()->route('projetov2.projetov2.index')
                ->with('success_message', 'Projetov2 was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified projetov2.
     *
     * @param int $idProjetosStatus
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $progetov2 = Projetov2::with('cliente','projetostatus','preproposta','endereco','projetosdocumento','projetosexecurcao','projetosfinalizando')->findOrFail($id);

        return view('projetov2.show', compact('progetov2'));
    }

    /**
     * Show the form for editing the specified projetov2.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $projetov2 = Projetov2::with('Endereco', 'ProjetosExecurcao', 'ProjetosFinalizando', 'ProjetosFinalizado', 'ProjetosDocumento', 'contratos')->findOrFail($id);
        $clientes = Cliente::pluck('nome','id')->all();
        $projetosStatus = ProjetoStatus::pluck('status_nome','id')->all();
        $PrePropostas = PreProposta::pluck('codigo','id')->all();
        $Enderecos = Endereco::pluck('id','id')->all();
        $ProjetosDocumentos = ProjetosDocumento::pluck('id','id')->all();
        $ProjetosExecurcaos = ProjetosExecurcao::pluck('id','id')->all();
        $ProjetosFinalizandos = ProjetosFinalizando::pluck('id','id')->all();

        return view('projetov2.edit', compact('projetov2','clientes','projetosStatus','PrePropostas','Enderecos','ProjetosDocumentos','ProjetosExecurcaos','ProjetosFinalizandos'));
    }

    /**
     * Update the specified projetov2 in the storage.
     *
     * @param  int $id
     * @param Serbinario\Http\Requests\Progetov2FormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Progetov2FormRequest $request)
    {
        try {

            $data = $request->getData();
            //dd($data);

            $progetov2 = Projetov2::findOrFail($id);

            $endereco = Endereco::findOrFail($progetov2->endereco_id);
            $enderecoData = $request->only(
                $endereco->getColumnsTable()
            );
            $endereco->update($enderecoData);

            /*
             * Atualiza tabela Documentos
             */
            $analizeDocumento = ProjetosDocumento::findOrFail($progetov2->projeto_documento_id);
            $analizeDocumentoData = $request->only(
                $analizeDocumento->getColumnsTable()
            );

            $nameFileCpf_cnh_rg = $this->ImageStore($request, 'cpf_cnh_rg_image', $analizeDocumento->cpf_cnh_rg_image);
            $nameFileComproResi = $this->ImageStore($request, 'conprovante_residencia_image', $analizeDocumento->conprovante_residencia_image);
            $nameFileCpfCnhRgConju = $this->ImageStore($request, 'cpf_cnh_rg_conjugue_image', $analizeDocumento->cpf_cnh_rg_conjugue_image);
            $nameFileCertidaoCasamento = $this->ImageStore($request, 'certidao_casamento_image', $analizeDocumento->certidao_casamento_image);
            $nameFileFichaElaboracao = $this->ImageStore($request, 'ficha_elaboracao_projeto_image', $analizeDocumento->ficha_elaboracao_projeto_image);
            $analizeDocumentoData['cpf_cnh_rg_image'] = $nameFileCpf_cnh_rg;
            $analizeDocumentoData['conprovante_residencia_image'] = $nameFileComproResi;
            $analizeDocumentoData['cpf_cnh_rg_conjugue_image'] = $nameFileCpfCnhRgConju;
            $analizeDocumentoData['certidao_casamento_image'] = $nameFileCertidaoCasamento;
            $analizeDocumentoData['ficha_elaboracao_projeto_image'] = $nameFileFichaElaboracao;
            $analizeDocumento->update($analizeDocumentoData);


            /*
             * Atualiza tabela Projetos Execurcao
             */
            $execursao = ProjetosExecurcao::findOrFail($progetov2->projeto_execurcao_id);
            $execursaoData = $request->only(
                $execursao->getColumnsTable()
            );

            $nameFileAcesso = $this->ImageStore($request, 'parecer_acesso_image', $execursao->parecer_acesso_image);
            $nameFileRelacionamento = $this->ImageStore($request, 'parecer_relacionamento_image', $execursao->parecer_relacionamento_image);
            $execursaoData['parecer_acesso_image'] = $nameFileAcesso;
            $execursaoData['parecer_relacionamento_image'] = $nameFileRelacionamento;
            $execursao->update($execursaoData);

            /*
             * Atualiza tabela Projetos Finalizando
             */
            $finalizando = ProjetosFinalizando::findOrFail($progetov2->projeto_finalizando_id);
            $finalizandoData = $request->only(
                $finalizando->getColumnsTable()
            );

            $finalizando->update($finalizandoData);

            $finalizado = ProjetosFinalizado::findOrFail($progetov2->projeto_finalizado_id);
            $finalizadoData = $request->only(
                $finalizado->getColumnsTable()
            );
            //dd($finalizadoData);
            $finalizado->update($finalizadoData);

            //Deleta primeiro todos os registors dos contratos
            $contratos = $progetov2->contratos()->delete();
            /*
             * 1- Pega do formulario uma array chamada num_contrato
             * 2 - se vinher alguma vazia e limpa com o metodo array_filter
             * 3 - E inserido em contrados
             */
            for($i = 0; $i < count($request->num_contacontrato); $i++){
                $contratos = $progetov2->contratos()->create(['num_contacontrato' => $request->num_contacontrato[$i], 'percentual' =>$request->percentual[$i]]);
            }

            $progetov2->update($data);

            return redirect()->route('projetov2.projetov2.edit', $progetov2->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');


        } catch (Exception $e) {
            dd("error2",$e);
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified projetov2 from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $progetov2 = Projetov2::findOrFail($id);
            $progetov2->delete();

            return redirect()->route('projetov2.projetov2.index')
                ->with('success_message', 'Projetov2 was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}