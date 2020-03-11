<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\Entities\Cliente;
use Serbinario\Entities\Endereco;
use Serbinario\Entities\PreProposta;
use Serbinario\Entities\Progetov2;
use Serbinario\Entities\ProjetosDocumento;
use Serbinario\Entities\ProjetosExecurcao;
use Serbinario\Entities\ProjetosFinalizando;
use Serbinario\Entities\ProjetoStatus;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\Progetov2FormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class Progetov2Controller extends Controller
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
     * Display a listing of the progetov2s.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $progetov2s = Progetov2::with('cliente','projetosstatus','preproposta','endereco','projetosdocumento','projetosexecurcao','projetosfinalizando')->paginate(25);

        return view('progetov2.index', compact('progetov2s'));
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
        $rows = \DB::table('progetosv2');

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="progetov2/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="progetov2/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="progetov2/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new progetov2.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::pluck('nome','id')->all();
        $ProjetosStatus = ProjetoStatus::pluck('id','id')->all();
        $PrePropostas = PreProposta::pluck('codigo','id')->all();
        $Enderecos = Endereco::pluck('id','id')->all();
        $ProjetosDocumentos = ProjetosDocumento::pluck('id','id')->all();
        $ProjetosExecurcaos = ProjetosExecurcao::pluck('id','id')->all();
        $ProjetosFinalizandos = ProjetosFinalizando::pluck('id','id')->all();

        return view('progetov2.create', compact('clientes','ProjetosStatus','PrePropostas','Enderecos','ProjetosDocumentos','ProjetosExecurcaos','ProjetosFinalizandos'));
    }

    /**
     * Store a new progetov2 in the storage.
     *
     * @param Serbinario\Http\Requests\Progetov2FormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Progetov2FormRequest $request)
    {
        try {

            $data = $request->getData();

            Progetov2::create($data);

            return redirect()->route('progetov2.progetov2.index')
                ->with('success_message', 'Progetov2 was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified progetov2.
     *
     * @param int $idProjetosStatus
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $progetov2 = Progetov2::with('cliente','projetostatus','preproposta','endereco','projetosdocumento','projetosexecurcao','projetosfinalizando')->findOrFail($id);

        return view('progetov2.show', compact('progetov2'));
    }

    /**
     * Show the form for editing the specified progetov2.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $progetov2 = Progetov2::findOrFail($id);
        $clientes = Cliente::pluck('nome','id')->all();
        $ProjetosStatus = ProjetoStatus::pluck('id','id')->all();
        $PrePropostas = PreProposta::pluck('codigo','id')->all();
        $Enderecos = Endereco::pluck('id','id')->all();
        $ProjetosDocumentos = ProjetosDocumento::pluck('id','id')->all();
        $ProjetosExecurcaos = ProjetosExecurcao::pluck('id','id')->all();
        $ProjetosFinalizandos = ProjetosFinalizando::pluck('id','id')->all();

        return view('progetov2.edit', compact('progetov2','clientes','ProjetosStatus','PrePropostas','Enderecos','ProjetosDocumentos','ProjetosExecurcaos','ProjetosFinalizandos'));
    }

    /**
     * Update the specified progetov2 in the storage.
     *
     * @param  int $id
     * @param Serbinario\Http\Requests\Progetov2FormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Progetov2FormRequest $request)
    {
        try {

            $data = $request->getData();

            $progetov2 = Progetov2::findOrFail($id);
            $progetov2->update($data);

            return redirect()->route('progetov2.progetov2.index')
                ->with('success_message', 'Progetov2 was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified progetov2 from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $progetov2 = Progetov2::findOrFail($id);
            $progetov2->delete();

            return redirect()->route('progetov2.progetov2.index')
                ->with('success_message', 'Progetov2 was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
