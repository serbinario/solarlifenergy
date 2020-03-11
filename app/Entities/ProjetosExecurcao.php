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
        'submeter_projeto',
        'submeter_projeto_image',
        'submeter_projeto_data',
        'obter_protocolo',
        'obter_protocolo_numero_protocolo',
        'parecer_acesso',
        'parecer_acesso_image',
        'parecer_relacionamento',
        'parecer_relacionamento_image',
        'obra_fechada',
        'obs'
    ];

    protected $guarded = [];

        
}