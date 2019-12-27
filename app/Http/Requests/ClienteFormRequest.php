<?php

namespace Serbinario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ClienteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return  [
            'tipo' => 'required',
            'nome' => 'required|string|min:0|max:255',
            'celular' => 'required|string|min:0|max:20',
            'email' => 'required|string|min:0|max:100',
            'cpf_cnpj' => 'required|unique:clientes,cpf_cnpj,'. $this->cliente,'id',
            'nome_empresa' => 'nullable|string|min:0|max:255',
            'cep' => 'nullable|string|min:0|max:10',
            'numero' => 'nullable|string|min:0|max:10',
            'endereco' => 'nullable|string|min:0|max:200',
            'complemento' => 'nullable|string|min:0|max:200',
            'estado' => 'nullable|string|min:0|max:2',
            'is_whatsapp' => 'nullable|boolean',
            'obs' => 'nullable',

        ];
    }


}
