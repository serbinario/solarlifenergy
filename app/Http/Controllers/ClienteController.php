<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Carbon\Carbon;
use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
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
    public function index()
    {
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
            ->leftJoin('projetos', 'clientes.id', '=', 'projetos.clientes_id')
            ->groupBy('clientes.id')
            ->select([
                'clientes.id',
                'clientes.nome',
                'clientes.nome_empresa',
                'clientes.cpf_cnpj',
                'clientes.email',
                'clientes.celular',
                \DB::raw('DATE_FORMAT(clientes.created_at,"%d/%m/%Y") as created_at'),

            ]);

        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if(!$user->hasRole('admin')) {
           $rows->where('projetos.users_id', '=', $user->id);
        }


        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('nome', 'like', "%" . $request->get('nome') . "%");
                }
                if ($request->has('data_ini')) {
                    $tableName = $request->get('filtro_por');
                    $query->whereBetween('clientes.' . $tableName, [$request->get('data_ini'), $request->get('data_fim')])->get();
                }

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
                        </form>
                        ';
        })

            ->make(true);
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('cliente.create');
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
            //$this->affirm($request);
            $data = $this->getData($request);

            $cliente = Cliente::create($data);


            /*
             * Apos criar um cliente e criado um projeto para o mesmo
             */
            $cliente->id;

            $cur_date = Carbon::now();

            //Retorna o ano so os dois ultimos digitos
            $ano = $cur_date->format('y');

            //Retorna o ultimo registro
            $last = \DB::table('projetos')->orderBy('id', 'DESC')->first();


            //Corrigir o problema da virada do ano
            $projeto_codigo = $last->projeto_codigo +1;

            $projeto = array();
            $projeto['clientes_id'] = $cliente->id;
            $projeto['projeto_codigo'] = $projeto_codigo;
            $projeto['users_id'] = \Auth::id();
            //[RF001-RN002]:
            $projeto['projeto_status_id'] = 1;

            //dd($projeto);

            $projeto = Projeto::create($projeto);

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro realizado com sucesso!');

        } catch (Exception $exception) {
            //dd($exception);
            //dd($exception->getMessage());
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('cliente.show', compact('cliente'));
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


        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified cliente in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            //dd($request->all());
            $this->affirm($request);
            $data = $this->getData($request);

            //dd($data);
            $cliente = Cliente::findOrFail($id);
            $cliente->update($data);
            //dd($data);
            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cliente was successfully updated!');

        } catch (Exception $exception) {
            //dd($exception);
            return back()->withInput()
                ->withErrors(['error' => 'Unexpected error occurred while trying to process your request!']);
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

        $messages =[
            'cpf_cnpj.required' => "Hey, don't you want to tell us your name?"
        ];


        return $this->validate($request, $rules);
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
            'nome','celular','tipo','cpf_cnpj','email','nome_empresa','cep','numero','endereco','complemento','estado','is_whatsapp','obs',
            'conjugue',
            'conjugue_cpf',
            'rg',
            'data_emissao_rg',
            'orgao_emissor_rg',
            'naturalidade_uf',
            'naturalidade_cidade',
            'data_nascimento',
            'cidade'
        ]);
        $data['is_whatsapp'] = $request->has('is_whatsapp');

        return $data;
    }

}
