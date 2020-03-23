<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetosDocumento
 */
class ProjetosDocumento extends Model
{
    protected $table = 'projetos_documentos';

    public $timestamps = false;

    protected $fillable = [
        'cpf_cnh_rg',
        'cpf_cnh_rg_image',
        'conprovante_residencia',
        'conprovante_residencia_image',
        'cpf_cnh_rg_conjugue',
        'cpf_cnh_rg_conjugue_image',
        'certidao_casamento',
        'certidao_casamento_image',
        'ficha_elaboracao_projeto',
        'ficha_elaboracao_projeto_image',
        'declaracao_ciencia',
        'declaracao_ciencia_image',
        'proposta',
        'proposta_image',
        'contrato',
        'contrato_image'
    ];

    protected $guarded = [];

    public function getColumnsTable() {
        return $this->fillable;
    }

}