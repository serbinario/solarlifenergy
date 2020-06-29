<?php

namespace Serbinario\Entities\Vendas;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marcas';

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
