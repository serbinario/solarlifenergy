<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class ParametroGeral extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parametros_gerais';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                'active',
        'parameter_one'
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


}
