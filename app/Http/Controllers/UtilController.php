<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cidade;
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

    public function getCidades($id){
        $cidades = Cidade::where('estado_id', '=', $id)->pluck('nome','id');
        return \Illuminate\Support\Facades\Response::json(['success' => false,  'cidades' => $cidades]);
    }






}
