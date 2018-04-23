<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $table = 'perfiles';

    protected $primaryKey ='ID';

    /**
    *timestamped
    *@var bool
    */
    public $timestamps = false;
}
