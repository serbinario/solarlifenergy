<?php

namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Serbinario\Entities\Vendas\Pedido;
use Serbinario\Entities\Vendas\Produto;
use Serbinario\User;
use Exception;

class PedidoController extends Controller
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


        return view('vendas.index');
//        $pedido = Pedido::find(1);
//        $pedido->produtos()->attach([1 => [ "quantidade" => 340, "valor_unitario" => 450.1  ], 2 => [  "quantidade" => 100, "valor_unitario" => 10.1 ]]);
//        dd("qq");
//
//
//        //$sync_data = [];
//        //for($i = 0; $i < count($allergy_ids); $i++))
//        //$sync_data[$allergy_ids[$i]] = ['severity' => $severities[$i]];
//
//        //$food->allergies()->sync($sync_data);
//
//
//        //$food = Food::find(1);
//        //$food->allergies()->sync([1 => ['severity' => 3], 4 => ['severity' => 1]]);
//
//        $pedido = Pedido::find($request[0]['pedido_id']);
//        $pedido->produtos()->attach('1');
//        dd($pedido);
//        //$shop->products()->attach($product_id);
//        return dd($request->all());
//        return dd(Pedido::with('produtos')->get());
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid()
    {

    }

    public function getAllProducts()
    {
        $rows = \DB::table('produtos')
            ->Join('grupos', 'grupos.id', '=', 'produtos.grupo_id')
            ->Join('marcas', 'marcas.id', '=', 'produtos.marca_id')
            ->select([
                'produtos.id',
                'produto',
                'preco_revenda',
                'produtos.ativo',
                'estoque',
                'grupos.grupo',
                'grupos.id as grupo_id',
                'marcas.marca'

            ]);
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return  response()->json($rows->get(), 200, $header,  JSON_UNESCAPED_UNICODE);
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
        $franquias = Franquia::pluck('nome','id')->all();
        $user = User::with('roles', 'franquia')->findOrFail($id);
        //dd($user);
        $roles = \Spatie\Permission\Models\Role::pluck('name','id')->all();

        //dd($user->roles[0]->id);
        return view('users.edit', compact('user', 'roles', 'franquias'));

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
