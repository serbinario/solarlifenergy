<?php

namespace Serbinario\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Projeto;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Models\ClienteWeb;
use Exception;

class ClienteWebController extends Controller
{


    public function create()
    {

        return view('cliente_web.create');
    }

    /**
     * Store a new cliente web in the storage.
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
            //dd($request->all());

            $cliente = Cliente::create($data);

            //dd($data);
            /*
             * Apos criar um cliente e criado um projeto para o mesmo
             */
            $cliente->id;

            $cur_date = Carbon::now();

            //Retorna o ano so os dois ultimos digitos
            $ano = $cur_date->format('y');

            //Retorna o ultimo registro
            $last = \DB::table('projetos')->orderBy('id', 'DESC')->first();


            //Corrigir o problema da virada do ano
            $projeto_codigo = $last->projeto_codigo +1;

            $projeto = array();
            $projeto['clientes_id'] = $cliente->id;
            $projeto['projeto_codigo'] = $projeto_codigo;
            $projeto['consumo'] = $data['consumo'];
            //Deixei esse fixo pois o cliente que se cadastrar vai entrar como integrador online que esta com o id 7
            $projeto['users_id'] = '7';



            $projeto = Projeto::create($projeto);

            return redirect()->route('clienteweb')
                             ->with('success_message', 'Cliente Web was successfully added.');

        } catch (Exception $exception) {

            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
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
                'nome' => 'nullable|string|min:0|max:255',
            'tipo' => 'nullable',
            'cpf_cnpj' => 'nullable|string|min:0|max:20',
            'celular' => 'nullable|string|min:0|max:20',
            'email' => 'nullable|string|min:0|max:100',
            'nome_empresa' => 'nullable|string|min:0|max:255',
            'cep' => 'nullable|string|min:0|max:10',
            'is_whatsapp' => 'nullable|boolean'
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
        $data = $request->only(['nome', 'tipo', 'cpf_cnpj', 'celular', 'email', 'nome_empresa', 'cep',  'is_whatsapp', 'tipo', 'consumo']);
        $data['is_whatsapp'] = $request->has('is_whatsapp');

        return $data;
    }

}
