<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\BancoFinanciadora;
use Serbinario\Entities\Cidade;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Estado;
use Serbinario\Entities\Modulo;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Prioridade;
use Serbinario\Entities\Report;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\PrePropostaFormRequest;
use Serbinario\Traits\Simulador;
use Serbinario\Traits\SimuladorV2;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class PropostaController extends Controller
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
        //$this->middleware('auth');
    }


    /**
     * Display a listing of the pre propostas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        //$reports = Report::where('group', '=', 'propostas');
        //$prePropostas = PreProposta::with('cliente')->paginate(25);

        //return view('pre_proposta.index', compact('prePropostas', 'reports'));
        return view('proposta.index');
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
            ->leftJoin('prioridades', 'prioridades.id', '=', 'pre_propostas.prioridade_id')
            ->select([
                'users.name',
                'pre_propostas.codigo',
                'pre_propostas.id',
                'pre_propostas.pendencia',
                'pre_propostas.pendencia_obs',
                \DB::raw('DATE_FORMAT(pre_propostas.data_validade,"%d/%m/%Y") as data_validade'),
                'pre_propostas.preco_medio_instalado',
                'clientes.nome',
                'clientes.nome_empresa',
                'clientes.cpf_cnpj',
                'clientes.email',
                'clientes.celular',
                'prioridades.name as prioridade',
                'projetosv2.id as projeto',
                \DB::raw('DATE_FORMAT(pre_propostas.created_at,"%d/%m/%Y") as created_at'),
                \DB::raw('DATE_FORMAT(pre_propostas.updated_at,"%d/%m/%Y") as updated_at'),

            ]);

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
                    $query->where('clientes.nome_empresa', 'like', "%" . $request->get('nome') . "%")
                        ->orWhere('clientes.nome', 'like', "%" . $request->get('nome') . "%");
                }
                if ($request->has('data_ini')) {
                    $tableName = $request->get('filtro_por');
                    $query->whereBetween('pre_propostas.' . $tableName, [$request->get('data_ini'), $request->get('data_fim')])->get();
                }
                if ($request->has('codigo')) {
                    $query->where('pre_propostas.codigo', 'like', "%" . $request->get('codigo') . "%");
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

                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
                //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
                $user = User::find(Auth::id());
                if($user->hasRole('franquia')) {
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }
                if($user->hasRole('integrador')) {
                    $query->where('clientes.user_id', '=', $user->id);
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }

                $query->whereNull('pre_propostas.arquivado');

            })


            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                          
                                <a href="preProposta/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="/report/'.$row->id.'/proposta" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>  
                                <a href="#" class="btn btn-primary arquivar"  title="Arquivar">
                                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                                </a>                            
                        </form>
                        ';
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
        $modulos = Modulo::pluck('potencia','id')->all();
        $bfs = BancoFinanciadora::pluck('nome','id')->all();

        $cidades = Cidade::where('estado_id', '=', '1')->pluck('nome','id');

        //Só pode ver os usuários da própria franquia
        $franquia_id = Auth::user()->franquia_id;
        $users = User::where('franquia_id' , '=', $franquia_id)->orderBy('name')->orderBy('name','asc')->pluck('name','id')->all();

        return view('proposta.create', compact('Clientes', 'users','estados', 'cidades', 'bfs', 'modulos', 'prioridades'));
    }

    /**
     * Store a new pre proposta in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $return = $this->simularGeracao($request);

        //dd($return;

        $percentual = 0;
        switch ($return['total_equipamentos']){
            case $return['total_equipamentos'] < 20000  ;
                $percentual = 7;
                break;
            case $return['total_equipamentos'] < 40000  ;
                $percentual = 7;
                break;
            case $return['total_equipamentos'] < 100000  ;
                $percentual = 5;
                break;
            case $return['total_equipamentos'] < 160000  ;
                $percentual = 5;
                break;
            case $return['total_equipamentos'] < 240000  ;
                $percentual = 4;
                break;
            case $return['total_equipamentos'] < 350000  ;
                $percentual = 4;
                break;
            case $return['total_equipamentos'] < 650000  ;
                $percentual = 3;
                break;
            default;
                $percentual = 2;
        }




        echo "Valor Médio KWh = " . $return['valor_kw']. "<br>";
        echo "Modulos    " . $return['modulo_potencia']. " " . $return['modulo_marca'] .  " qtd= " . $return['qtd_modulos'] . " Valor= " .  $return['valor_modulo'] . " Total= " . $return['soma_modulos'] . "<br>";
        echo "Inversores " .  "qtd= " . $return['qtd_inversores'] . " Valor= " .  $return['soma_inversor'] . " Total= " . $return['soma_inversor']. "<br>";
        echo "Estrutura  " .  "qtd= " . 1 . " Valor= " .  $return['soma_estrutura'] . " Total= " . $return['soma_estrutura']. "<br>";
        echo "String     " .  "qtd= " . 1 . " Valor= " .  $return['soma_string'] . " Total= " . $return['soma_string']. "<br>";
        $kit = $return['soma_string'] + $return['soma_estrutura'] + $return['soma_inversor'] + $return['soma_modulos'];
        echo "Kit  " . $kit . "<br>";

        echo "Mão de Obra = " .$return['valor_mao_obra_por_modulo']. "<br>";
        echo "Mão de Obra Total=  " . $return['valor_mao_obra'] . "<br>";

        $totalGeral = $kit + $return['valor_mao_obra'] ;

        $participacao = round((($totalGeral / 100 ) * $percentual),2);

        echo "Participação " . $participacao . "<br>";

        $totalGeral = (float)$totalGeral + (float)$participacao;

        echo  "<br>" . "Total  =  " . $totalGeral. "<br>";

        echo "Área minima " . $return['area_minima'] . "<br>";


         echo "ROI (Total do Projeto / (valor Medio * 0.8 / 12))= " . $this->roi(0.8, $totalGeral, $return['valor_kw']). "<br>";

         //echo "1;0;0;1";



         $filtroArray = array();
         foreach ($return['inversores'] as $inversor){
             array_push($filtroArray,  $inversor['potenciaInversor']);
         }

         $filtroArray = array_count_values($filtroArray);
         isset($filtroArray['5'])? $k5 = $filtroArray['5']: $k5 = 0;
         isset($filtroArray['12'])? $k12 = $filtroArray['12']: $k12 = 0;
         isset($filtroArray['15'])? $k15 = $filtroArray['15']: $k15 = 0;
         isset($filtroArray['20'])? $k20 = $filtroArray['20']: $k20 = 0;
         isset($filtroArray['30'])? $k30 = $filtroArray['30']: $k30 = 0;

        // dd($k5, $k12, $k15, $k20, $k30, $return['inversores']);

        //dd($return);

        echo "<br>";

        echo $k5 . ";" . $k12 . ";" . $k15 . ";" . $k20 . ";" . $k30 . ";" . $return['modulo_potencia'] . ";"
            . number_format($return['potencia_gerador'],2,",",".") . ";"
            . $return['qtd_modulos'] . ";"
            . number_format($return['soma_estrutura'],2,",",".") . ";"
            . number_format($return['soma_string'],2,",",".")  . ";"
            . $return['valor_kw'] . ";"
            . number_format($kit,2,",",".") . ";"
            . number_format($return['valor_mao_obra'],2,",",".") . ";"
            . number_format($participacao,2,",",".") ;
        ;



        dd($return);


    }

    private function roi($precoKwh, $totalInvestimento, $valor_medio_kw){

        return round($totalInvestimento / ((float)$valor_medio_kw  * 0.79 * 12)  , 1);

    }

    /**
     * Show the form for editing the specified pre proposta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id){

        dd($id);
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

            $return = $this->simularGeracao($request);
            //dd($return);
            $data['panel_potencia'] = $return['modulo_potencia'];

            $data['qtd_paineis'] = $return['qtd_modulos'];


            $data['potencia_instalada'] = $return['potencia_gerador'];

            $data['minima_area'] = $return['area_minima'];

            $data['entrada2_valor'] = $request->get('entrada2_valor');

            $data['produto1_nf'] = $return['soma_modulos'];
            $data['produto1_preco'] = $return['valor_modulo'];

            $data['qtd_inversores'] = $return['qtd_inversores'];
            $data['produto2_nf'] = $return['soma_inversor'];
            $data['produto2_preco'] = $return['soma_inversor'];

            $data['produto3_nf'] = $return['soma_estrutura'];
            $data['produto3_preco'] = $return['soma_estrutura'];

            $data['produto4_nf'] = $return['soma_infra'];
            $data['produto4_preco'] = $return['soma_infra'];

            $data['produto5_nf'] = $return['soma_kit'];
            $data['produto5_preco'] = $return['soma_kit'];

            $data['produto7_nf'] = $return['valor_mao_obra'];
            $data['produto7_preco'] = $return['valor_mao_obra'];

            $data['co2'] = $return['co2'];
            //dd($data);
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
            //$data['reducao_media_consumo'] = $request->get('reducao_media_consumo');

            $data['total_equipamentos'] = $return['total_equipamentos'];

            $data['valor_franqueadora'] = $return['valor_franqueadora'];


            $data['total_servico_operacional'] =
                floatval($request->get('produto6_nf'))
                + floatval($request->get('produto7_nf'))
                + floatval($request->get('produto8_nf'))
                + floatval($request->get('produto9_nf'))
                + floatval($request->get('produto10_nf'))
                + floatval($request->get('produto11_nf'));


            //Valor que a franqueada vai pagar
            $data['preco_medio_instalado'] = $request->get('preco_medio_instalado');


            if ($return['qtd_modulos'] < 20){
                return redirect()->route('pre_proposta.pre_proposta.edit', $preProposta->id)
                    ->withErrors(['error_message' => "Projeto não pode ser alterado, quantidade de módulos é menor que 20"]);
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


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->only(['cliente_id',
            'codigo',
            'user_id',
            'baco_fin_id',
            'modulo_id',
            'prioridade_id',
            'data_validade',
            'power',
            'monthly_usage',
            'qtd_paineis' ,
            'preco_medio_instalado',
            'total_equipamentos',
            'total_servico_operacional',
            'potencia_instalada',
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
            'produto1','produto1_preco', 'produto1_nf',
            'produto2', 'qtd_inversores','produto2_preco', 'produto2_nf',
            'produto3', 'qtd_estrutura',  'produto3_preco', 'produto3_nf',
            'produto4', 'qtd_string_box', 'produto4_preco', 'produto4_nf',
            'produto5', 'qtd_kit_monitoramento', 'produto5_preco', 'produto5_nf',
            'qtd_homologacao', 'produto6_preco', 'produto6_nf',
            'qtd_mao_obra', 'produto7_preco', 'produto7_nf',
            'qtd_inst_pde', 'produto8_preco', 'produto8_nf',
            'qtd_mud_pde', 'produto9_preco', 'produto9_nf',
            'qtd_substacao', 'produto10_preco', 'produto10_nf',
            'qtd_refor_estrutura', 'produto11_preco', 'produto11_nf',
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
