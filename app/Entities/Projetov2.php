<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Projetov2 extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projetosv2';

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
        'codigo',
        'cliente_id',
        'projeto_status_id',
        'projeto_prioridade_id',
        'proposta_id',
        'endereco_id',
        'projeto_documento_id',
        'projeto_execurcao_id',
        'projeto_finalizando_id',
        'projeto_finalizado_id',
        'res_documentacao',
        'res_acompanhamento',
        'data_prevista',
        'conta_contrato_anterior',
        'conta_contrato_atual',
        'titularidade_projeto',
        'titularidade_projeto_cpf',
        'obs',
        'pendencia',
        'arquivado',
        'pendencia_juridica',
        'obs_juridica',
        'data_pagamento_projeto'
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

    /**
     * Get the projeto for this model.
     */
    public function contratos()
    {
        return $this->hasMany('Serbinario\Entities\ProjetosContasContrato','projetov2_id','id');
    }

    /**
     * Get the projeto for this model.
     */
    public function contrato()
    {
        return $this->hasOne('Serbinario\Entities\Contrato','projeto_id','id');
    }

    public function solicitacaoEntrega()
    {
        return $this->hasOne('Serbinario\Entities\SolicitacaoEntrega','projeto_id','id');
    }

    /**
     * Get the projeto for this model.
     */
    public function imagens()
    {
        return $this->hasMany('Serbinario\Entities\ProjetosImage','projetov2_id','id');
    }



    public function setDataPrevistaAttribute($value)
    {
        $this->attributes['data_prevista'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function getDataPrevistaAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    public function setDataPagamentoProjetoAttribute($value)
    {
        $this->attributes['data_pagamento_projeto'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function getDataPagamentoProjetoAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    /**
     * Get the cliente for this model.
     */
    public function cliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','cliente_id');
    }

    /**
     * Get the ProjetosStatus for this model.
     */
    public function ProjetosStatus()
    {
        return $this->belongsTo('Serbinario\Entities\ProjetoStatus','projeto_status_id','id');
    }

    /**
     * Get the PreProposta for this model.
     */
    public function PreProposta()
    {
        return $this->belongsTo('Serbinario\Entities\PreProposta','proposta_id','id');
    }

    /**
     * Get the Endereco for this model.
     */
    public function Endereco()
    {
        return $this->belongsTo('Serbinario\Entities\Endereco','endereco_id','id');
    }

    /**
     * Get the ProjetosDocumento for this model.
     */
    public function ProjetosDocumento()
    {
        return $this->belongsTo('Serbinario\Entities\ProjetosDocumento','projeto_documento_id','id');
    }


    /**
     * Get the ProjetosExecurcao for this model.
     */
    public function ProjetosExecurcao()
    {
        return $this->belongsTo('Serbinario\Entities\ProjetosExecurcao','projeto_execurcao_id','id');
    }

    /**
     * Get the ProjetosFinalizando for this model.
     */
    public function ProjetosFinalizando()
    {
        return $this->belongsTo('Serbinario\Entities\ProjetosFinalizando','projeto_finalizando_id','id');
    }

    /**
     * Get the ProjetosFinalizando for this model.
     */
    public function ProjetosFinalizado()
    {
        return $this->belongsTo('Serbinario\Entities\ProjetosFinalizado','projeto_finalizado_id','id');
    }

    /**
     * Get the contaContrato for this model.
     */
    public function contaContrato()
    {
        return $this->hasOne('Serbinario\Entities\ProjetosContasContrato','projetov2_id','id');
    }

    public function participacao()
    {
        return $this->hasOne('Serbinario\Entities\ProjetosParticipacao','projetov2_id','id');
    }




    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return $value == "" ? "" : date('d/m/Y', strtotime($value));


    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return $value == "" ? "" : date('d/m/Y', strtotime($value));


    }

}
