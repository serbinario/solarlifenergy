<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class DocumentoUpload extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documentos_upload';

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
                'image',
        'documento_status_id',
        'fanquia_id',
        'documento_franquia_id'
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


}
