<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo_Movimiento extends Model
{
    //
    protected $table = 'motivo_movimientos';

    protected $primaryKey ='ID';

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
