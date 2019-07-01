<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projetos';

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
                  'clientes_id',
                  'consumo',
                  'area_disponivel',
                  'users_id',
        'projeto_codigo',
        'prioridade',
        'obs'
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
    public function cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','clientes_id','id');
    }

    /**
     * Get the projeto for this model.
     */
    public function contratos()
    {
        return $this->hasMany('Serbinario\Entities\ContratoCelpe','projetos_id','id');
    }






}
