<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Procuracao extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'procuracoes';

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
                  'cliente_id',
                  'data_validade'
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
     * Set the data_validade.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataValidadeAttribute($value)
    {
        $this->attributes['data_validade'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get data_validade in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataValidadeAttribute($value)
    {
        return $value == "" ? "" : date('d/m/Y', strtotime($value));


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
