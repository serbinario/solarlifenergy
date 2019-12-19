<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
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
       if(isset($cpf_cnpj)){
           return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Ja existe um cliente cadastrado']);
       }
        return \Illuminate\Support\Facades\Response::json(['success' => false,  'msg' => 'eeeeeeee']);

    }

    public function consultaPotencia(Request $request ){
        // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON
        $response = Curl::to('https://www.portalsolar.com.br/api/leads')
            ->withData( array( 'lead[name]' => 'Paulo+Vaz',
                'lead[email]' => "psgva@gmail.com",
                'lead[state]' => "PE",
                'lead[city]' => "Carpina",
                'lead[postalcode]' => "51170620",
                'lead[monthly_usage]' => "7000",
                'lead[kind]' => "email"
                ) )
            //->asJson()
            ->post();
        //dd(json_decode($response, true));
        //return \Illuminate\Support\Facades\Response::json(['success' => true,  'msg' => $response]);
    }





}
