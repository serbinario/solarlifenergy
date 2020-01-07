<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\User;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Entities\Procuracao;
use Serbinario\Entities\Franquia;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\ProcuracaoFormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class ProcuracaoController extends Controller
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
     * Display a listing of the procuracaos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $procuracaos = Procuracao::with('cliente','franquium','updater','creator')->paginate(25);

        return view('procuracao.index', compact('procuracaos'));
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
        $rows = \DB::table('procuracoes')
            ->leftJoin('clientes', 'clientes.id', '=', 'procuracoes.cliente_id')
            ->select([
                'procuracoes.id',
                'clientes.nome',
                \DB::raw('DATE_FORMAT(procuracoes.data_validade,"%d/%m/%Y") as data_validade'),
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="procuracao/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="procuracao/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="/report/'.$row->id.'/Procuracao" class="btn btn-primary" target="_blank" title="Procuracao">
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
     * Show the form for creating a new procuracao.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes =  Cliente::orderBy('nome','asc')->pluck('nome','id')->all();

        return view('procuracao.create', compact('clientes'));
    }

    /**
     * Store a new procuracao in the storage.
     *
     * @param Serbinario\Http\Requests\ProcuracaoFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ProcuracaoFormRequest $request)
    {
        try {

            $data = $request->getData();
            $data['created_by'] = Auth::Id();
            $data['franquia_id'] = Auth::user()->franquia->id;
            $procuracao = Procuracao::create($data);

            return redirect()->route('procuracao.procuracao.edit', $procuracao->id)
                ->with('success_message', 'Cadastro realizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified procuracao.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $procuracao = Procuracao::with('cliente','franquia','updater','creator')->findOrFail($id);

        return view('procuracao.show', compact('procuracao'));
    }

    /**
     * Show the form for editing the specified procuracao.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $procuracao = Procuracao::findOrFail($id);
        //dd($procuracao);
        $clientes = Cliente::orderBy('nome','asc')->pluck('nome','id')->all();

        return view('procuracao.edit', compact('procuracao','clientes'));
    }

    /**
     * Update the specified procuracao in the storage.
     *
     * @param  int $id
     * @param Serbinario\Http\Requests\ProcuracaoFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ProcuracaoFormRequest $request)
    {
        try {

            $data = $request->getData();

            $data['updated_by'] = Auth::Id();
            $procuracao = Procuracao::findOrFail($id);
            //dd($data);
            $procuracao->update($data);

            return redirect()->route('procuracao.procuracao.index')
                ->with('success_message', 'Procuracao was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified procuracao from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $procuracao = Procuracao::findOrFail($id);
            $procuracao->delete();

            return redirect()->route('procuracao.procuracao.index')
                ->with('success_message', 'Procuracao was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
