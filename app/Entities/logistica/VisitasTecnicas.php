<?php

namespace Serbinario\Entities\logistica;

use Illuminate\Database\Eloquent\Model;

class VisitasTecnicas extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visita_tecnica';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projeto_id',
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
        'obs',
        'tecnico_id',
        'status_visita_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function projeto()
    {
        return $this->belongsTo('Serbinario\Entities\PreProposta','projeto_id','id');
    }

}
