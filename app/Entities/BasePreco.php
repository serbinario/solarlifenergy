<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class BasePreco extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_precos';

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
        'kw_minimo',
        'inversor_mult',
        'estrutura_mult',
        'infra_mult',
        'kit_moni_mult',
        'valor_modulo'
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



}
