<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\ContratoCelpe;
use Serbinario\Entities\Projeto;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\ProjetoStatus;
use Serbinario\Http\Controllers\Controller;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProjetoController extends Controller
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
     * Display a listing of the projetos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $projetos = Projeto::with('cliente')->paginate(25);
        //dd($projetos);

        return view('projeto.index', compact('projetos'));
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

        $rows = \DB::table('projetos')
            ->leftJoin('clientes', 'clientes.id', '=', 'projetos.clientes_id')
            ->leftJoin('users', 'users.id', '=', 'projetos.users_id')
            ->leftJoin('projetos_status', 'projetos_status.id', '=', 'projetos.projeto_status_id')
            ->select([
                'clientes.nome',
                'projetos.id',
                'projetos.projeto_codigo',
                'projetos.kw',
                'projetos.valor_projeto',
                'users.name',
                //'projetos_status.id',
                'projetos.prioridade',
                \DB::raw('DATE_FORMAT(projetos.created_at,"%d/%m/%Y") as created_at'),
                \DB::raw('DATE_FORMAT(projetos.updated_at,"%d/%m/%Y") as updated_at')
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
                    $query->where('clientes.nome', 'like', "%" . $request->get('nome') . "%");
                }
                if ($request->has('data_cadadastro_ini')) {
                    //$data_fim = $request->get('data_cadadastro_fim') . " 23:59:59";
                    $query->whereBetween('projetos.created_at', [$request->get('data_cadadastro_ini'), $request->get('data_cadadastro_fim')])->get();
                }
                if ($request->has('prioridade')) {
                    $query->where('projetos.prioridade', 'like', "%" . $request->get('prioridade') . "%");
                }
                if ($request->has('cod_projeto')) {
                    $query->where('projetos.projeto_codigo', 'like', "%" . $request->get('cod_projeto') . "%");
                }
                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
                if ($request->has('projeto_status')) {
                    $query->where('projetos_status.id', '=',  $request->get('projeto_status') );
                }


            })

            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="projeto/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                             
                                <a href="projeto/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="/report/'.$row->id.'/FichaElaboracaoProjeto" class="btn btn-primary" target="_blank" title="Relatorio">
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
     * Show the form for creating a new projeto.  glyphicon-file
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome','asc')->pluck('nome','id')->all();
        $users = User::orderBy('name')->pluck('name','id')->all();

        return view('projeto.create', compact('clientes', 'users'));
    }

    /**
     * Store a new projeto in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $this->affirm($request);
            $data = $this->getData($request);

            $cur_date = Carbon::now();

            //Retorna o ano so os dois ultimos digitos
            $ano = $cur_date->format('y');

            //Retorna o ultimo registro
            $last = \DB::table('projetos')->orderBy('id', 'DESC')->first();


            //Corrigir o problema da virada do ano
            $projeto_codigo = $last->projeto_codigo +1;

            $data['projeto_codigo'] = $projeto_codigo;

            //[RF001-RN002]:
            $data['projeto_status_id'] = 1;

            //Coloquei essa opçao pois quando um usuario nao e adm o formulario nao manda o id do user pois esta
            // em solente leitura
            if(empty($data['users_id'])){
                $data['users_id'] = Auth::id();
            }
            $projeto = Projeto::create($data);

            foreach (array_filter($request->get('num_contrato')) as $contrato)  {
                $contratos = $projeto->contratos()->create(['num_contrato' => $contrato]);
            }

            return redirect()->route('projeto.projeto.index')
                ->with('success_message', 'Projeto was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified projeto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $projeto = Projeto::with('cliente','user')->findOrFail($id);

        return view('projeto.show', compact('projeto'));
    }

    /**
     * Show the form for editing the specified projeto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $projeto = Projeto::with('contratos', 'cliente', 'projetoStatus')->findOrFail($id);
        //dd($projeto);
        $clientes = Cliente::orderBy('nome','asc')->pluck('nome','id')->all();
        //dd($projeto);
        $users = User::orderBy('name')->pluck('name','id')->all();

        $projetosStatus = ProjetoStatus::orderBy('id','asc')->pluck('status_nome','id')->all();

        //dd($projeto->contratos);
        return view('projeto.edit', compact('projeto','clientes', 'users', 'projetosStatus'));
    }

    /**
     * Update the specified projeto in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $this->affirm($request);
            $data = $this->getData($request);
            $projeto = Projeto::findOrFail($id);
            //dd($data);

            //Deleta primeiro todos os registors dos contratos
            $contratos = $projeto->contratos()->delete();


            //Coloquei essa opçao pois quando um usuario nao e adm o formulario nao manda o id do user pois esta
            // em solente leitura
            if(empty($data['users_id'])){
                $data['users_id'] = $projeto->users_id;
            }

           //$util = new UtilController();
         // dd($util->simulaGeracao($request->input('cep'), $request->input('kwh')));
            /*
             * 1- Pega do formulario uma array chamada num_contrato
             * 2 - se vinher alguma vazia e limpa com o metodo array_filter
             * 3 - E inserido em contrados
             */
            for($i = 0; $i < count($data['num_contrato']); $i++){
               $contratos = $projeto->contratos()->create(['num_contrato' => $data['num_contrato'][$i], 'percentual' => $data['percentual'][$i]]);
            }

            $projeto->update($data);

            return redirect()->route('projeto.projeto.index')
                ->with('success_message', 'Projeto atualizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified projeto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->delete();

            return redirect()->route('projeto.projeto.index')
                ->with('success_message', 'Projeto was successfully deleted!');

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
            'clientes_id' => 'nullable',
            'consumo' => 'nullable',
            'area_disponivel' => 'nullable',
            'users_id' => 'nullable',
            'kw' => 'required',

        ];


        return $this->validate($request, $rules);
        //dd($rules);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->only(
            [
                'clientes_id',
                'projeto_status_id',
                'prioridade',
                'projeto_codigo',
                'num_contrato',
                'percentual',
                'consumo',
                'area_disponivel',
                'obs',
                'valor_projeto',
                'kw',
                'users_id',
                'res_acompanhamento',
                'res_documentacao',
                'end_intalacao',
                'coordenadas',
                'data_prevista',
                'kwh'
            ]);

        return $data;
    }

}