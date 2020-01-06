<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parametros';

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
                  'procu_nome',
                  'procu_rg',
                  'procu_orgao_expeditor',
                  'procu_cpf',
                  'procu_endereco',
                  'procu_bairro',
                  'procu_cidade',
                  'procu_estado',
                  'created_by',
                  'updated_by',
                  'franquia_id'
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
        return $this->belongsTo('Serbinario\Entities\Cliente','cliente_id');
    }

    /**
     * Get the creator for this model.
     */
    public function creator()
    {
        return $this->belongsTo('Serbinario\User','created_by');
    }

    /**
     * Get the updater for this model.
     */
    public function updater()
    {
        return $this->belongsTo('Serbinario\User','updated_by');
    }

    /**
     * Get the franquium for this model.
     */
    public function franquia()
    {
        return $this->belongsTo('Serbinario\Entities\Franquia','franquia_id');
    }



}
