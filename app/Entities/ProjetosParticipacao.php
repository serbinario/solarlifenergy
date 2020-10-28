<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjetosParticipacao extends Model
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
    protected $table = 'projetos_participacao';

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
        'pago',
        'data_pagamento',
        'data_prevista',
        'obs',
        'projetov2_id'

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

    public function getColumnsTable() {
        return $this->fillable;
    }

    public function getDataPagamentoAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }




}
