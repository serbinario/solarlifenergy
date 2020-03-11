<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContasContrato
 */
class ContasContrato extends Model
{
    protected $table = 'contas_contrato';

    public $timestamps = false;

    protected $fillable = [
        'num_contacontrato',
        'percentual',
        'projetov2_id'
    ];

    protected $guarded = [];

        
}