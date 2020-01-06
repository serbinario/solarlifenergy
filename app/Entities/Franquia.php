<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Franquia extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'franquias';

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
                  'nome',
                  'cpf_cnpj',
                  'contato',
                  'telefone',
                  'email',
                  'cidade',
                  'estado',
                  'endereco',
                  'cep',
                  'bairro',
                  'numero',
                  'complemento',
                  'is_active'
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
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
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
     * Get the projeto for this model.
     */
    public function parametro()
    {
        return $this->hasOne('Serbinario\Entities\Parametro','franquia_id','id');
    }



}
