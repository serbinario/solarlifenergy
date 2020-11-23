<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modulos';

    public $timestamps = false;

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
        'potencia',
        'rendimento',
        'area_total',
        'area_geracao',
        'is_active'

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
