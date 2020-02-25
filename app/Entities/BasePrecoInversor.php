<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class BasePrecoInversor extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_preco_inversores';

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
        'base_preco_revenda_id',
        'max_modulos',
        'valor'
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
   // public function basePrecoInversores()
   // {
       // return $this->belongsTo('Serbinario\Entities\basePrecoInversores','cidade_id','id');
   // }


}
