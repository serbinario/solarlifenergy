<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alerts';

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
                'title',
        'description',
        'parent_id',
        'franquia_id'
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

    public function franquia()
    {
        return $this->hasOne('Serbinario\Entities\Franquia','id','franquia_id');
    }


}
