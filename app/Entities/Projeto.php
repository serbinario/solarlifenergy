<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{

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
    protected $table = 'projetos';

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
        'clientes_id',
        'consumo',
        'area_disponivel',
        'users_id',
        'projeto_codigo',
        'prioridade',
        'obs',
        'valor_projeto',
        'kw',
        'res_documentacao',
        'res_acompanhamento',
        'end_intalacao',
        'coordenadas'
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
     * Get the cliente for this model.
     */
    public function cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','clientes_id','id');
    }

    /**
     * Get the cliente for this model.
     */
    public function users()
    {
        return $this->belongsTo('Serbinario\User','users_id','id');
    }

    /**
     * Get the projeto for this model.
     */
    public function contratos()
    {
        return $this->hasMany('Serbinario\Entities\ContratoCelpe','projetos_id','id');
    }

    public function setValorProjetoAttribute($value)
    {
        if(!$value == null){
            $value = str_replace(".","",$value);
            $value = str_replace(",",".",$value);
            $this->attributes['valor_projeto'] =  $value;
        }
    }

    public function setKwAttribute($value)
    {
        //dd($value);
        if(!$value == null){
            $value = str_replace(".","",$value);
            $value = str_replace(",",".",$value);
            $this->attributes['kw'] =  $value;
        }
    }

    public function setAreaDisponivelAttribute($value)
    {
        //dd($value);
        if(!$value == null){
            $value = str_replace(".","",$value);
            $value = str_replace(",",".",$value);
            $this->attributes['area_disponivel'] =  $value;
        }
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getResDocumentacaoAttribute($value)
    {
        //dd($value);
        return strtoupper($value);
        //return strtotime($value);
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getResAcompanhamentoAttribute($value)
    {
        //dd($value);
        return strtoupper($value);
        //return strtotime($value);
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEndIntalacaoAttribute($value)
    {
        //dd($value);
        return strtoupper($value);
        //return strtotime($value);
    }






}
