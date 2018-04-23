<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Comprobante extends Model
{
    //
    protected $table = 'tipo_comprobantes';

    protected $primaryKey ='ID';

    public $incrementing = false;

    protected $keyType = 'string'; //protected $casts = ['id' => 'string'];

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
