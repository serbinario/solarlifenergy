<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class BasePrecoRevenda extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_preco_revendas';

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
        'nome'
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
    public function basePrecoInversores()
    {
        return $this->hasMany('Serbinario\Entities\BasePrecoInversor','base_preco_revenda_id','id');
    }

    /**
     * Get the cliente for this model.
     */
    public function basePrecoEstruturaEletrica()
    {
        return $this->hasMany('Serbinario\Entities\BasePrecoEstruturaEletrica','base_preco_revenda_id','id');
    }


    public function basePrecoModulos()
    {
        return $this->hasMany('Serbinario\Entities\BasePrecoModulo','base_preco_revenda_id','id');
    }


}
