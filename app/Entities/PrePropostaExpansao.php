<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class PrePropostaExpansao extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pre_proposta_expansao';

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
                'inversor',
        'potencia_modulo',
        'qtd_modulos'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    public $timestamps = false;
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

}
