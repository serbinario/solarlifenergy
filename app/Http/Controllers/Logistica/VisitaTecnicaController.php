<?php

namespace Serbinario\Http\Controllers\Logistica;

use Illuminate\Http\Request;
use Serbinario\Entities\logistica\StatusVisita;
use Serbinario\Entities\logistica\VisitasTecnicas;
use Serbinario\Entities\Modulo;
use Serbinario\Http\Requests\ModuloFormRequest;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\VisitaTecnicaFormRequest;
use Yajra\DataTables\DataTables;
use Serbinario\User;
use Exception;


class VisitaTecnicaController extends Controller
{
    private $token;

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

        return view('logistica.visita_tecnica.index');
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
        $rows = \DB::table('visita_tecnica as vt')
            ->leftJoin('projetosv2', 'projetosv2.id', '=', 'vt.projeto_id')
            ->leftJoin('pre_propostas', 'pre_propostas.id', '=', 'projetosv2.proposta_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pre_propostas.cliente_id')
            ->leftjoin('users', 'users.id', '=', 'vt.tecnico_id')
            ->leftjoin('status_visita as sv', 'sv.id', '=', 'vt.status_visita_id')
            ->select([
                'vt.id',
                'sv.descricao as status',
                'users.name',
                'pre_propostas.codigo',
                'clientes.nome'

            ]);

        #Editando a grid
        return Datatables::of($rows)

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="logistica/visitaTecnica/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="visitaTecnica/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>                          
                               
                            </div>
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
    public function store(UserFormRequest $request)
    {
        try {
            //$this->affirm($request);
            $data = $this->getData($request);
            $data['password'] = \Hash::make($data['password']);
            $user = User::create($data);

            //Retora o id do ROLE
            $role_r =  \Spatie\Permission\Models\Role::where('id', '=', $data['role'])->first();
            $user->syncRoles($role_r);

            return redirect()->route('visita_tecnica.edit', $user->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');


        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified profile.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $profile = Profile::with('pool')->findOrFail($id);

        return view('profile.show', compact('profile'));
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
        $visitaTecnica = VisitasTecnicas::findOrFail($id);
        $status = StatusVisita::pluck('descricao','id')->all();
        $users = User::orderBy('name')->pluck('name','id')->all();
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
            //dd($data);
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
