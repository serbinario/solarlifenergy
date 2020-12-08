<?php

namespace Serbinario\Http\Controllers\Financeiro;


//meu teste

use Serbinario\Entities\Financeiro\Category;
use Serbinario\Entities\Financeiro\Contas;
use Serbinario\Entities\Financeiro\ContasPagarReceber;
use Serbinario\Entities\Financeiro\ContasPagarReceberDetalhe;
use Serbinario\Entities\Projetov2;
use Serbinario\Entities\ReportLayout;
use Serbinario\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Contrato;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\Projeto;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\ContratoFormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class ContasPagarReceberController extends Controller
{
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
     * Display a listing of the contratos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('financeiro.index');
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
        $rows = \DB::table('fin_contas_pagar_receber as pg')
            ->leftJoin('fin_contas_pagar_receber_detalhe as detalhe', 'detalhe.conatas_pagar_receber_id', '=', 'pg.id')
            ->leftJoin('fin_tipo AS tipo', 'tipo.id', '=', 'pg.tipo_id')
            ->leftJoin('fin_status', 'detalhe.status_id', '=', 'fin_status.id')
            ->leftJoin('fin_contas', 'pg.conta_id', '=', 'fin_contas.id')
            ->leftJoin('fin_category AS category', 'category.id', '=', 'pg.category_id')
            ->leftJoin('fin_fornecedor AS fornecedor', 'fornecedor.id', '=', 'pg.fonecedor_id')
            ->leftjoin('users', 'users.id', '=', 'pg.user_id')
            ->select([
                'pg.id',
                'category.name',
                'pg.descricao',
                'pg.valor_total',
                'detalhe.parcela_numero',
                'pg.qtd_parcelas',
                'pg.data_emissao',
                'data_primeiro_vencimento',
                \DB::raw('DATE_FORMAT(detalhe.data_vence,"%d/%m/%Y") as data_vence'),
                \DB::raw('DATE_FORMAT(detalhe.data_pago,"%d/%m/%Y") as data_pago'),
                'detalhe.valor_parcela',
                'detalhe.desconto',
                'detalhe.juros',
                'fin_contas.name as conta',
                'fin_status.name',
                'fin_status.id as status',
                'fornecedor.name'
            ]);
        $user = User::find(Auth::id());
        if($user->hasRole('franquia')) {
           // $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
        }

        #Editando a grid
        return Datatables::of($rows)

            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('clientes.nome_empresa', 'like', "%" . $request->get('nome') . "%");
                }
                $user = User::find(Auth::id());
                if($user->hasRole('franquia')) {
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }
            })

            ->addColumn('action', function ($row) {

            if($row->status ==1 ){
                return '<a href="#" title="Pago">
                         <i class="icon i20 icon-22"></i> 
                    </a>';
            }else{
                return '<a href="#"  title="Aguardando">
                         <i class="icon i20d icon-22"></i> 
                    </a>';
            }



        })->make(true);
    }

    /**
     * Show the form for creating a new contrato.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $projetos = Projeto::pluck('projeto_codigo','id')->all();
        $layouts = ReportLayout::pluck('nome', 'id')->all();
        //$franquia = Franquia::pluck('id','id')->all();
        //$creators = User::pluck('name','id')->all();
        //$updaters = User::pluck('name','id')->all();

        return view('contrato.create', compact('projetos', 'layouts'));
    }

    /**
     * Store a new contrato in the storage.
     *
     * @param Serbinario\Http\Requests\ContratoFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            if(empty($request->get('qtd_parcelas'))){
                $qtdParcelas = 1;
            }else{
                $qtdParcelas = $request->get('qtd_parcelas');
            }

            $conta = ContasPagarReceber::create([
                'descricao' => $request->get('description'),
                'projeto_id' => $request->get('projeto_id'),
                'conta_id' => $request->get('conta_id'),
                'category_id' => $request->get('category_id'),
                'tipo_id' => $request->get('tipo_id'),
                'data_primeiro_vencimento' => $request->get('data_vencimento'),
                'valor_total' => $request->get('valor'),
                'obs' => $request->get('lancamento_obs'),
                'qtd_parcelas' => $qtdParcelas,
            ]);




            $data_vencimento = $request->get('data_vencimento');

            for($i = 1; $qtdParcelas+1 > $i; $i++ ){

                $valor = $request->get('valor') / $qtdParcelas;

                ContasPagarReceberDetalhe::create([
                    'conatas_pagar_receber_id' => $conta->id,
                    'data_vence' => $data_vencimento,
                    'status_id' => $request->get('status_id'),
                    'valor_parcela' => $valor,
                    'parcela_numero' => $i,

                ]);

                $the_date = strtotime( $data_vencimento);
                $data_vencimento = date("Y-m-d", strtotime('+1 month', $the_date));
            }


            return response()->json( [ 'success' => 'ok',  'msg' => 'ok', 'qtd_parcelas' => $data_vencimento] );

        } catch (Exception $e) {
            return response()->json( [
                'message' => $e->getMessage(), 'erro' => $data_vencimento] );

        }
    }



    /**
     * Show the form for editing the specified contrato.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $contrato = Contrato::with('reportLayout')->findOrFail($id);
        $projetos = Projeto::pluck('projeto_codigo','id')->all();
        $layouts = ReportLayout::pluck('nome', 'id')->all();
        //dd($contrato);

        return view('contrato.edit', compact('contrato','projetos', 'layouts'));
    }

    /**
     * Update the specified contrato in the storage.
     *
     * @param  int $id
     * @param Serbinario\Http\Requests\ContratoFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ContratoFormRequest $request)
    {
        try {

            $data = $request->getData();
            $data['updated_by'] = Auth::Id();
            $data['franquia_id'] = Auth::user()->franquia->id;
            //dd($data);
            $contrato = Contrato::findOrFail($id);
            $contrato->update($data);

            return redirect()->route('contrato.contrato.edit', $contrato->id)
                ->with('success_message', 'Contrato atulizado com sucessp!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified contrato from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $contrato = Contrato::findOrFail($id);
            $contrato->delete();

            return redirect()->route('contrato.contrato.index')
                ->with('success_message', 'Contrato was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function paramsDefault(){
        $categories = Category::select('name', 'id', 'parent_id')->get()->toArray();
        $categoriesReceita = Category::select('name', 'id')->where('parent_id', '=', '12')->get()->toArray();
        $categoriesDespesa = Category::select('name', 'id')->where('parent_id', '=', '11')->get()->toArray();
        $contas = Contas::select('name', 'id')->get()->toArray();
        return response()->json( [
            'categoryReceita' => $categoriesReceita,
            'categoryDespesas' => $categoriesDespesa,
            'contas' =>$contas,
            'categories' => $categories
        ] );
    }

    public function getData(Request $request)
    {
        $data = $this->only(['description', 'projeto_id', 'valor', 'data_vencimento', 'contas', 'category', 'lancamento_obs']);
        return $data;
    }



}
