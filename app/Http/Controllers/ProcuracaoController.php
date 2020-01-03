<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Procuracao;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class ProcuracaoController extends Controller
{
    private $token;

    /**
     * Display a listing of the procuracaos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $procuracaos = Procuracao::with('cliente')->paginate(25);

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
            $rows = \DB::table('[% table %]');

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="procuracao/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="procuracao/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="procuracao/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
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
        $clientes = Cliente::pluck('nome','id')->all();
        
        return view('procuracao.create', compact('clientes'));
    }

    /**
     * Store a new procuracao in the storage.
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
            
            Procuracao::create($data);

            return redirect()->route('procuracao.procuracao.index')
                             ->with('success_message', 'Procuracao was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
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
        $procuracao = Procuracao::with('cliente')->findOrFail($id);

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
        $clientes = Cliente::pluck('nome','id')->all();

        return view('procuracao.edit', compact('procuracao','clientes'));
    }

    /**
     * Update the specified procuracao in the storage.
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
            
            $procuracao = Procuracao::findOrFail($id);
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
                'cliente_id' => 'nullable',
            'data_validade' => 'nullable|date_format:j/n/Y g:i A', 
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
        $data = $request->only(['cliente_id', 'data_validade']);

        return $data;
    }

}
