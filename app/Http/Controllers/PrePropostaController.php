<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\BancoFinanciadora;
use Serbinario\Entities\Cidade;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Estado;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\logistica\PropostaProduto;
use Serbinario\Entities\Modulo;
use Serbinario\Entities\ParametroGeral;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Prioridade;
use Serbinario\Entities\Report;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\PrePropostaFormRequest;
use Serbinario\Traits\Simulador;
use Serbinario\Traits\SimuladorV2;
use Serbinario\Traits\UtilEntities;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class PrePropostaController extends Controller
{
    use SimuladorV2;

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
     * Display a listing of the pre propostas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $franquias = Franquia::where('is_active', '=', '1')->pluck('nome','id')->all();
        $reports = Report::where('group', '=', 'propostas');
        $prePropostas = PreProposta::with('cliente')->paginate(25);

        return view('pre_proposta.index', compact('prePropostas', 'reports', 'franquias'));
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
        $rows = \DB::table('pre_propostas')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftJoin('users', 'users.id', '=', 'pre_propostas.user_id')
            ->leftJoin('projetosv2', 'projetosv2.proposta_id', '=', 'pre_propostas.id' )
            ->leftJoin('franquias', 'franquias.id', '=', 'users.franquia_id')
            ->leftJoin('prioridades', 'prioridades.id', '=', 'pre_propostas.prioridade_id')
            ->select([
                'users.name',
                'pre_propostas.codigo',
                'pre_propostas.id',
                'pre_propostas.potencia_instalada',
                'pre_propostas.pendencia',
                'pre_propostas.pendencia_obs',
                'franquias.nome as franquaia',
                \DB::raw('DATE_FORMAT(pre_propostas.data_validade,"%d/%m/%Y") as data_validade'),
                'pre_propostas.preco_medio_instalado',
                'clientes.nome',
                'clientes.nome_empresa',
                'clientes.cpf_cnpj',
                'clientes.email',
                'clientes.celular',
                'prioridades.name as prioridade',
                'projetosv2.id as projeto',
                'projetosv2.projeto_status_id as status_projeto',
                'pre_propostas.created_at',
                \DB::raw('DATE_FORMAT(pre_propostas.updated_at,"%d/%m/%Y") as updated_at'),

            ]);

        $rows->whereNull('expansao');
        $rows->whereNull('pre_propostas.arquivado');
        //Se o usuario logado nao tiver role de franquia, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if($user->hasRole('franquia')) {

            $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
        }
        if($user->hasRole('integrador')) {
            $rows->where('pre_propostas.user_id', '=', $user->id);
            $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
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
                    $query->whereBetween('pre_propostas.' . $tableName, [$request->get('data_ini'), $request->get('data_fim')])->get();
                }
                if ($request->has('codigo')) {
                    $query->where('pre_propostas.codigo', 'like', "%" . $request->get('codigo') . "%");
                }

                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }

                if ($request->has('prioridade')) {
                    $query->where('prioridades.id', '=', $request->get('prioridade') );
                    $query->whereNull('projetosv2.id');
                }

                if ($request->has('projetos')) {
                    if($request->get('projetos') == 1){
                        $query->whereNull('projetosv2.id');
                    }else{
                        $query->whereNotNull('projetosv2.id');
                    }
                }
                $query->whereNull('pre_propostas.arquivado');
            })

            ->addColumn('action', function ($row) {

                    $acao = '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">';

                        $user =  Auth::user();
                        if($user->hasPermissionTo('update.proposta')) {
                            $acao .= '<a href="preProposta/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>';
                        }

                        $acao .= '<a href="/report/'.$row->id.'/proposta" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>';


                        $acao .= '<a href="#" class="btn btn-primary arquivar"  title="Arquivar">
                                        <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                                    </a>';


                    $acao .= '</div>
                        </form>';
                    return $acao;


        })->make(true);
    }

    /**
     * Show the form for creating a new pre proposta.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $prioridades = Prioridade::pluck('name','id')->all();
        $Clientes = Cliente::orderBy('nome', 'ASC')->pluck('nome','id')->all();
        $estados = Estado::pluck('nome','id')->all();
        $modulos = Modulo::where('is_active', '=', 1)->pluck('potencia','id')->all();
        $bfs = BancoFinanciadora::pluck('nome','id')->all();

        $cidades = Cidade::where('estado_id', '=', '1')->pluck('nome','id');

        //Só pode ver os usuários da própria franquia
        $user = User::find(Auth::id());
        $franquia_id = Auth::user()->franquia_id;
        if($user->hasRole('super-admin')) {
            $users = User::orderBy('name')->orderBy('name','asc')->pluck('name','id')->all();
        }else{
            $users = User::where('franquia_id' , '=', $franquia_id)->orderBy('name')->orderBy('name','asc')->pluck('name','id')->all();
        }


        return view('pre_proposta.create', compact('Clientes', 'users','estados', 'cidades', 'bfs', 'modulos', 'prioridades'));
    }

    /**
     * Store a new pre proposta in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PrePropostaFormRequest $request)
    {
        try {

            $data = $this->getData($request);
            //Retorna o ultimo registro
            $month = date("Y");
            $last = \DB::table('pre_propostas')->orderBy('id', 'DESC')->whereYear('created_at',  $month)->first();
            if($last == NULL){
                $data['codigo'] = date("y") . "0001";
            }else{
                $codigo = $last->codigo +1;
                $data['codigo'] =  $codigo;
            }


            $data['cliente_id'] = $request->get('cliente_id');

            //Coloquei essa opçao pois quando um usuario nao e adm o formulario não manda o id do user pois esta
            // em somente leitura
            if(empty($data['user_id'])){
                $data['user_id'] = Auth::id();
            }

            /*
             * Regra de negócio do simulador
             */

            $return = $this->simularGeracao($request);


            $data['pre_proposta_obs'] = $return['obs'];

            $data['qtd_paineis'] = $return['qtd_modulos'];

            $data['potencia_instalada'] = $return['potencia_gerador'];

            $data['minima_area'] = $return['area_minima'];

            //[RF002-RN002]
            $data['valor_franqueadora'] = $return['total_investimento'];

            //Valor que a franqueada vai pagar
            $data['preco_medio_instalado'] = $return['total_investimento'];

            //Corrigir esse item Deixar pelo Banco
            $percentual = 0;

            $valorTotalEquipamentos = (float)$return['total_equipamentos'];
            if(Auth::user()->franquia->id == 14) {
                $percentualCabo = ParametroGeral::find(2);
                $percentual = $percentualCabo->parameter_one;
            }else{
                $percentual = 8;
            }

            if(Auth::user()->id == 53) {

                $percentual = 8;
            }

            //Prticipação
            $participacao = ($return['total_equipamentos'] / 100) * $percentual;

            //Royalties =
            $royalties = ($participacao /100 ) * 8;
            $data['royalties'] = $royalties;

            $porcentagemParticipacao = round(($participacao / 100 ) * 8,2);
            $data['imposto_sobre_participacao'] = $porcentagemParticipacao;

            //dd($porcentagemParticipacao);
            $data['produto1_preco'] = $return['valor_modulo'];
            //////////////

            //Valor da soma dos módulos
            $valor_mao_obra = $return['valor_mao_obra'];
            $valor_mao_obra < 4000 ? $valor_mao_obra =  4000.00 : $valor_mao_obra;

            $recalculoModulo = ($return['soma_modulos'] + $participacao + $valor_mao_obra + $porcentagemParticipacao)  / $return['qtd_modulos'];
            $data['produto1_preco'] =  round($recalculoModulo,2);
            $somaModulos = round($recalculoModulo * $data['qtd_paineis'],2);
            $data['produto1_nf'] = $somaModulos;
            $data['produto1'] = 'MODULO FV ' . $return['modulo_marca'] . " " . $return['modulo_potencia'] . "W";

            //Soma Inversor
            $data['qtd_inversores'] = count($return['inversores']);
            $somaInversor = $return['soma_inversor'];
            $data['produto2_nf'] = $somaInversor;
            $data['produto2_preco'] = $somaInversor;

            //Soma Estrutura
            $tipo_instalacao = $request->get('tipo_instalacao');
            $data['tipo_instalacao'] = $tipo_instalacao;

            $valorEstruturaSolo = 0;
            if($tipo_instalacao == 1){
                $valorEstruturaSolo = ($return['qtd_modulos'] /4) * 240 ;
            }

            $data['qtd_estrutura'] = 1;
            $somaEstrutura = $return['soma_estrutura'] + $valorEstruturaSolo;
            $data['produto3_nf'] =  $somaEstrutura;
            $data['produto3_preco'] =  $somaEstrutura;
            $data['produto3'] = 'ESTRUTURA';

            //Soma String
            $data['qtd_string_box'] = 1;
            $somaString = $return['soma_string'];
            $data['produto4_nf'] = $somaString;
            $data['produto4_preco'] = $somaString;
            $data['produto4'] = 'STRING BOX';

            //Kit Monitoramento
            $data['qtd_kit_monitoramento'] = 1 ;
            $somaString = $return['soma_string'];
            $data['produto5_nf'] = 0;
            $data['produto5_preco'] = 0;
            $data['produto5'] = 'KIT MONITORAMENTO WIFI';

            $data['valor_franquia'] = $participacao;

            $somaEquipamentos = $somaModulos + $somaInversor + $somaEstrutura + $somaString;
            $data['total_equipamentos'] = $somaEquipamentos;

            $data['preco_medio_instalado'] = $somaEquipamentos;

            //dd($data['produto1_nf']);
            $data['valor_modulo'] = $return['valor_modulo'];

            //Valor da equipe técnica + produto7_nf
            $data['equipe_tecnica'] = $valor_mao_obra;

            $data['produto2'] = $return['obs'];


            $data['co2'] = $return['co2'];
            $data['gera_fv_jan'] = $return['geracao_fv']['0'];
            $data['gera_fv_fev'] = $return['geracao_fv']['1'];
            $data['gera_fv_mar'] = $return['geracao_fv']['2'];
            $data['gera_fv_abr'] = $return['geracao_fv']['3'];
            $data['gera_fv_mai'] = $return['geracao_fv']['4'];
            $data['gera_fv_jun'] = $return['geracao_fv']['5'];
            $data['gera_fv_jul'] = $return['geracao_fv']['6'];
            $data['gera_fv_ago'] = $return['geracao_fv']['7'];
            $data['gera_fv_set'] = $return['geracao_fv']['8'];
            $data['gera_fv_out'] = $return['geracao_fv']['9'];
            $data['gera_fv_nov'] = $return['geracao_fv']['10'];
            $data['gera_fv_dez'] = $return['geracao_fv']['11'];

            $data['reducao_media_consumo'] = $return['reducao_media_consumo'];

            $data['total_servico_operacional'] = 0;

            $data['valor_franqueadora'] = $return['total_equipamentos'];

            $data['valor_descontos'] = 0.0;

            //Servicos Operacionais
            $data['qtd_mao_obra'] = 0;
            $data['produto7_preco'] =  0;
            $data['produto7_nf'] =  0;
            $data['produto7'] = 'MÃO-DE-OBRA DE INSTALAÇÃO (EQUIPE TÉCNICA)';

            $data['qtd_inst_pde'] = 0;
            $data['produto8_nf'] =  0;
            $data['produto8_preco'] =  0;
            $data['produto8'] = 'INSTALAÇÃO DE NOVO PDE';

            $data['qtd_mud_pde'] = 0;
            $data['produto9_nf'] =  0;
            $data['produto9_preco'] =  0;
            $data['produto9'] = 'MUDANÇA DE PDE';

            $data['qtd_substacao'] = 0;
            $data['produto10_nf'] =  0;
            $data['produto10_preco'] =  0;
            $data['produto10'] = 'SUBESTAÇÃO';

            $data['qtd_refor_estrutura'] = 0;
            $data['produto11_nf'] =  0;
            $data['produto11_preco'] =  0;
            $data['produto11'] = 'REFORÇO ESTRUTURAL';


            $preProposta = PreProposta::create($data);

            $produtoArray = $return['produtos'];

            foreach ($produtoArray as $produto) {
                PropostaProduto::create(['proposta_id' => $preProposta->id ,'produto_id' => $produto['id'],'quantidade' => $produto['quantidade'], 'valor_unitario' => $produto['valor_unitario']]);
                echo $produto['id'] .  " - " .$produto['quantidade'] . "<br>";
            }

            return redirect()->route('pre_proposta.pre_proposta.edit', $preProposta->id)
                ->with('success_message', 'Cadastro realizado com sucesso');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified pre proposta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id){
        $prioridades = Prioridade::pluck('name','id')->all();
        $preProposta = PreProposta::with('user','cliente', 'cidade', 'bancoFinanciadora', 'projetov2', 'produtos')->findOrFail($id);
        $estados = Estado::pluck('nome','id')->all();
        $modulos = Modulo::pluck('potencia','id')->all();
        $bfs = BancoFinanciadora::pluck('nome','id')->all();
        if($preProposta->cidade_id){
            $cidades = Cidade::where('estado_id', '=', $preProposta->cidade->estado_id)->pluck('nome','id');
        }else{
            $cidades = Cidade::where('estado_id', '=', '1')->pluck('nome','id');
        };
        $users = User::orderBy('name')->orderBy('name','asc')->pluck('name','id')->all();
        $Clientes = Cliente::pluck('nome','id')->all();
        //dd($preProposta);
        return view('pre_proposta.edit', compact('users','preProposta','Clientes', 'estados', 'cidades', 'bfs', 'modulos', 'prioridades'));
    }

    /**
     * Update the specified pre proposta in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PrePropostaFormRequest $request)
    {
        try {

            $data = $this->getData($request);

            $preProposta = PreProposta::findOrFail($id);

            $participacao =  $data['valor_franquia'];
            $porcentagemParticipacao = round(($participacao / 100 ) * 8,2);

            $descontoFranquia = $data['valor_descontos'];

            //Royalties =
            $royalties = (($participacao - $descontoFranquia) /100 ) * 8;
            $data['royalties'] = $royalties;

            $data['imposto_sobre_participacao'] = $porcentagemParticipacao;

            // Recalcula o valor dos módulos
            $recalculoModulo = (($data['valor_modulo'] *  $data['qtd_paineis'] ) + $data['valor_franquia'] + $data['equipe_tecnica'] + $porcentagemParticipacao) / $data['qtd_paineis'];
            $somaModulos = round($recalculoModulo,2) * $data['qtd_paineis'];
            $data['produto1_preco'] =  round($recalculoModulo,2);
            $data['produto1_nf'] = $somaModulos;
            // FIM Recalcula o valor dos módulos

            //Calculo do valor Total dos equipamentos
            $user = User::find(Auth::id());
            if($user->hasRole('super-admin')) {
                $data['produto2'] = $request->get('produto2');
                $data['qtd_inversores'] = $request->get('qtd_inversores');
                $produto2_nf = $request->get('produto2_nf');
                $data['produto2_nf'] = $produto2_nf;
                $data['produto2_preco'] = $produto2_nf;
                $valorInversor = $produto2_nf;
            }else{
                $valorInversor = $this->convertesRealIngles($preProposta->produto2_nf);

            }

            $somaEquipamentos = $valorInversor
            //$somaEquipamentos = $this->convertesRealIngles($preProposta->produto2_nf)
                + $this->convertesRealIngles($preProposta->produto3_nf)
                + $this->convertesRealIngles($preProposta->produto4_nf)
                + $this->convertesRealIngles($preProposta->produto5_nf)
                + $somaModulos;
            $data['total_equipamentos'] = $somaEquipamentos;
            //FIM Calculo do valor Total dos equipamentos

            //Servicos Operacionais
            $maoObra            = $data['produto7_nf'];
            $instalacaoPDE      = $data['produto8_nf'];
            $mudancaPDE         = $data['produto9_nf'];
            $substacao          = $data['produto10_nf'];
            $reforcoEstrutural  = $data['produto11_nf'];
            $somaServicosOperacionais = $data['total_servico_operacional'];
            //Fim Servicos Operacionais

            //dd($somaEquipamentos, (float)$somaServicosOperacionais, (float)$descontoFranquia);
            $totalInvestimento = $somaEquipamentos + (float)$somaServicosOperacionais - (float)$descontoFranquia ;
            $data['preco_medio_instalado'] = $totalInvestimento;


            //[RF002-RN002]
            $valor_franquia = $data['valor_franquia'];
            $equipe_tecnica = $data['equipe_tecnica'];
            $valor_modulo   = $data['valor_modulo'];

            /*
             * Valor da franquia (quantidade modulo * valor Modulo ) + inversor + Estrutura + String Box + kit Monitoramentep
             */
            $data['valor_franqueadora'] = $valorInversor
                + $this->convertesRealIngles($preProposta->produto3_nf)
                + $this->convertesRealIngles($preProposta->produto4_nf)
                + $this->convertesRealIngles($preProposta->produto5_nf)
                + ((int)$data['valor_modulo'] * $data['qtd_paineis']);


            $roi = $this->roi(0, $totalInvestimento, $preProposta->monthly_usage );
            $data['roi'] = $roi;



            $ParametrRoi = ParametroGeral::where('id', '=', '1')->first();

            if ($descontoFranquia > $participacao ){
                return back()->withInput()
                    ->withErrors(['error_message' => "Desconto não pode ser maior que o valor da participação"]);
            }
           // dd($roi );

            if ($roi > 4.2 && $preProposta->monthly_usage > 1300){
                return back()->withInput()
                    ->withErrors(['error_message' => "Projeto não pode ser editado, o Retorno sobre o Investimento (ROI) é maior que 48 meses ou 4.2 anos"]);
            }


            if ($roi > 4.5 && $preProposta->monthly_usage > 700 && $preProposta->monthly_usage < 1300){
                return back()->withInput()
                    ->withErrors(['error_message' => "Projeto não pode ser editado, o Retorno sobre o Investimento (ROI) é maior que 42 meses ou 4.5 anos"]);
            }

            //dd($roi);
            if ($roi > 5.8 && $preProposta->monthly_usage < 700){
                return back()->withInput()
                    ->withErrors(['error_message' => "Projeto não pode ser editado, o Retorno sobre o Investimento (ROI) é maior que 70 meses ou 5.8 anos"]);
            }
            $preProposta->update($data);

            return redirect()->route('pre_proposta.pre_proposta.edit', $preProposta->id)
                ->with('success_message', 'Cadastro atualizado com sucesso');

        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['unexpected_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified pre proposta from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $preProposta = PreProposta::findOrFail($id);
            $preProposta->delete();

            return redirect()->route('pre_proposta.pre_proposta.index')
                ->with('success_message', 'Pre Proposta was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function listProducts(Request $request)
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('projetosv2 as p')
            ->join('pre_propostas as pre', 'pre.id', '=', 'p.proposta_id')
            ->join('proposta_produtos as pp', 'pre.id', '=', 'pp.proposta_id')
            ->join('produtos as prod', 'prod.id', '=', 'pp.produto_id' )
            ->join('clientes as cl', 'cl.id', '=', 'pre.cliente_id')
            ->groupBy('pre.codigo')
            ->select([
                'pre.id',
                'cl.nome',
                'pre.preco_medio_instalado',
                'pre.codigo',

            ]);


        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {


            })

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">   
                                <a href="/report/'.$row->id.'/proposta" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>  
                                                      
                        </form>
                        ';
            })->make(true);
    }

    public function listProductsIndex()
    {
        return view('logistica.entrega.index');
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->only([
            'codigo',
            'user_id',
            'baco_fin_id',
            'modulo_id',
            'prioridade_id',
            'data_validade',
            'power',
            'monthly_usage',
            'valor_modulo',
            'equipe_tecnica',
            'qtd_paineis' ,
            'total_equipamentos',
            'total_servico_operacional',
            'desconto_equipamentos',
            'valor_franquia',
            'minima_area',
            'economia_anula',
            'preco_kwh',
            'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'panel_potencia',
            'na_ponta_jan',
            'na_ponta_feb',
            'na_ponta_mar',
            'na_ponta_apr',
            'na_ponta_may',
            'na_ponta_jun',
            'na_ponta_jul',
            'na_ponta_aug',
            'na_ponta_sep',
            'na_ponta_oct',
            'na_ponta_nov',
            'na_ponta_dec',
            'cidade_id',
            'qtd_homologacao', 'produto6_preco', 'produto6_nf',
            'qtd_mao_obra', 'produto7_preco', 'produto7_nf',
            'qtd_inst_pde', 'produto8_preco', 'produto8_nf',
            'qtd_mud_pde', 'produto9_preco', 'produto9_nf',
            'qtd_substacao', 'produto10_preco', 'produto10_nf',
            'qtd_refor_estrutura', 'produto11_preco', 'produto11_nf',
            'qtd_homologacao_projeto', 'produto12_preco', 'produto12_nf',
            'entrada1_valor',
            'recurso1_banco',
            'entrada2_valor',
            'recurso2_banco',
            'entrada3_valor',
            'qtd_parcelas_entrada2',
            'recurso_proprio',
            'valor_vencimento',
            'estar_finalizado',
            'data_financiamento_bancario',
            'tempo_carencia',
            'data_prevista_parcela',
            'valor_descontos',
            'pre_proposta_obs',
            'pendencia_obs',
            'pendencia',
            'valor_mao_obra'

            ]);

        return $data;
    }

}

