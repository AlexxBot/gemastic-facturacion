<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    //
    protected $table = 'impuestos';

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
