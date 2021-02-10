<?php

namespace Serbinario\Entities\Execucao;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ordem_servico';

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
        'projeto_id',
        'codigo',
        'tecnico_id',
        'data_visita',
        'ordem_tipo_id',
        'obs',
        'status_visita_id',
        'file'
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

    public function projeto()
    {
        return $this->belongsTo('Serbinario\Entities\Projetov2','projeto_id','id');
    }

    public function getDataVisitaAttribute($value)
    {
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
    }

    public function setDataVisitaAttribute($value)
    {
        $this->attributes['data_visita'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }


}
