<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'Categorias';

    protected $primaryKey ='ID';

    /**
    *timestamped
    *@var bool
    */
    public $timestamps = false;
}
