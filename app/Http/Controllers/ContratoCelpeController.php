<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Projeto;
use Serbinario\Entities\ContratoCelpe;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class ContratoCelpeController extends Controller
{
    private $token;

    /**
     * Display a listing of the contrato celpes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $contratoCelpes = ContratoCelpe::with('projeto')->paginate(25);

        return view('contrato_celpe.index', compact('contratoCelpes'));
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
                return '<form id="' . $row->id   . '" method="POST" action="contratoCelpe/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="contratoCelpe/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="contratoCelpe/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new contrato celpe.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $projetos = Projeto::pluck('consumo','id')->all();
        
        return view('contrato_celpe.create', compact('projetos'));
    }

    /**
     * Store a new contrato celpe in the storage.
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
            
            ContratoCelpe::create($data);

            return redirect()->route('contrato_celpe.contrato_celpe.index')
                             ->with('success_message', 'Contrato Celpe was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified contrato celpe.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $contratoCelpe = ContratoCelpe::with('projeto')->findOrFail($id);

        return view('contrato_celpe.show', compact('contratoCelpe'));
    }

    /**
     * Show the form for editing the specified contrato celpe.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $contratoCelpe = ContratoCelpe::findOrFail($id);
        $projetos = Projeto::pluck('consumo','id')->all();

        return view('contrato_celpe.edit', compact('contratoCelpe','projetos'));
    }

    /**
     * Update the specified contrato celpe in the storage.
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
            
            $contratoCelpe = ContratoCelpe::findOrFail($id);
            $contratoCelpe->update($data);

            return redirect()->route('contrato_celpe.contrato_celpe.index')
                             ->with('success_message', 'Contrato Celpe was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified contrato celpe from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $contratoCelpe = ContratoCelpe::findOrFail($id);
            $contratoCelpe->delete();

            return redirect()->route('contrato_celpe.contrato_celpe.index')
                             ->with('success_message', 'Contrato Celpe was successfully deleted!');

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
            'num_contrato' => 'nullable|string|min:0|max:100',
            'projetos_id' => 'nullable',
     
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
        $data = $request->only(['num_contrato','projetos_id']);

        return $data;
    }

}
