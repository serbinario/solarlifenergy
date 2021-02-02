<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\logistica\StatusEntrega;
use Serbinario\Entities\SolicitacaoEntrega;
use Serbinario\Entities\Vendas\Pedido;
use Serbinario\Entities\Vendas\Produto;
use Serbinario\Traits\UtilFiles;
use Serbinario\User;
use Exception;
use Yajra\DataTables\DataTables;

class SolicitacaoEntregaController extends Controller
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
     * Display a listing of the profiles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = StatusEntrega::pluck('descricao','id')->all();
        return view('logistica.solicitacao_entrega.index', compact('status'));
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
        $rows = \DB::table('solicitacao_entrega as se')
            ->join('status_entrega AS status', 'status.id', '=', 'se.status_entrega_id')
            ->join('projetosv2 AS proje', 'proje.id', '=', 'se.projeto_id')
            ->join('pre_propostas  AS pre', 'pre.id', '=', 'proje.proposta_id')
            ->join('clientes as cli', 'cli.id', '=', 'pre.cliente_id')
            ->groupBy('pre.codigo')
            ->select([
                'se.id',
                'cli.nome',
                'status.descricao',
                'pre.preco_medio_instalado',
                'pre.codigo',
            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('nome')) {
                    $query->where('cli.nome', 'like', "%" . $request->get('nome') . "%");
                }

                if ($request->has('status_visita_id')) {
                    $query->where('se.status_entrega_id', '=', $request->get('status_visita_id'));
                }

                if ($request->has('integrador')) {
                    $query->where('users.name', 'like', "%" . $request->get('integrador') . "%");
                }
            })

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="solicitacaoEntrega/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">   
                                <a href="/report/'.$row->id.'/solicitacaoEntrega" class="btn btn-primary" target="_blank" title="Proposta">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>  
                                <a href="solicitacaoEntrega/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                                      
                        </form>
                        ';
            })->make(true);

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
            $dados = $request->all();
            SolicitacaoEntrega::create([ 'projeto_id' => $dados['projeto_id'], 'status_entrega_id' => 1]);

            return response()->json(['success' => true, 'msg' => $dados]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $solicitacaoEntrega = SolicitacaoEntrega::with('statusEntrega')->findOrFail($id);
        $status = StatusEntrega::pluck('descricao','id')->all();
        return view('logistica.solicitacao_entrega.edit', compact('solicitacaoEntrega', 'status'));
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
    public function update($id, Request $request)
    {
        try {
            $data = $this->getData($request);
            $entrega = SolicitacaoEntrega::findOrFail($id);

            if($request->hasFile('file')){
                $nameFile = $this->ImageStore($request, 'file', $entrega->file);
                $data['file'] = $nameFile;

            }

            $entrega->update($data);

            return redirect()->route('users.user.edit', $entrega->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

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
        $data = $request->only(['data_entrega', 'obs', 'status_entrega_id']);

        return $data;
    }

}
