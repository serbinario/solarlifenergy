<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

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
        'celular',
        'email',
        'tipo',
        'cpf_cnpj',
        'estado_civil',
        'nome_empresa',
        'cep',
        'numero',
        'endereco',
        'complemento',
        'estado',
        'is_whatsapp',
        'obs',
        'conjugue',
        'conjugue_cpf',
        'rg',
        'cpf',
        'data_emissao_rg',
        'orgao_emissor_rg',
        'naturalidade_uf',
        'naturalidade_cidade',
        'data_nascimento',
        'cidade',
        'user_id',
        'nacionalidade'
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
        return $this->hasOne('Serbinario\Entities\Projeto','clientes_id','id');
    }

    /*
         * echo mask($cnpj,'##.###.###/####-##');
        echo mask($cpf,'###.###.###-##');
        echo mask($cep,'#####-###');
        echo mask($data,'##/##/####');
         */

    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataEmissaoRgAttribute($value)
    {
        $this->attributes['data_emissao_rg'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }



    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] =  !empty($value) ? substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2) : null;
    }



    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataEmissaoRgAttribute($value)
    {
        //dd($value);
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
        //return strtotime($value);
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataNascimentoAttribute($value)
    {
        //dd($value);
        return  $value == "" ? "" : date('d/m/Y', strtotime($value));
        //return strtotime($value);
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getNomeAttribute($value)
    {
        //dd($value);
        return strtoupper($value);
        //return strtotime($value);
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEnderecoAttribute($value)
    {
        //dd($value);
        return strtoupper($value);
        //return strtotime($value);
    }

}
