<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Carbon\Carbon;
use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\MeioCaptacao;
use Serbinario\Entities\Projeto;
use Serbinario\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Serbinario\Http\Requests\ClienteFormRequest;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class ClienteController extends Controller
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
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index(){
        $clientes = Cliente::paginate(25);

        return view('cliente.index', compact('clientes'));
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
        $rows = \DB::table('clientes')
            ->leftJoin('pre_propostas', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->join('users', 'clientes.user_id', '=', 'users.id')
            ->groupBy('clientes.id')
            ->select([
                'clientes.id',
                'clientes.nome',
                'clientes.nome_empresa',
                'clientes.cpf_cnpj',
                'clientes.email',
                'clientes.celular',
                'users.franquia_id',
                \DB::raw('DATE_FORMAT(clientes.created_at,"%d/%m/%Y") as created_at'),
                \DB::raw('COUNT(pre_propostas.id) as propostas')
            ]);

        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if(!$user->hasRole('admin')) {
           $rows->where('clientes.user_id', '=', $user->id);
           $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);
        }
        $rows->where('users.franquia_id', '=', Auth::user()->franquia->id);


        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('nome_empresa', 'like', "%" . $request->get('nome') . "%")
                        ->orWhere('nome', 'like', "%" . $request->get('nome') . "%");
                }
                if ($request->has('data_ini')) {
                    $tableName = $request->get('filtro_por');
                    $query->whereBetween('clientes.' . $tableName, [$request->get('data_ini'), $request->get('data_fim')])->get();
                }
                //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
                $user = User::find(Auth::id());
                if(!$user->hasRole('admin')) {
                    $query->where('clientes.user_id', '=', $user->id);
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }
                $query->where('users.franquia_id', '=', Auth::user()->franquia->id);

                /*if ($request->has('data_cadadastro_ini')) {
                    //$data_fim = $request->get('data_cadadastro_fim') . " 23:59:59";
                    $query->whereBetween('created_at', [$request->get('data_cadadastro_ini'), $request->get('data_cadadastro_fim')])->get();
                }*/
            })

            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="cliente/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="cliente/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                        ';
        })->make(true);
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Illuminate\View\View
     */
    public function create(){
        $meiosCaptacao = MeioCaptacao::orderBy('nome','asc')->pluck('nome','id')->all();
        return view('cliente.create', compact('meiosCaptacao'));
    }

    /**
     * Store a new cliente in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ClienteFormRequest $request)
    {
        try {
           // $asd = new Cliente();
            //dd($asd);
            //$this->affirm($request);
            $data = $this->getData($request, new Cliente());

            $data['user_id'] = \Auth::id();
            $cliente = Cliente::create($data);

            $cliente->id;
            $cur_date = Carbon::now();

            //Retorna o ano so os dois ultimos digitos
            $ano = $cur_date->format('y');

            //Retorna o ultimo registro
            $last = \DB::table('projetos')->orderBy('id', 'DESC')->first();

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro realizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        $meiosCaptacao = MeioCaptacao::orderBy('nome','asc')->pluck('nome','id')->all();
        return view('cliente.edit', compact('cliente', 'meiosCaptacao'));
    }

    /**
     * Update the specified cliente in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ClienteFormRequest $request)
    {

        try {
            //dd(Cliente::getTableColumns());
            //dd($request->all());
            //$this->affirm($request);

            //dd($data);
            $cliente = Cliente::findOrFail($id);
            $data = $this->getData($request, $cliente);
            //dd($data);
            $cliente->update($data);

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified cliente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('cliente.cliente.index')
                ->with('success_message', 'Cliente was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        $rules = [
            'nome' => 'nullable|string|min:0|max:255',
            'celular' => 'nullable|string|min:0|max:20',
            'email' => 'nullable|string|min:0|max:100',
            'cpf_cnpj' => 'required',
            'nome_empresa' => 'nullable|string|min:0|max:255',
            'cep' => 'nullable|string|min:0|max:10',
            'numero' => 'nullable|string|min:0|max:10',
            'endereco' => 'nullable|string|min:0|max:200',
            'complemento' => 'nullable|string|min:0|max:200',
            'estado' => 'nullable|string|min:0|max:2',
            'is_whatsapp' => 'nullable|boolean',
            'obs' => 'nullable',

        ];

        return $this->validate($request, $rules);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request, $entitie)
    {
        //dd($entitie->getTableColumns());
        $data = $request->only(
            $entitie->getTableColumns()
        );
        $data['is_whatsapp'] = $request->has('is_whatsapp');

        return $data;
    }

}
