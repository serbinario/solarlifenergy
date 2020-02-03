<?php

namespace Serbinario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PrePropostaFormRequest extends FormRequest
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
            'cliente_id' => 'required',
            'monthly_usage' => 'required',
            'preco_kwh' => 'required',
            'panel_potencia' => 'required',
            'cidade_id' => 'required'

        ];
    }
}
