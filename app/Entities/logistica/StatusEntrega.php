<?php

namespace Serbinario\Entities\logistica;

use Illuminate\Database\Eloquent\Model;

class StatusEntrega extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status_entrega';

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
        'descricao',
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
