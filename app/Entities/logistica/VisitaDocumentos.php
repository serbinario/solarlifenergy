<?php

namespace Serbinario\Entities\logistica;

use Illuminate\Database\Eloquent\Model;

class VisitaDocumentos extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status_entrega';

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
        'foto_estrutura',
        'medicao_area',
        'localizacao',
        'disjuntor_geral',
        'visita_tecnica_id'
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

}
