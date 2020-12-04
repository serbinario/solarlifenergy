<?php

namespace Serbinario\Entities\Vendas;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produtos';

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
        'produto',
        'preco_revenda',
        'preco_franquia',
        'marca_id',
        'estoque',
        'grupo_id',
        'unidade_id'
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


    /*
     * One To Many
     */
    //function precos(){
    //return $this->hasMany('Serbinario\Entities\Vendas\Preco','produto_id','id');
    //}

    /*
     * Many to One
     */
    function marca(){
        //return $this->belongsTo('Serbinario\Entities\Vendas\Marca','marca_id','id');
        return $this->hasOne('Serbinario\Entities\Vendas\Marca','id','marca_id');
    }

    function grupo(){
        return $this->belongsTo('Serbinario\Entities\Vendas\Grupo','grupo_id','id');
    }

    public function produtos()
    {
        return $this->belongsToMany('Serbinario\Entities\Vendas\Pedido', 'pedido_produto');
    }


    public function getPrecoRevendaAttribute($value)
    {
        return number_format($value,2,",",".");
    }

    public function getPrecoFranquiaAttribute($value)
    {
        return number_format($value,2,",",".");
    }




}
