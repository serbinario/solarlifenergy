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
        'preco_kwh'
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
    public function Cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','cliente_id','id');
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



}
