<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    //
    protected $table = 'negocios';

    protected $primaryKey ='ID';

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
