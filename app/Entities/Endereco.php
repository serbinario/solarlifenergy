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
        'logradouro',
        'cep',
        'numero',
        'complemento',
        'bairro',
        'uf',
        'cidade',
        'coordenadas'
    ];

    public function getColumnsTable() {
        return $this->fillable;
    }
    protected $guarded = [];

        
}