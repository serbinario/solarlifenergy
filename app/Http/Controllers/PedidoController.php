<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Vendas\Pedido;
use Serbinario\Entities\Vendas\Produto;
use Serbinario\User;
use Exception;
use Yajra\DataTables\DataTables;

class PedidoController extends Controller
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
     * Display a listing of the profiles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('vendas.index');
    }

    /**
     * Display a listing of the profiles.
     *
     * @return Illuminate\View\View
     */
    public function indexPedido(Request $request)
    {
        return view('vendas.pedidos');
    }


    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid(Request $request)
    {

        $rows = \DB::table('pedidos')
            ->leftJoin('pedido_produto', 'pedido_produto.pedido_id', '=', 'pedidos.id')
            ->leftJoin('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('pedido_status', 'pedido_status.id', '=', 'pedidos.pedido_status_id')
            ->join('users', 'users.id', '=', 'pedidos.user_id')
            ->groupBy('pedidos.id')
            ->select([
                'users.name',
                'pedidos.id',
                'pedidos.cliente',
                \DB::raw('DATE_FORMAT(pedidos.created_at,"%d/%m/%Y") as created_at'),
                'faturado_por',
                'pedido_status.status',
                \DB::raw('SUM(pedido_produto.valor_total) as total')
            ]);

        $user = User::find(Auth::id());
        if($user->hasRole('revenda')) {
            $rows->where('pedidos.user_id', '=', Auth::user()->id);
        }

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {

            })

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="cliente/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                
                               <a  href="#" class="btn btn-primary edit" title="Edit">
                                    <span id="' . $row->id . '" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                            </div>
                        </form>
                        ';
            })->make(true);

    }



    public function getPedido(Request $request)
    {

        $id = $request->get('id');
        $rows = \DB::table('pedidos')
            ->leftJoin('pedido_produto', 'pedido_produto.pedido_id', '=', 'pedidos.id')
            ->leftJoin('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->select([
                'produtos.produto',
                'pedido_produto.quantidade',
                'pedido_produto.valor_unitario',
                'pedido_produto.valor_total',
            ])
            ->where('pedidos.id', '=', $id)
        ;
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return  response()->json($rows->get(), 200, $header,  JSON_UNESCAPED_UNICODE);
    }

    public function updatePedido(Request $request)
    {
        $produto_id = $request->get('produto_id');
        $pedido_status_id = $request->get('pedido_status_id');

        $pedito = Pedido::find($produto_id);
        $pedito->update([ 'pedido_status_id' => $pedido_status_id ] );
        return \Illuminate\Support\Facades\Response::json(['success' => true]);
    }

    public function getAllProducts()
    {
        $rows = \DB::table('produtos')
            ->Join('grupos', 'grupos.id', '=', 'produtos.grupo_id')
            ->Join('marcas', 'marcas.id', '=', 'produtos.marca_id')
            ->select([
                'produtos.id',
                'produto',
                'preco_revenda',
                'produtos.ativo',
                'estoque',
                'grupos.grupo',
                'grupos.id as grupo_id',
                'marcas.marca'

            ]);
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return  response()->json($rows->get(), 200, $header,  JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

    }

    /**
     * Store a new profile in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $orcamento = json_decode($request->getContent(), true);
            //dd($orcamento);
            $products =  $orcamento['data'];

            $cliente = $orcamento['cliente'];

            $userId = Auth::id();

            $pedido = Pedido::create([ 'user_id' => $userId, 'faturado_por' => $orcamento['faturamento'], 'pedido_status_id' => 1, 'cliente' => $cliente ]);

            foreach ($products as $key => $product)
            {
                $produto = \DB::table('produtos')->where('id', '=', $product['produto_id'])->first();
                $valor_total = (float)$produto->preco_revenda * $product['qtd'];
                $pedido->produtos()->attach($key, [ 'produto_id' => $product['produto_id'], 'quantidade' => $product['qtd'], 'valor_unitario' => $produto->preco_revenda, 'valor_total' =>  $valor_total]);
            }

            return response()->json(['success' => true, 'msg' => 'Pedido criado com sucesso']);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Pedido não pode ser criado']);
        }
    }

    /**
     * Display the specified profile.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $profile = Profile::with('pool')->findOrFail($id);

        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified profile.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $franquias = Franquia::pluck('nome','id')->all();
        $user = User::with('roles', 'franquia')->findOrFail($id);
        //dd($user);
        $roles = \Spatie\Permission\Models\Role::pluck('name','id')->all();

        //dd($user->roles[0]->id);
        return view('users.edit', compact('user', 'roles', 'franquias'));

    }

    /**
     * Update the specified profile in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     * Exemplos
     * https://scotch.io/tutorials/user-authorization-in-laravel-54-with-spatie-laravel-permission
     */
    public function update($id, UserFormRequest $request)
    {
        try {

            //$this->affirm($request);
            $data = $request->getData();

            $user = User::findOrFail($id);

            if(empty($data['password'])){
                $data['password'] = $user->password;
            }else{
                $data['password'] = \Hash::make($data['password']);
            }

            $user->update($data);
            //dd($user);
            //Retora o id do ROLE
            $role_r =  \Spatie\Permission\Models\Role::where('id', '=', $data['role'])->first();
            $user->syncRoles($role_r);

            return redirect()->route('users.user.edit', $user->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified profile from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            //dd($user);
            //Retora o id do ROLE
            $role_r =  \Spatie\Permission\Models\Role::where('model_id', '=', $user->id)->first();
            $user->syncRoles($role_r);

            return redirect()->route('users.user.index')
                ->with('success_message', 'Profile was successfully deleted!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
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
        $data = $request->only(['name', 'email', 'password', 'role', 'franquia_id']);

        return $data;
    }

}
