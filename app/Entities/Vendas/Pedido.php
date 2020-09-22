<?php

namespace Serbinario\Entities\Vendas;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pedidos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                'cliente_id',
                'user_id',
        'faturado_por'
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

    public function produtos()
    {
        return $this->belongsToMany('Serbinario\Entities\Vendas\Produto', 'pedido_produto')
            ->withPivot('quantidade', 'valor_unitario');
    }

}
