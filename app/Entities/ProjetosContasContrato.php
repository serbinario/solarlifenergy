<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetosContasContrato
 */
class ProjetosContasContrato extends Model
{
    protected $table = 'projetos_contas_contrato';

    public $timestamps = false;

    protected $fillable = [
        'num_contacontrato',
        'percentual',
        'projetov2_id'
    ];

    protected $guarded = [];

        
}