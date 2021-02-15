<?php

namespace Serbinario\Http\Controllers\Logistica;

use Illuminate\Http\Request;
use Serbinario\Entities\logistica\StatusVisita;
use Serbinario\Entities\logistica\VisitaDocumentos;
use Serbinario\Entities\logistica\VisitasTecnicas;
use Serbinario\Entities\Modulo;
use Serbinario\Http\Requests\ModuloFormRequest;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\VisitaTecnicaFormRequest;
use Serbinario\Traits\UtilFiles;
use Yajra\DataTables\DataTables;
use Serbinario\User;
use Exception;


class VisitaTecnicaController extends Controller
{
    use UtilFiles;
    private $token;
    private $arquivado;

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
        return view('logistica.visita_tecnica.index', compact('status'));
    }

    public function arquivadasIndex()
    {
        $status = StatusVisita::pluck('descricao','id')->all();
        return view('logistica.visita_tecnica.arquivadas.index', compact('status'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid(Request $request)
    {
        $this->arquivado = $request->get('arquivado');
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('visita_tecnica as vt')
            ->leftJoin('projetosv2', 'projetosv2.id', '=', 'vt.projeto_id')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftjoin('users', 'users.id', '=', 'vt.tecnico_id')
            ->leftjoin('status_visita as sv', 'sv.id', '=', 'vt.status_visita_id')
            ->where('vt.arquivado', '=', $request->get('arquivado') )
            ->select([
                'vt.id',
                \DB::raw('DATE_FORMAT(vt.data_previsao,"%d/%m/%Y") as data_previsao'),
                \DB::raw('DATE_FORMAT(vt.data_visita,"%d/%m/%Y") as data_visita'),
                'sv.descricao as status',
                'users.name',
                'pre_propostas.codigo',
                'clientes.nome',
                'clientes.nome_empresa',
                \DB::raw('DATE_FORMAT(vt.created_at,"%d/%m/%Y") as data_cadastro'),
            ]);

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
                $acao = '<form id="' . $row->id   . '" method="POST" action="logistica/visitaTecnica/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">';

                if($this->arquivado != 1){
                    $acao .= '<a href="visitaTecnica/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>';

                    $acao .= '<a href="/report/'.$row->id.'/visitaTecnica" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>';
                }

                $acao .= '<a href="#" class="btn btn-primary arquivar" onclick="arquivarVisitaTecnica(' . $row->id . ')"  title="Arquivar">
                                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                                </a>';

                if($this->arquivado != 1){
                    $acao .= '<button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>';
                }
                $acao .= '</div>
                        </form>';
                return $acao;
            })->make(true);
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            //dd($request->all());

            //$projeto = Projetov2::create($data);

           // VisitasTecnicas::create([ 'projeto_id' => $projeto->id] );
            return \Illuminate\Support\Facades\Response::json(['success' => true]);

        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'message' => $e]);
        }


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
            $last = \DB::table('visita_tecnica')->orderBy('id', 'DESC')->whereYear('created_at',  $month)->first();
            if($last == NULL){
                $codigo = date("y") . "0001";
            }else{
                $codigo = $last->codigo +1;
            }
            $dateNow = date("Y-m-d");
            //dd($dateNow);
            $visitaTecnica = VisitasTecnicas::create([ 'projeto_id' => $request->get('projeto_id'), 'codigo' => $codigo, 'created_at' => $dateNow] );
           // dd($visitaTecnica->toArray());
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => "Codigo gerado " .$visitaTecnica['codigo'] , 'data' => $visitaTecnica->toArray() ]);


        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false ]);
        }
    }

    public function visitaPorProjeto(Request $request)
    {
        try {

            $rows = \DB::table('visita_tecnica as vt')
                ->leftJoin('projetosv2', 'projetosv2.id', '=', 'vt.projeto_id')
                ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
                ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
                ->leftjoin('users', 'users.id', '=', 'vt.tecnico_id')
                ->leftjoin('status_visita as sv', 'sv.id', '=', 'vt.status_visita_id')
                ->where('projeto_id', '=', $request->get('projeto_id'))
                ->select([
                    'vt.id',
                    \DB::raw('DATE_FORMAT(vt.data_previsao,"%d/%m/%Y") as data_previsao'),
                    \DB::raw('DATE_FORMAT(vt.data_visita,"%d/%m/%Y") as data_visita'),
                    'sv.descricao as status',
                    'users.name',
                    'vt.codigo',
                    'clientes.nome_empresa',
                    \DB::raw('DATE_FORMAT(vt.created_at,"%d/%m/%Y") as created_at'),
                ])->get();



            return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $rows->toArray() ]);


        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
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
        $visitaTecnica = VisitasTecnicas::with('projeto')->findOrFail($id);
        $status = StatusVisita::pluck('descricao','id')->all();
        $users = User::where('is_tecnico', '=','1')->orderBy('name')->pluck('name','id')->all();
        //dd($visitaTecnica);
        return view('logistica.visita_tecnica.edit', compact( 'visitaTecnica', 'status', 'users'));

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
    public function update($id, VisitaTecnicaFormRequest $request)
    {
        try {

            $data = $request->getData();
            $visitaTecnica = VisitasTecnicas::findOrFail($id);

            $data['foto_estrutura_image'] = $this->ImageStore($request, 'foto_estrutura_image', $visitaTecnica->foto_estrutura_image);
            $data['medicao_area_image'] = $this->ImageStore($request, 'medicao_area_image', $visitaTecnica->medicao_area_image);
            $data['localizacao_image'] = $this->ImageStore($request, 'localizacao_image', $visitaTecnica->localizacao_image);
            $data['disjuntor_geral_image'] = $this->ImageStore($request, 'disjuntor_geral_image', $visitaTecnica->disjuntor_geral_image);
            $data['comprovante_image'] = $this->ImageStore($request, 'comprovante_image', $visitaTecnica->comprovante_image);

            $visitaTecnica->update($data);
            return redirect()->route('visita_tecnica.edit', $visitaTecnica->id)
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
