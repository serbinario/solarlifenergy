<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetosExecurcao
 */
class ProjetosExecurcao extends Model
{
    protected $table = 'projetos_execurcao';

    public $timestamps = false;

    protected $fillable = [
        'material_entrege',
        'data_previsao_entrega_material',
        'validar_unidade_geradora',
        'elaborar_projeto',
        'emitir_art',
        'emitir_art_image',
        'solicitacao_acesso',
        'obter_protocolo_data_prevista',
        'submeter_projeto_image',
        'submeter_projeto_data',
        'obter_protocolo',
        'obter_protocolo_numero',
        'obter_protocolo_data',
        'parecer_acesso',
        'parecer_acesso_image',
        'parecer_relacionamento',
        'parecer_relacionamento_image',
        'obra_fechada',
        'obs_execurcao'
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
    public function setObterProtocoloDataAttribute($value)
    {
        $this->attributes['obter_protocolo_data'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getObterProtocoloDataAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setObterProtocoloDataPrevistaAttribute($value)
    {
        $this->attributes['obter_protocolo_data_prevista'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getObterProtocoloDataPrevistaAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

        
}