<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contratos';

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
        'franquia_id',
        'report_layout_id',
        'ano',
        'created_by',
        'updated_by'
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
    public function projeto()
    {
        return $this->belongsTo('Serbinario\Entities\Projeto','projeto_id');
    }

    /**
     * Get the franquium for this model.
     */
    public function franquia()
    {
        return $this->belongsTo('Serbinario\Entities\Franquia','franquia_id');
    }

    /**
     * Get the franquium for this model.
     */
    public function reportLayout()
    {
        return $this->belongsTo('Serbinario\Entities\ReportLayout','report_layout_id');
    }

    /**
     * Get the creator for this model.
     */
    public function creator()
    {
        return $this->belongsTo('Serbinario\User','created_by');
    }

    /**
     * Get the updater for this model.
     */
    public function updater()
    {
        return $this->belongsTo('Serbinario\User','updated_by');
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
