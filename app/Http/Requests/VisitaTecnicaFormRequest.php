<?php

namespace Serbinario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class VisitaTecnicaFormRequest extends FormRequest
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
            //'projeto_status_id' => 'required',
            //'users_id' => 'required',
           // 'grupo_id' => 'required',
        ];
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    function getData()
    {
        $data = $this->only([
            'ie_fibrocimento',
            'ie_metalico',
            'ie_barro',
            'ie_fibrocim_alta',
            'ie_laje',
            'ie_outros',
            'ie_area_suficiente',
            'ie_estrutura_estar_apta',
            'ie_reforcos_necessarios',
            'ie_ha_vazamentos',
            'ie_altura',
            'qtd_materiais_reforco',
            'riscos_acidentes',
            'material_especifico',
            'distancia_circuito_placas',
            'distancia_circuito_inversor_quadro_geral',
            'pe_metalico',
            'pe_barro',
            'pe_fibrocim_alta',
            'pe_dijuntor_geral',
            'pe_tampa_medidor',
            'pe_caixa_medidor',
            'pe_caixa_disjuntor',
            'pe_bitola_cabo_medidor_disjuntor_geral',
            'pe_bitola_rede_publica',
            'obs'
        ]);

        return $data;
    }


}
