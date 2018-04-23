<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numeracion_Serie extends Model
{
    //
    protected $table = 'numeracion_series';

    protected $primaryKey ='ID';

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
