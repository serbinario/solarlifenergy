<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\User;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\Parametro;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\ParametroFormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class ParametroController extends Controller
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
     * Display a listing of the parametros.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $parametros = Parametro::with('cliente','creator','updater','franquia')->paginate(25);

        return view('parametro.index', compact('parametros'));
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
            return '<form id="' . $row->id   . '" method="POST" action="parametro/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="parametro/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="parametro/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new parametro.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::pluck('nome','id')->all();
        $creators = User::pluck('name','id')->all();
        $updaters = User::pluck('name','id')->all();
        $franquia = Franquia::pluck('id','id')->all();

        return view('parametro.create', compact('clientes','creators','updaters','franquia'));
    }

    /**
     * Store a new parametro in the storage.
     *
     * @param Serbinario\Http\Requests\ParametroFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ParametroFormRequest $request)
    {
        try {

            $data = $request->getData();
            $data['created_by'] = Auth::Id();
            $data['franquia_id'] = Auth::user()->franquia->id;
            Parametro::create($data);

            return redirect()->route('parametro.parametro.index')
                ->with('success_message', 'Parametro was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified parametro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $parametro = Parametro::with('cliente','creator','updater','franquia')->findOrFail($id);

        return view('parametro.show', compact('parametro'));
    }

    /**
     * Show the form for editing the specified parametro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $parametro = Parametro::findOrFail($id);

        return view('parametro.edit', compact('parametro'));
    }

    /**
     * Update the specified parametro in the storage.
     *
     * @param  int $id
     * @param Serbinario\Http\Requests\ParametroFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ParametroFormRequest $request)
    {
        try {
            //dd(Auth::user()->idParametro);
            //dd(Auth::user()->franquia->parametro->id);
            $data = $request->getData();
            $data['updated_by'] = Auth::Id();
            //$data['franquia_id'] = Auth::user()->franquia_id;
            $parametro = Parametro::findOrFail($id);

            //dd($parametro->franquia);
            $parametro->update($data);

            return redirect()->route('parametro.parametro.edit', $parametro->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified parametro from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $parametro = Parametro::findOrFail($id);
            $parametro->delete();

            return redirect()->route('parametro.parametro.index')
                ->with('success_message', 'Parametro was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
