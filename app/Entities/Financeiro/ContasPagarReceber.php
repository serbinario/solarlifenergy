<?php

namespace Serbinario\Entities\Financeiro;

use Illuminate\Database\Eloquent\Model;

class ContasPagarReceber extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fin_contas_pagar_receber';

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
        'fonecedor_id',
        'projeto_id',
        'descricao',
        'valor_total',
        'data_emissao',
        'data_primeiro_vencimento',
        'qtd_parcelas',
        'tipo_id',
        'obs',
        'user_id',
        'category_id'

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
