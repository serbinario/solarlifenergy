<?php

namespace Serbinario\Http\Controllers;


//meu teste
use Serbinario\Entities\Franquia;
use Serbinario\Entities\Report;
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

class ProjetoArquivadoController extends Controller
{
    use UtilFiles;
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
        return view('projetov2/arquivadas.index', compact('projetov2s', 'reports', 'franquias'));
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
                'pre_propostas.codigo',
                'pre_propostas.potencia_instalada',
                \DB::raw('DATE_FORMAT(pre_propostas.data_financiamento_bancario,"%d/%m/%Y") as data_financiamento_bancario'),
                \DB::raw('DATE_FORMAT(pre_propostas.data_prevista_parcela,"%d/%m/%Y") as data_prevista_parcela'),
                'projetos_prioridades.prioridade_nome',
                'pre_propostas.preco_medio_instalado',
                \DB::raw('DATE_FORMAT(projetos_finalizado.data_conexao,"%d/%m/%Y") as data_conexao'),
                \DB::raw('DATE_FORMAT(projetosv2.data_prevista,"%d/%m/%Y") as data_prevista'),
                'projetos_status.status_nome'
            ]);

        $rows->whereNotNull('projetosv2.arquivado');

        //Se o usuario logado nao tiver role de admin, so podera ver os cadastros dele
        $user = User::find(Auth::id());
        if($user->hasRole('admin')) {
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
                if($user->hasRole('admin')) {
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
                                <a href="#" class="btn btn-primary desarquivar"  title="Desarquivar">
                                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                                </a>  
                               
                            </div>
                        </form>
                        ';


        })->make(true);
    }


}
