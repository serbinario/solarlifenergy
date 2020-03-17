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
        'obs_finalizado'
    ];

    protected $guarded = [];

    public function getColumnsTable() {
        return $this->fillable;
    }


}