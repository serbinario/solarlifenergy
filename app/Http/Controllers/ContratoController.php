<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\Entities\ReportLayout;
use Serbinario\User;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Contrato;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\Projeto;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\ContratoFormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class ContratoController extends Controller
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
        $contratos = Contrato::with('projeto','franquia','creator','updater')->paginate(25);

        return view('contrato.index', compact('contratos'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid()
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('contratos')
            ->leftJoin('projetosv2', 'projetosv2.id', '=', 'contratos.projeto_id')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->join('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->join('users', 'users.id', '=', 'pre_propostas.user_id')
            ->select([
                'clientes.nome_empresa',
                'contratos.id',
                'pre_propostas.preco_medio_instalado',
                'pre_propostas.potencia_instalada',
                'contratos.ano'
            ]);

        //$user = User::find(Auth::id());
        //$rows->where('users.franquia_id', '=', Auth::user()->franquia->id);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="contrato/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                            
                              
                                <a href="/report/'.$row->id.'/Contrato" class="btn btn-primary" target="_blank" title="Contrato">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>
                                <a href="/report/'.$row->id.'/Declaracao" class="btn btn-primary" target="_blank" title="Declaração Ciência">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </a>                               
                        </form>
                        ';
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
    public function store(ContratoFormRequest $request)
    {
        try {

            $data = $request->getData();
            $data['created_by'] = Auth::Id();
            $data['franquia_id'] = Auth::user()->franquia->id;
            $contrato = Contrato::create($data);

            return redirect()->route('contrato.contrato.edit', $contrato->id)
                ->with('success_message', 'Contrato criado com sucessp!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
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



}
