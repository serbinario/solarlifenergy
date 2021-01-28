<?php

namespace Serbinario\Entities\logistica;

use Illuminate\Database\Eloquent\Model;

class PropostaProduto extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proposta_produtos';

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
        'proposta_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'valor_total'
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
