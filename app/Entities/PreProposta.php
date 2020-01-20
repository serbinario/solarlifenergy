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
        'codigo',
        'data_validade',
        'monthly_usage',
        'preco_medio_instalado',
        'potencia_instalada',
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
        'cidade_id'
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

    /**
     * Get the Cliente for this model.
     */
    public function cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','cliente_id','id');
    }

    public function cidade()
    {
        return $this->belongsTo('Serbinario\Entities\Cidade','cidade_id','id');
    }

    public function setPrecoMedioInstaladoAttribute($value)
    {
        $this->attributes['preco_medio_instalado'] = $value == "" ? null: $this->convertesRealIngles($value);
    }

    public function getPrecoMedioInstaladoAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function setEconomiaAnulaAttribute($value)
    {
        $this->attributes['economia_anula'] = $value == "" ? null: $this->convertesRealIngles($value);
    }

    public function getEconomiaAnulaAttribute($value)
    {
        return $this->converteInglesReal($value);
    }

    public function setPrecoKwhAttribute($value)
    {
        $this->attributes['preco_kwh'] = $value == "" ? null: $this->convertesRealIngles($value);
    }

    public function getPrecoKwhAttribute($value)
    {
        //dd(number_format($value,4,",","."));
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



}
