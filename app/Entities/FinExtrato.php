<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class FinExtrato extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fin_extratos';

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
                  'ip_inicial',
                  'ip_final'
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
     * Get the mkPoolsHasMkProfile for this model.
     */
    public function mkPoolsHasMkProfile()
    {
        return $this->hasOne('Serbinario\Entities\MkPoolsHasMkProfile','mk_pool_id','id');
    }



}
