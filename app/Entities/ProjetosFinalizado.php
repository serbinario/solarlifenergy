<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetosFinalizando
 */
class ProjetosFinalizado extends Model
{
    protected $table = 'projetos_finalizado';

    public $timestamps = false;

    protected $fillable = [
        'contas_compensacao_cadastrada',
        'data_conexao',
        'obs_finalizado'
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
    public function setDataConexaoAttribute($value)
    {
        $this->attributes['data_conexao'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataConexaoAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }


}