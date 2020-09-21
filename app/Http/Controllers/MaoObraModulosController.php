<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Serbinario\Entities\Vendas\MaoObraModulos;
use Serbinario\Http\Requests\MaoObraModuloFormRequest;
use Yajra\DataTables\DataTables;
use Serbinario\User;
use Exception;

class MaoObraModulosController extends Controller
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
     * Display a listing of the profiles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('mao_obra_modulo.index');
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
        $rows = \DB::table('mao_obra_modulos')
            ->leftJoin('modulos', 'modulos.id', '=', 'mao_obra_modulos.modulo_id')
            ->select([
                'mao_obra_modulos.id',
                'max_modulos',
                'valor_mao_obra',
                'modulos.potencia',
            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
            })


            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="maoObra/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                          
                                <a href="maoObra/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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

            return redirect()->route('users.user.edit', $user->id)
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
        $maoObraModulo = MaoObraModulos::with('modulo')->findOrFail($id);
        //dd($maoObraModulo);
        $roles = \Spatie\Permission\Models\Role::pluck('name','id')->all();

        //dd($user->roles[0]->id);
        return view('mao_obra_modulo.edit', compact('maoObraModulo'));

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
    public function update($id, MaoObraModuloFormRequest $request)
    {
        try {

            //$this->affirm($request);
            $data = $request->getData();
            $maoObraModulo = MaoObraModulos::findOrFail($id);

            $maoObraModulo->update($data);



            return redirect()->route('mao_obra.edit', $maoObraModulo->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            dd($e);
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

            return redirect()->route('mao_obra.index')
                ->with('success_message', 'Profile was successfully deleted!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
        }
    }


}
