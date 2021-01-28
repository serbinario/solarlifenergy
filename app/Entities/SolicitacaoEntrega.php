<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Endereco
 */
class SolicitacaoEntrega extends Model
{
    protected $table = 'solicitacao_entrega';

    public $timestamps = false;

    protected $guarded = [];

    protected $fillable = [
        'projeto_id',
        'status_entrega_id',
        'data_entrega',
        'obs',
        'file'
    ];

    public function getColumnsTable() {
        return $this->fillable;
    }


    public function projeto()
    {
        return $this->belongsTo('Serbinario\Entities\Projetov2','projeto_id','id');
    }

    public function statusEntrega()
    {
        return $this->belongsTo('Serbinario\Entities\logistica\StatusEntrega','status_entrega_id','id');
    }

    public function setDataEntregaAttribute($value)
    {
        $this->attributes['data_entrega'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    public function getDataEntregaAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

        
}