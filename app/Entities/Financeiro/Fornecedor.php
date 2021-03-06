<?php

namespace Serbinario\Entities\Financeiro;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fin_fornecedor';

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
        'name',
        'cpf_cnpj'

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

    public function childrenCategories()
    {
        return $this->hasMany('Serbinario\Entities\Financeiro\Category', 'parent_id')->with('categories');
    }

    public function categories()
    {
        return $this->hasMany('Serbinario\Entities\Financeiro\Category', 'parent_id');
    }

}
