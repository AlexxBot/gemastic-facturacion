<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad_Medida extends Model
{
    //
    protected $table = 'unidad_medidas';

    protected $primaryKey ='ID';

    /**
    *timestamped
    *@var bool
    */
    public $timestamps = false;
}
