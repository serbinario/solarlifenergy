<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\PreProposta;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class PrePropostaController extends Controller
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
     * Display a listing of the pre propostas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $prePropostas = PreProposta::with('cliente')->paginate(25);

        return view('pre_proposta.index', compact('prePropostas'));
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
            $rows = \DB::table('pre_propostas')
                ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
                ->select([

                    'pre_propostas.id',
                    'clientes.nome',
                    'clientes.nome_empresa',
                    'clientes.cpf_cnpj',
                    'clientes.email',
                    'clientes.celular'

                ]);

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="preProposta/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="preProposta/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="preProposta/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new pre proposta.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Clientes = Cliente::pluck('nome','id')->all();
        
        return view('pre_proposta.create', compact('Clientes'));
    }

    /**
     * Store a new pre proposta in the storage.
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

            //Retorna o ultimo registro
            $last = \DB::table('pre_propostas')->orderBy('id', 'DESC')->first();
            //Corrigir o problema da virada do ano
            $codigo = $last->codigo +1;
            $data['codigo'] = $codigo;
            
            PreProposta::create($data);

            return redirect()->route('pre_proposta.pre_proposta.index')
                             ->with('success_message', 'Pre Proposta was successfully added!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified pre proposta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $preProposta = PreProposta::with('cliente')->findOrFail($id);

        return view('pre_proposta.show', compact('preProposta'));
    }

    /**
     * Show the form for editing the specified pre proposta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        //dd($id);
        $preProposta = PreProposta::with('cliente')->findOrFail($id);

        $Clientes = Cliente::pluck('nome','id')->all();

        return view('pre_proposta.edit', compact('preProposta','Clientes'));
    }

    /**
     * Update the specified pre proposta in the storage.
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

           // dd($data);
            $preProposta = PreProposta::findOrFail($id);
            $preProposta->update($data);

            return redirect()->route('pre_proposta.pre_proposta.index')
                             ->with('success_message', 'Pre Proposta was successfully updated!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified pre proposta from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $preProposta = PreProposta::findOrFail($id);
            $preProposta->delete();

            return redirect()->route('pre_proposta.pre_proposta.index')
                             ->with('success_message', 'Pre Proposta was successfully deleted!');

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
                /*'cliente_id' => 'nullable',
            'power' => 'nullable|string|min:0|max:10',
            'quantity' => 'nullable|string|min:0|max:10',
            'minimum_area' => 'nullable|string|min:0|max:10',
            'average_weight' => 'nullable|numeric|string|min:0|max:10',
            'value' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'yearly_usage' => 'nullable|numeric|string|min:0|max:10',
            'jan' => 'nullable|string|min:0|max:10',
            'feb' => 'nullable|string|min:0|max:10',
            'mar' => 'nullable|string|min:0|max:10',
            'apr' => 'nullable|string|min:0|max:10',
            'may' => 'nullable|string|min:0|max:10',
            'jun' => 'nullable|string|min:0|max:10',
            'jul' => 'nullable|string|min:0|max:10',
            'aug' => 'nullable|string|min:0|max:10',
            'sep' => 'nullable|string|min:0|max:10',
            'oct' => 'nullable|string|min:0|max:10',
            'nov' => 'nullable|string|min:0|max:10',
            'dec' => 'nullable|string|min:0|max:10',
            'real_power' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'panel_power' => 'nullable|numeric|min:-99999999.99|max:99999999.99', */
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
        $data = $request->only(['cliente_id',
            'codigo',
            'data_validade',
            'power',
            'monthly_usage',
            'preco_medio_instalado',
            'potencia_instalada',
            'minima_area',
            'qtd_paineis',
            'economia_anula',
            'preco_kwh',
            'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'panel_potencia']);

        return $data;
    }

}
