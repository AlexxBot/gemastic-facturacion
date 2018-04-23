<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes';

    protected $primaryKey ='ID';

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_Usuario');
    }
}
