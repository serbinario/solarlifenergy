<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetosFinalizando
 */
class ProjetosFinalizando extends Model
{
    protected $table = 'projetos_finalizando';

    public $timestamps = false;

    protected $fillable = [
        'solicitacao_vistoria',
        'obter_protocolo_vistoria_numero',
        'agendar',
        'agendar_nota',
        'agendar_data',
        'agendar_equipe',
        'realizar',
        'finalizado',
        'obs_falizando'
    ];

    protected $guarded = [];

    public function getColumnsTable() {
        return $this->fillable;
    }

    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setAgendarDataAttribute($value)
    {
        $this->attributes['agendar_data'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getAgendarDataAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }


}