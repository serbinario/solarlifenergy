<?php

namespace Serbinario\Entities\Vendas;

use Illuminate\Database\Eloquent\Model;

class InversorModulo extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inversor_modulos';

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

    function modulo(){
        return $this->belongsTo('Serbinario\Entities\Modulo','modulo_id','id');
    }
    public function produto()
    {
        return $this->belongsTo('Serbinario\Entities\Vendas\Produto','produto_id', 'id');
    }

}
