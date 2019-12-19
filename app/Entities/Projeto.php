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
        'coordenadas',
        'data_prevista',
        'kwh'
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
        $this->attributes['kw'] = $value == "" ? null: str_replace(".","",$value);

    }

    public function setKwhAttribute($value)
    {

        $this->attributes['kwh'] = $value == "" ? null: str_replace(".","",$value);
        //dd($value);

    }

    public function setAreaDisponivelAttribute($value)
    {
        $this->attributes['area_disponivel'] = $value == "" ? null: str_replace(".","",$value);
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

    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataPrevistaAttribute($value)
    {
        //dd($value);
        $this->attributes['data_prevista'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
        //dd($this->attributes['data_prevista']);

    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataPrevistaAttribute($value)
    {
        //dd( date('d/m/Y', strtotime($value)));
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
        //return strtotime($value);
    }






}
