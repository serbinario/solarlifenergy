<?php

namespace Serbinario\Entities\Financeiro;

use Illuminate\Database\Eloquent\Model;

class ContasPagarReceberDetalhe extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fin_contas_pagar_receber_detalhe';

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
        'conatas_pagar_receber_id',
        'parcela_numero',
        'doc_numero',
        'valor_parcela',
        'valor_falta',
        'data_vence',
        'data_pago',
        'status_id',
        'juros',
        'desconto'

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
