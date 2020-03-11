<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Progetov2 extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'progetosv2';

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
                  'proposta_id',
                  'endereco_id',
                  'projeto_documento_id',
                  'projeto_execurcao_id',
                  'projeto_finalizando_id',
                  'obs'
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
     * Get the contaContrato for this model.
     */
    public function contaContrato()
    {
        return $this->hasOne('Serbinario\Entities\ContasContrato','projetov2_id','id');
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
