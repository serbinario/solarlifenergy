<?php

namespace Serbinario\Http\Controllers\Execucao;

use Illuminate\Http\Request;
use Serbinario\Entities\Execucao\OrdemServico;
use Serbinario\Entities\logistica\StatusVisita;
use Serbinario\Entities\logistica\VisitaDocumentos;
use Serbinario\Entities\logistica\VisitasTecnicas;
use Serbinario\Entities\Modulo;
use Serbinario\Http\Requests\ModuloFormRequest;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\OsCorretivaFormRequest;
use Serbinario\Http\Requests\VisitaTecnicaFormRequest;
use Serbinario\Traits\UtilFiles;
use Yajra\DataTables\DataTables;
use Serbinario\User;
use Exception;


class OsCorretivaController extends Controller
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
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the profiles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $status = StatusVisita::pluck('descricao','id')->all();
        return view('execucao.os_corretiva.index', compact('status'));
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
        $rows = \DB::table('ordem_servico as os')
            ->leftJoin('projetosv2', 'projetosv2.id', '=', 'os.projeto_id')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftjoin('users', 'users.id', '=', 'os.tecnico_id')
            ->leftjoin('status_visita as sv', 'sv.id', '=', 'os.status_visita_id')
            ->where('ordem_tipo_id', '=', 1)
            ->select([
                'os.id',
                'os.codigo as osCodigo',
                'users.name',
                'sv.descricao as status',
                'pre_propostas.codigo',
                'clientes.nome',
                'clientes.nome_empresa',
                \DB::raw('DATE_FORMAT(os.data_visita,"%d/%m/%Y") as data_visita'),
                'os.tecnico_id',
                'os.ordem_tipo_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)

            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome_empresa')) {
                    $query->where('clientes.nome_empresa', 'like', "%" . $request->get('nome_empresa') . "%");
                }

                if ($request->has('status_visita_id')) {
                    $query->where('vt.status_visita_id', '=', $request->get('status_visita_id'));
                }

                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
            })

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="execucao/os_corretiva/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="osCorretiva/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>    
                                <a href="/report/'.$row->id.'/os" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>                        
                               
                            </div>
                        </form>
                        ';
            })->make(true);
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return Illuminate\View\View
     */
    public function create(Request $request)
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
            $month = date("Y");
            $last = \DB::table('ordem_servico')->orderBy('id', 'DESC')->whereYear('created_at',  $month)->first();
            if($last == NULL){
                $codigo = date("y") . "0001";
            }else{
                $codigo = $last->codigo +1;
            }
            $dateNow = date("Y-m-d");
            //dd($dateNow);
            $visitaTecnica = OrdemServico::create([
                'projeto_id' => $request->get('projeto_id'),
                'codigo' => $codigo,
                'created_at' => $dateNow ,
                'ordem_tipo_id' => $request->get('tipo')
            ]);
            // dd($visitaTecnica->toArray());
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => "Codigo gerado " .$visitaTecnica['codigo'] , 'data' => $visitaTecnica->toArray() ]);


        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false ]);
        }
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

        $ordemServico = OrdemServico::with('projeto')->findOrFail($id);
        $users = User::orderBy('name')->pluck('name','id')->all();
        $status = StatusVisita::pluck('descricao','id')->all();
        //dd($ordemServico);
        return view('execucao.os_corretiva.edit', compact( 'ordemServico', 'users', 'status'));

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
    public function update($id, OsCorretivaFormRequest $request)
    {
        try {

            $data = $request->getData();
            $os = OrdemServico::findOrFail($id);
            $data['file'] = $this->ImageStore($request, 'file', $os->file);
            $os->update($data);
            return redirect()->route('osCorretiva.edit', $os->id)
                ->with('success_message', 'Visita técnica atualizada com sucesso!');

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
}
