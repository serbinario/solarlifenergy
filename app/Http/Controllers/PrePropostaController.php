<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Cidade;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Estado;
use Serbinario\Entities\PreProposta;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\PrePropostaFormRequest;
use Serbinario\Traits\Simulador;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class PrePropostaController extends Controller
{
    use Simulador;

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
        $prePropostas = PreProposta::with('cliente')->paginate(25);

        return view('pre_proposta.index', compact('prePropostas'));
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
            ->select([
                'users.name',
                'pre_propostas.codigo',
                'pre_propostas.id',
                \DB::raw('DATE_FORMAT(pre_propostas.data_validade,"%d/%m/%Y") as data_validade'),
                'pre_propostas.preco_medio_instalado',
                'clientes.nome',
                'clientes.nome_empresa',
                'clientes.cpf_cnpj',
                'clientes.email',
                'clientes.celular',
                \DB::raw('DATE_FORMAT(pre_propostas.created_at,"%d/%m/%Y") as created_at'),
                \DB::raw('DATE_FORMAT(pre_propostas.updated_at,"%d/%m/%Y") as updated_at'),

            ]);
        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if(!$user->hasRole('admin')) {
            $rows->where('pre_propostas.user_id', '=', $user->id);
        }

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('clientes.nome', 'like', "%" . $request->get('nome') . "%");
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
            })


            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                          
                                <a href="preProposta/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="/report/'.$row->id.'/PreProposta" class="btn btn-primary" target="_blank" title="Pré-Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>
                                <button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
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
        $Clientes = Cliente::pluck('nome','id')->all();
        $estados = Estado::pluck('nome','id')->all();

        $cidades = Cidade::where('estado_id', '=', '1')->pluck('nome','id');


        return view('pre_proposta.create', compact('Clientes', 'estados', 'cidades'));
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
            $last = \DB::table('pre_propostas')->orderBy('id', 'DESC')->first();
            if($last == NULL){

                $data['codigo'] = date("y") . "00001";
            }else{
                $codigo = $last->codigo +1;
                $data['codigo'] = $codigo;
            }

            //dd($data);
            //Coloquei essa opçao pois quando um usuario nao e adm o formulario não manda o id do user pois esta
            // em somente leitura
            if(empty($data['users_id'])){
                $data['users_id'] = Auth::id();
            }

            /*
             * Regra de negócio do simulador
             */

            $return = $this->simularGeracao($request->get('cidade_id'), (int)$request->get('monthly_usage'));

            $data['qtd_paineis'] = $return['qtd_modulos'];

            $data['potencia_instalada'] = $return['potencia_gerador'];

            $data['minima_area'] = $return['area_minima'];


            $data['total_nvestimento'] = $return['total_nvestimento'];

            $data['produto1_nf'] = $return['soma_modulos'];
            $data['produto1_preco'] = $return['valor_modulo'];

            $data['produto2_nf'] = $return['soma_inversor'];
            $data['produto2_preco'] = $return['soma_inversor'];

            $data['produto3_nf'] = $return['soma_estrutura'];
            $data['produto3_preco'] = $return['soma_estrutura'];


            $data['produto4_nf'] = $return['soma_infra'];
            $data['produto4_preco'] = $return['soma_infra'];

            $data['produto5_nf'] = $return['soma_kit'];
            $data['produto5_preco'] = $return['soma_kit'];

            //dd($data);

            $preProposta = PreProposta::create($data);
            dd($return);
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
    public function edit($id)
    {
        //dd($id);
        $preProposta = PreProposta::with('cliente', 'cidade')->findOrFail($id);
        $estados = Estado::pluck('nome','id')->all();
        if($preProposta->cidade_id){
            $cidades = Cidade::where('estado_id', '=', $preProposta->cidade->estado_id)->pluck('nome','id');
        }else{
            $cidades = Cidade::where('estado_id', '=', '1')->pluck('nome','id');
        };
        //dd($preProposta);


        $Clientes = Cliente::pluck('nome','id')->all();

        return view('pre_proposta.edit', compact('preProposta','Clientes', 'estados', 'cidades'));
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

            $preProposta->update($data);

            return redirect()->route('pre_proposta.pre_proposta.edit', $preProposta->id)
                ->with('success_message', 'Cadastro atualizado com sucesso');

        } catch (Exception $e) {
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
            'data_validade',
            'power',
            'monthly_usage',
            'preco_medio_instalado',
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
            'produto1', 'qtd_paineis' ,'produto1_preco', 'produto1_nf',
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
            ]);

        return $data;
    }

}
