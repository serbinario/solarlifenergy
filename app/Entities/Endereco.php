<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Endereco
 */
class Endereco extends Model
{
    protected $table = 'enderecos';

    public $timestamps = false;

    protected $fillable = [
        'rua',
        'cep',
        'numero',
        'complemento',
        'bairro',
        'uf',
        'cidade'
    ];

    protected $guarded = [];

        
}