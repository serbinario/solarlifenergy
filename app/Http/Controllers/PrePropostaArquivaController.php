<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Report;
use Serbinario\Traits\Simulador;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class PrePropostaArquivaController extends Controller
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
        $franquias = Franquia::where('is_active', '=', '1')->pluck('nome','id')->all();
        $reports = Report::where('group', '=', 'propostas');
        $prePropostas = PreProposta::with('cliente')->paginate(25);

        return view('pre_proposta.arquivadas.index', compact('prePropostas', 'reports', 'franquias'));
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


        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
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
                        $query->whereNotNull('projetosv2.id');
                    }else{
                        $query->whereNotNull('projetosv2.id');
                    }

                }

                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
                //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
                $user = User::find(Auth::id());
                if($user->hasRole('admin')) {
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }
                if($user->hasRole('integrador')) {
                    $query->where('clientes.user_id', '=', $user->id);
                    $query->where('users.franquia_id', '=', Auth::user()->franquia->id);
                }

                $query->whereNotNull('pre_propostas.arquivado');

            })


            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">   
                                <a href="#" class="btn btn-primary desarquivar"  title="Desarquivar">
                                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                                </a>                            
                        </form>
                        ';
        })->make(true);
    }



}
