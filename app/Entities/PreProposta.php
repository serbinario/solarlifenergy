<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;
use \Serbinario\Traits\UtilEntities;
class PreProposta extends Model
{
    use UtilEntities;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pre_propostas';

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
        'cliente_id',
        'user_id',
        'baco_fin_id',
        'modulo_id',
        'user_id',
        'prioridade_id',
        'codigo',
        'data_validade',
        'monthly_usage',
        'valor_modulo',
        'equipe_tecnica',
        'preco_medio_instalado',
        'valor_franquia',
        'desconto_equipamentos',
        'potencia_instalada',
        'total_equipamentos',
        'total_servico_operacional',
        'minima_area',
        'qtd_paineis',
        'economia_anula',
        'jan',
        'feb',
        'mar',
        'apr',
        'may',
        'jun',
        'jul',
        'aug',
        'sep',
        'oct',
        'nov',
        'dec',
        'panel_potencia',
        'preco_kwh',
        'na_ponta_jan',
        'na_ponta_feb',
        'na_ponta_mar',
        'na_ponta_apr',
        'na_ponta_may',
        'na_ponta_jun',
        'na_ponta_jul',
        'na_ponta_aug',
        'na_ponta_sep',
        'na_ponta_oct',
        'na_ponta_nov',
        'na_ponta_dec',
        'cidade_id',
        'produto1', 'qtd_paineis' ,'produto1_preco', 'produto1_nf',
        'produto2', 'qtd_inversores','produto2_preco', 'produto2_nf',
        'produto3', 'qtd_estrutura',  'produto3_preco', 'produto3_nf',
        'produto4', 'qtd_string_box', 'produto4_preco', 'produto4_nf',
        'produto5', 'qtd_kit_monitoramento', 'produto5_preco', 'produto5_nf',
        'qtd_homologacao', 'produto6_preco', 'produto6_nf',
        'qtd_mao_obra', 'produto7_preco', 'produto7_nf',
        'qtd_inst_pde', 'produto8_preco', 'produto8_nf',
        'qtd_mud_pde', 'produto9_preco', 'produto9_nf',
        'qtd_substacao', 'produto10_preco', 'produto10_nf',
        'qtd_refor_estrutura', 'produto11_preco', 'produto11_nf',
        'qtd_homologacao_projeto', 'produto12_preco', 'produto12_nf',
        'co2',
        'reducao_media_consumo',
        'gera_fv_jan',
        'gera_fv_fev',
        'gera_fv_mar',
        'gera_fv_abr',
        'gera_fv_mai',
        'gera_fv_jun',
        'gera_fv_jul',
        'gera_fv_ago',
        'gera_fv_set',
        'gera_fv_out',
        'gera_fv_nov',
        'gera_fv_dez',
        'entrada1_valor',
        'recurso1_banco',
        'entrada2_valor',
        'recurso2_banco',
        'entrada3_valor',
        'qtd_parcelas_entrada2',
        'recurso_proprio',
        'valor_vencimento',
        'estar_finalizado',
        'valor_franqueadora',
        'data_financiamento_bancario',
        'tempo_carencia',
        'data_prevista_parcela',
        'valor_descontos',
        'pre_proposta_obs',
        'pendencia_obs',
        'pendencia',
        'arquivado',
        'imposto_sobre_participacao',
        'roi',
        'royalties',
        'expansao',
        'expansao_id',
        'produto1_id',
        'produto2_id',
        'tipo_instalacao'

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

    public function bancoFinanciadora()
    {
        return $this->belongsTo('Serbinario\Entities\BancoFinanciadora','baco_fin_id','id');
    }
    /**
     * Get the projeto for this model.
     */
    public function projetov2()
    {
        return $this->hasMany('Serbinario\Entities\Projetov2','proposta_id','id');
    }
    /**
     * Get the Cliente for this model.
     */
    public function cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','cliente_id','id');
    }

    /**
     * Get the Cliente for this model.
     */
    public function modulo()
    {
        return $this->belongsTo('Serbinario\Entities\Modulo','modulo_id','id');
    }

    public function clienteExpansao()
    {
        return $this->belongsTo('Serbinario\Entities\PrePropostaExpansao','expansao_id','id');
    }

    /**
     * Get the cliente for this model.
     */
    public function user()
    {
        return $this->belongsTo('Serbinario\User','user_id','id');
    }

    public function cidade()
    {
        return $this->belongsTo('Serbinario\Entities\Cidade','cidade_id','id');
    }

    public function getValorDescontosAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getPrecoMedioInstaladoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getEconomiaAnulaAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getDescontoEquipamentosAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getPrecoKwhAttribute($value)
    {
        return number_format($value,4,",",".");
    }

    public function getDataValidadeAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    public function setDataValidadeAttribute($value)
    {
        $this->attributes['data_validade'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function setdataPrevistaParcelaAttribute($value)
    {
        $this->attributes['data_prevista_parcela'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function getdataPrevistaParcelaAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    public function setdataFinanciamentoBancarioAttribute($value)
    {
        $this->attributes['data_financiamento_bancario'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function getdataFinanciamentoBancarioAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }


    public function getEquipeTecnicaAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getValorFranquiaAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getValorModuloAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto1PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto2PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto3PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }



    public function getProduto4PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }



    public function getProduto5PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }



    public function getProduto6PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }



    public function getProduto7PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }


    public function getProduto8PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }


    public function getProduto9PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }


    public function getProduto10PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto11PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto12PrecoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto1NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto2NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto3NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto4NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto5NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto6NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto7NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto8NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto9NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto10NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getProduto11NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }
    public function getProduto12NfAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function getRecursoProprioAttribute($value)
    {
        return $value;
    }





}
