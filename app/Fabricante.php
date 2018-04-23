<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    //
    protected $table = 'fabricantes';

    protected $primaryKey ='ID';

    /**
    *timestamped
    *@var bool
    */
    public $timestamps = false;
}
