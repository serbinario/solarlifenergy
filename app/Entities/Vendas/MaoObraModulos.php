<?php

namespace Serbinario\Entities\Vendas;

use Illuminate\Database\Eloquent\Model;

class MaoObraModulos extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mao_obra_modulos';

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
        'max_modulos',
        'valor_mao_obra'
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

    public function modulo()
    {
        return $this->belongsTo('Serbinario\Entities\Modulo','modulo_id');
    }



}
