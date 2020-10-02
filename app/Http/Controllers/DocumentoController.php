<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Serbinario\Entities\DocumentoStatus;
use Serbinario\Entities\Franquia;
use Serbinario\Entities\Pool;
use Serbinario\Entities\Profile;
use Serbinario\Entities\Router;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Http\Requests\UserFormRequest;
use Serbinario\User;
use Yajra\DataTables\DataTables;
use Exception;

class DocumentoController extends Controller
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
    public function index()
    {
        $franquias = Franquia::pluck('nome','id')->all();
        $status_documentos = DocumentoStatus::pluck('descricao','id')->all();
        return view('documento.index', compact('franquias','franquias', 'status_documentos', 'status_documentos'));
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
        $rows = \DB::table('documentos')
            ->leftJoin('documento_franquia', 'documento_franquia.documento_id', '=', 'documentos.id')
            ->leftJoin('franquias', 'franquias.id', '=', 'documento_franquia.franquia_id')
            ->leftJoin('documentos_upload', 'documentos_upload.documento_franquia_id', '=', 'documento_franquia.id')
            ->leftJoin('documento_status', 'documento_status.id', '=', 'documentos_upload.documento_status_id')
            ->select([
                'franquias.nome',
                'documento_franquia.id',
                'documentos.image',
                'documentos_upload.image as upload',
                'documentos.descricao',
                'documento_status.descricao as status',
                'documento_status.id as status_id',
                'documentos_upload.obs',
                \DB::raw('DATE_FORMAT(documentos.created_at,"%d/%m/%Y") as created_at'),
                \DB::raw('DATE_FORMAT(documentos_upload.created_at,"%d/%m/%Y") as upload_created_at'),

            ]);
            //->where('franquias.id', '=', Auth::user()->franquia->id);

         return Datatables::of($rows)
             ->filter(function ($query) use ($request) {
                 # Filtranto por disciplina
                 if ($request->has('documento')) {
                     $query->where('documentos.descricao', 'like', "%" . $request->get('documento') . "%");
                 }

                 if ($request->has('franquia_id')) {
                     $query->where('franquias.id', '=' ,$request->get('franquia_id'));
                 }

             })

             ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="sssss/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a  href="#" class="btn btn-primary importar-arquivo" title="importar arquivo">
                                    <span id="' . $row->id . '" class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                </a>
                                <a  href="#" class="btn btn-primary edit" ttitle="Editar">
                                    <span id="' . $row->id . '" class="glyphicon glyphicon-edit" aria-hidden="true"></span>
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
        $franquias = Franquia::pluck('nome','id')->all();
        $roles = \Spatie\Permission\Models\Role::pluck('name','id')->all();
        return view('users.create', compact('roles', 'franquias'));
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
        $franquias = Franquia::pluck('nome','id')->all();
        $user = User::with('roles', 'franquia')->findOrFail($id);
        //dd($user);
        $roles = \Spatie\Permission\Models\Role::pluck('name','id')->all();

        //dd($user->roles[0]->id);
        return view('users.edit', compact('user', 'roles', 'franquias'));

    }


    public function updateUpload(Request $request)
    {
        try {

            $obs = $request->get('obs');
            $documento_franquia_id = $request->get('documento_franquia_id');
            $documento_status_id = $request->get('documento_status_id');

            if(!$documento_status_id) $documento_status_id = 1;


            $data = DB::table('documentos_upload')
                ->where('documento_franquia_id', $documento_franquia_id)
                ->update(['obs' => $obs, 'documento_status_id' => $documento_status_id]);



            return response()->json(['success' => true, 'msg' => $request->get('obs')]);

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error_message' => $e->getMessage()]);
        }
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
    public function update($id, UserFormRequest $request)
    {
        try {

            //$this->affirm($request);
            $data = $request->getData();

            $user = User::findOrFail($id);

            if(empty($data['password'])){
                $data['password'] = $user->password;
            }else{
                $data['password'] = \Hash::make($data['password']);
            }

            $user->update($data);
            //dd($user);
            //Retora o id do ROLE
            $role_r =  \Spatie\Permission\Models\Role::where('id', '=', $data['role'])->first();
            $user->syncRoles($role_r);

            return redirect()->route('users.user.edit', $user->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

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

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
      protected function getData(Request $request)
        {
        $data = $request->only(['name', 'email', 'password', 'role', 'franquia_id']);

        return $data;
    }

}
