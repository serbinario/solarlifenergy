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
        'submeter_vistoria',
        'obter_protocolo',
        'obter_protocolo_image',
        'agendar',
        'agendar_nota',
        'agendar_data',
        'agendar_equipe',
        'realizar',
        'finalizado'
    ];

    protected $guarded = [];

        
}