<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 04/08/18
 * Time: 10:39
 */

namespace serbinario\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\MeioCaptacao;
use Serbinario\Entities\ParametroGeral;
use Serbinario\Http\Controllers\Controller;


class GeralController extends Controller
{
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
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $parametroGeral = ParametroGeral::all();

        $parametroRoi = $parametroGeral[0];

        dd($parametroRoi);


        return view('geral.index', compact('clientes'));
    }

    public  function edit(){
        $parametroGeral = ParametroGeral::all();

        $parametroRoi = $parametroGeral[0];

        return view('geral.edit', compact('parametroRoi'));


    }



    /**
     * Update the specified cliente in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {

        try {
            dd($request->all());
            $cliente = Cliente::findOrFail($id);
            $data = $this->getData($request, $cliente);
            //$data['user_id'] = \Auth::id();
            //dd($data);
            $cliente->update($data);

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }


}