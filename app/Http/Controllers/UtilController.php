<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\PreProposta;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;
use Ixudra\Curl\Facades\Curl;

class UtilController extends Controller
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
     * Display a listing of the pools.
     *
     * @return Illuminate\View\View
     */
    public function consultaCpfCnpf(Request $request)
    {
       $cpf_cnpj =  Cliente::where('cpf_cnpj', '=', $request->input('cpf_cnpj') )->first();
       //dd($cpf_cnpj);
       if(isset($cpf_cnpj->cpf_cnpj)){
           return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Ja existe um cliente cadastrado']);
       }
        return \Illuminate\Support\Facades\Response::json(['success' => false,  'msg' => $cpf_cnpj]);

    }

    /*
     * Faz um simulação da geração a partir do site do portal solar
     * Passo por parametro CEP e valor mensal de consumo em whats,
     */
    public function simulaGeracao(Request $request ){

        //Passo como paramentro o CEP e ele me retorna qual estado e cidade
        //O retorno da cidade não ha todas, ai ele traz a mais prócima desse cep
        $dadosJson = Curl::to('https://www.portalsolar.com.br/api/proposals/nearest_city/' . $request->input('cep'))
            ->get();

        $dados = json_decode($dadosJson, true);
        $response = Curl::to('https://www.portalsolar.com.br/api/leads')
            ->withData( array( 'lead[name]' => 'Paulo+Vaz',
                'lead[email]' => "psgva@gmail.com",
                'lead[state]' => $dados['state'],
                'lead[city]' => $dados['city'],
                'lead[postalcode]' => $request->input('cep'),
                'lead[monthly_usage]' => '1.300',
                'lead[kind]' => "email"
                ) )
            //->asJson()
            ->post();

        $dadosArray = json_decode($response, true);
        dd($dadosArray);
        //PreProposta::create(['qtd_paineis' => $dadosArray['simulator']['quantity'] ]);
        return \Illuminate\Support\Facades\Response::json(['success' => true,  'msg' => 'Pré-Proposta atualizada coom sucesso ', 'dados' => $dadosArray['simulator']]);
        //return \Illuminate\Support\Facades\Response::json(['success' => true,  'msg' => $dadosArray['quantity']]);
    }

    /*
     * Faz um simulação da geração a partir do site do portal solar
     * Passo por parametro CEP e valor mensal de consumo em whats,
     */
    public function simulaGeracaoe(Request $request ){

        //Passo como paramentro o CEP e ele me retorna qual estado e cidade
        //O retorno da cidade não ha todas, ai ele traz a mais prócima desse cep
        $dadosJson = Curl::to('https://www.portalsolar.com.br/api/proposals/nearest_city/' . $request->input('cep'))
            ->get();

        $dados = json_decode($dadosJson, true);
        $response = Curl::to('https://www.portalsolar.com.br/api/solar-calculator/new')
            ->withData( array(
                'authenticity_token' => '4tMCL8MCKzxz20rrYUJVKXPRkG91s/XK2/z2Ikxc4p3ZM5aF1Lx+byCh3Sf5CFjA44yigPGYPi95f0+Cp3V2Bw==',
                'token' => '3e0b62f92937eff344872c0318a876b2618b38252cfe14aec337e41f483431ff',
                'name' => 'Paulo+Vaz',
                'email' => "psgva@gmail.com",
                'mobile' =>'(81)55555555',
                'cpf_cnpj' => '22.222.222/2222-22',
                'place' => 'Residência',
                'postalcode' => '51170-620',
                'state_from_cep' => 'PE',
                'city_from_cep' => "Recife",
                    'address_name' => 'Rua Antônio Cardoso da Fonte',
                'address_number' => '222',
                'power_distributor_id' => '7',
                'light_bill' => '700'

            ) )
            //->asJson()
            ->post();

        $dadosArray = json_decode($response, true);
        dd($dadosArray);
        //PreProposta::create(['qtd_paineis' => $dadosArray['simulator']['quantity'] ]);
        return \Illuminate\Support\Facades\Response::json(['success' => true,  'msg' => 'Pré-Proposta atualizada coom sucesso ', 'dados' => $dadosArray['simulator']]);
        //return \Illuminate\Support\Facades\Response::json(['success' => true,  'msg' => $dadosArray['quantity']]);
    }





}
