<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Alert;
use Serbinario\Entities\Financeiro\Category;
use Serbinario\Entities\Franquia;
use Serbinario\Http\Requests\AlertFormRequest;
use Serbinario\Http\Requests\CategoryFormRequest;
use Yajra\DataTables\DataTables;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alert.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franquias = Franquia::pluck('nome','id')->all();
        return view('alert.create', compact('franquias'));
    }

    public function grid(Request $request)
    {
        //dd($request->all());
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('alerts')
            ->leftjoin('franquias', 'alerts.franquia_id', '=', 'franquias.id')
            ->select([
                'alerts.id',
                'alerts.title',
                'alerts.description',
                'franquias.nome as franquia'
            ]);


        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {

            })

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="alert/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="alert/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                 <button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                               
                            </div>
                        </form>
                        ';
            })->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlertFormRequest $request)
    {
        $data = $request->getData($request);

        Alert::create($data);

        return redirect()->route('alert.index')->withSuccess('You have successfully created a Category!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alert = Alert::findOrFail($id);
        $franquias = Franquia::pluck('nome','id')->all();
        return view('alert.edit', compact('franquias', 'alert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlertFormRequest $request, $id)
    {
        try {
            ;
            $alert = Alert::findOrFail($id);
            $data = $request->getData($request, $alert);
            //dd($data);
            $alert->update($data);

            return redirect()->route('alert.edit', $alert->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $alert = Alert::findOrFail($id);
            $alert->delete();

            return redirect()->route('alert.index')
                ->with('success_message', 'Alerta deletado com sucesso!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function lastForAlerts(Request $request){
        $franquia_id = Auth::user()->franquia->id;
        $alerts = Alert::where('franquia_id', '=' , $franquia_id)->orderBy('created_at')->take(4)->get();
        return \Illuminate\Support\Facades\Response::json($alerts);
    }
}
