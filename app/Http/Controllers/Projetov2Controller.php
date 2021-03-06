<?php

namespace Serbinario\Http\Controllers;


//meu teste
use Serbinario\Entities\Franquia;
use Serbinario\Entities\ProjetosParticipacao;
use Serbinario\Entities\Report;
use Serbinario\Traits\UtilEntities;
use Serbinario\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Endereco;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Projetov2;
use Serbinario\Entities\ProjetosDocumento;
use Serbinario\Entities\ProjetosExecurcao;
use Serbinario\Entities\ProjetosFinalizado;
use Serbinario\Entities\ProjetosFinalizando;
use Serbinario\Entities\ProjetoStatus;
use Serbinario\Http\Requests\Progetov2FormRequest;
use Serbinario\Traits\UtilFiles;
use Yajra\DataTables\DataTables;
use Exception;

class Projetov2Controller extends Controller
{
    use UtilFiles, UtilEntities;
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
        $franquias = Franquia::where('is_active', '=', '1')->pluck('nome','id')->all();
        $reports = Report::where('group', '=', 'projetos');
        $projetov2s = Projetov2::with('cliente','projetosstatus','preproposta','endereco','projetosdocumento','projetosexecurcao','projetosfinalizando')->paginate(25);
        return view('projetov2.index', compact('projetov2s', 'reports', 'franquias'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid(Request $request)
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('projetosv2')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftJoin('users', 'pre_propostas.user_id', '=', 'users.id')
            ->leftJoin('franquias', 'franquias.id', '=', 'users.franquia_id')
            ->leftJoin('projetos_status', 'projetos_status.id', '=', 'projetosv2.projeto_status_id')
            ->leftJoin('projetos_finalizado', 'projetos_finalizado.id', '=', 'projetosv2.projeto_finalizado_id')
            ->leftJoin('projetos_prioridades', 'projetos_prioridades.id', '=', 'projetosv2.projeto_prioridade_id')
            ->select([
                'projetosv2.id',
                'projetosv2.pendencia',
                'projetosv2.obs',
                \DB::raw('DATE_FORMAT(projetosv2.updated_at,"%d/%m/%Y") as atualizado'),
                'users.name as integrador',
                'franquias.nome as franquaia',
                'clientes.nome_empresa',
                'pre_propostas.valor_franquia',
                'pre_propostas.potencia_instalada',
                \DB::raw('DATE_FORMAT(pre_propostas.data_financiamento_bancario,"%d/%m/%Y") as data_financiamento_bancario'),
                \DB::raw('DATE_FORMAT(pre_propostas.data_prevista_parcela,"%d/%m/%Y") as data_prevista_parcela'),
                'projetos_prioridades.prioridade_nome',
                'pre_propostas.preco_medio_instalado',
                \DB::raw('DATE_FORMAT(projetos_finalizado.data_conexao,"%d/%m/%Y") as data_conexao'),
                \DB::raw('DATE_FORMAT(projetosv2.data_prevista,"%d/%m/%Y") as data_prevista'),
                'projetos_status.status_nome'
            ]);

        $rows->whereNull('projetosv2.arquivado');

        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if($user->hasRole('franquia')) {
            $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
        }
        //[RF003-RN004]
        if($user->hasRole('integrador')) {
            $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
            $rows->where('pre_propostas.user_id', '=', $user->id);
        }


        #Editando a grid
        return Datatables::of($rows)

            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('clientes.nome_empresa', 'like', "%" . $request->get('nome') . "%");
                }

                if ($request->has('franquia_id')) {
                     $query->where('franquias.id', '=',  $request->get('franquia_id') );
                }

                if ($request->has('data_ini')) {
                    $tableName = $request->get('filtro_por');
                    $query->whereBetween('projetosv2.' . $tableName, [$request->get('data_ini'), $request->get('data_fim')])->get();
                }
                if ($request->has('prioridade')) {
                    $query->where('projetos_prioridades.id', '=',  $request->get('prioridade') );
                }
                if ($request->has('cod_projeto')) {
                    $query->where('pre_propostas.codigo', 'like', "%" . $request->get('cod_projeto') . "%");
                }
                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
                if ($request->has('projeto_status')) {
                    $query->where('projetos_status.id', '=',  $request->get('projeto_status') );
                }
                //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
                $user = User::find(Auth::id());
                if($user->hasRole('franquia')) {
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }
                if($user->hasRole('integrador')) {
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                    $query->where('pre_propostas.user_id', '=', $user->id);
                }


            })
            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="projetov2/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                               <a href="/report/'.$row->id.'/FichaElaboracaoProjeto" class="btn btn-primary" target="_blank" title="Ficha de Elaboração de Projeto">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>
                                <a href="projetov2/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="#" class="btn btn-primary arquivar"  title="Arquivar">
                                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
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
        $users = User::orderBy('name')->pluck('name','id')->all();

        return view('projetov2.create', compact('users','clientes','ProjetosStatus','PrePropostas','Enderecos','ProjetosDocumentos','ProjetosExecurcaos','ProjetosFinalizandos'));
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

        $projetov2 = Projetov2::with('Endereco', 'ProjetosExecurcao', 'contrato', 'ProjetosFinalizando', 'ProjetosFinalizado', 'ProjetosDocumento', 'contratos', 'imagens', 'participacao')->findOrFail($id);
        $projetosStatus = ProjetoStatus::orderBy('status_nome')->pluck('status_nome','id')->all();

        //dd($projetov2->participacao);

        return view('projetov2.edit', compact('projetov2','projetosStatus'));
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

            $progetov2 = Projetov2::with('participacao')->findOrFail($id);


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
            $nameFileDeclaracao = $this->ImageStore($request, 'declaracao_ciencia_image', $analizeDocumento->declaracao_ciencia_image);
            $nameFileProposta = $this->ImageStore($request, 'proposta_image', $analizeDocumento->proposta_image);
            $nameFileContrato = $this->ImageStore($request, 'contrato_image', $analizeDocumento->contrato_image);
            $nameFileFormularioVistoriaImage = $this->ImageStore($request, 'formulario_vistoria_image', $analizeDocumento->formulario_vistoria_image);



            $nameFileCartaoCNPJ = $this->ImageStore($request, 'cartao_cnpj_image', $analizeDocumento->cartao_cnpj_image);
            $nameFileDContratoSocial = $this->ImageStore($request, 'contrato_social_image', $analizeDocumento->contrato_social_image);
            $nameFileFaturamento = $this->ImageStore($request, 'faturamento_image', $analizeDocumento->faturamento_image);
            $nameFileComprovanteRenda = $this->ImageStore($request, 'comprovante_renda_image', $analizeDocumento->comprovante_renda_image);


            $analizeDocumentoData['cpf_cnh_rg_image'] = $nameFileCpf_cnh_rg;
            $analizeDocumentoData['conprovante_residencia_image'] = $nameFileComproResi;
            $analizeDocumentoData['cpf_cnh_rg_conjugue_image'] = $nameFileCpfCnhRgConju;
            $analizeDocumentoData['certidao_casamento_image'] = $nameFileCertidaoCasamento;
            $analizeDocumentoData['ficha_elaboracao_projeto_image'] = $nameFileFichaElaboracao;
            $analizeDocumentoData['declaracao_ciencia_image'] = $nameFileDeclaracao;
            $analizeDocumentoData['proposta_image'] = $nameFileProposta;
            $analizeDocumentoData['contrato_image'] = $nameFileContrato;

            $analizeDocumentoData['formulario_vistoria_image'] = $nameFileFormularioVistoriaImage;

            $analizeDocumentoData['cartao_cnpj_image'] = $nameFileCartaoCNPJ;
            $analizeDocumentoData['contrato_social_image'] = $nameFileDContratoSocial;
            $analizeDocumentoData['faturamento_image'] = $nameFileFaturamento;
            $analizeDocumentoData['comprovante_renda_image'] = $nameFileComprovanteRenda;

            $analizeDocumento->update($analizeDocumentoData);


            /*
             * Atualiza tabela Projetos Execurcao
             */
            $execursao = ProjetosExecurcao::findOrFail($progetov2->projeto_execurcao_id);
            $execursaoData = $request->only(
                $execursao->getColumnsTable()
            );

            $request->has('solicitacao_acesso')? : $execursaoData['solicitacao_acesso'] = 0;



            $nameFileAcesso = $this->ImageStore($request, 'parecer_acesso_image', $execursao->parecer_acesso_image);
            $nameFileRelacionamento = $this->ImageStore($request, 'parecer_relacionamento_image', $execursao->parecer_relacionamento_image);
            $nameFileART = $this->ImageStore($request, 'emitir_art_image', $execursao->emitir_art_image);


            $execursaoData['parecer_acesso_image'] = $nameFileAcesso;
            $execursaoData['parecer_relacionamento_image'] = $nameFileRelacionamento;
            $execursaoData['emitir_art_image'] = $nameFileART;
            //dd($execursaoData);
            $execursao->update($execursaoData);


            //$finalizando->update($finalizandoData);

            /*
             * Atualiza tabela Projetos Finalizando
             */
            $finalizando = ProjetosFinalizando::findOrFail($progetov2->projeto_finalizando_id);
            $finalizandoData = $request->only(
                $finalizando->getColumnsTable()
            );

            $request->has('solicitacao_vistoria')? : $finalizandoData['solicitacao_vistoria'] = 0;
            $request->has('agendar')? : $finalizandoData['agendar'] = 0;

            $nameFileSeloVistoriaImage = $this->ImageStore($request, 'selo_vistoria_image', $execursao->selo_vistoria_image);
            $finalizandoData['selo_vistoria_image'] = $nameFileSeloVistoriaImage;

            $finalizando->update($finalizandoData);

            $finalizado = ProjetosFinalizado::findOrFail($progetov2->projeto_finalizado_id);
            $finalizadoData = $request->only(
                $finalizado->getColumnsTable()
            );
            //dd($finalizadoData);
            $finalizado->update($finalizadoData);

            //Deleta primeiro todos os registors dos contratos
            //$contratos = $progetov2->contratos()->delete();

            $files = $request->file('imageN');

            if(isset($files)){
                foreach($files as $key => $file)
                {
                    $nameFile = $this->ImageStoreV2($file, 'parecer_acesso_imageN', null);

                    $contratos = $progetov2->contratos()->create([
                        'num_contacontrato' => isset($request->num_contacontratoN[$key])? $request->num_contacontratoN[$key]: null ,
                        'percentual' => isset($request->percentualN[$key])? $request->percentualN[$key]: null ,
                        'image' => $nameFile,
                        'contrato_titularidade' => isset($request->contrato_titularidadeN[$key])? $request->contrato_titularidadeN[$key]: null ,
                    ]);
                   // dd($request->num_contacontratoN[0]);
                }
            }

            $files = $request->file('descricao_image');

            if(isset($files)){
                foreach($files as $key => $file)
                {
                    $nameFile = $this->ImageStoreV2($file, 'descricao_image', null);

                    $contratos = $progetov2->imagens()->create([
                        'descricao' => isset($request->descricao[$key])? $request->descricao[$key]: null ,
                        'descricao_image' => $nameFile,

                    ]);
                    // dd($request->num_contacontratoN[0]);
                }
            }

            $files = $request->file('descricao_imageN');

            if(isset($files)){
                foreach($files as $key => $file)
                {
                    $nameFile = $this->ImageStoreV2($file, 'descricao_imageN', null);

                    $contratos = $progetov2->imagens()->create([
                        'descricao' => isset($request->descricaoN[$key])? $request->descricaoN[$key]: null ,
                        'descricao_image' => $nameFile,

                    ]);
                    // dd($request->num_contacontratoN[0]);
                }
            }


            if(isset($request->image)){
                for($i = 0; $i < count($request->image); $i++) {

                    $progetov2->contratos()->where('image' , $request->image[$i])->update([
                        'num_contacontrato' => $request->num_contacontrato[$i],
                        'percentual' => $request->percentual[$i]
                    ]);
                }
            }

            if($data['data_pagamento']){
                $value = $data['data_pagamento'];
                $dataPagamaneto = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
                $user = (new \Serbinario\Entities\ProjetosParticipacao)->updateOrCreate(
                    ['projetov2_id' =>   $progetov2->id],
                    [ 'pago' => $data['pago'], 'data_prevista' => $data['data_prevista'], 'obs' => $data['participacao_obs'], 'data_pagamento' => $dataPagamaneto]
                );
                //dd("ffffffffffffff");
            }else{
                $value = $data['data_pagamento'];
                $dataPagamaneto = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
                $user = (new \Serbinario\Entities\ProjetosParticipacao)->updateOrCreate(
                    ['projetov2_id' =>   $progetov2->id],
                    [ 'pago' => $data['pago'], 'data_prevista' => $data['data_prevista'], 'obs' => $data['participacao_obs']]
                );
                //dd("ddddddddddd");
            }
            //dd($dataPagamaneto);



            $progetov2->update($data);

            return redirect()->route('projetov2.projetov2.edit', $progetov2->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');


        } catch (Exception $e) {
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
