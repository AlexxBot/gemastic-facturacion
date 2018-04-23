<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';

    protected $primaryKey ='ID';

    /**
     * indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function perfil()
    {
        return $this->belongsTo('App\Perfil', 'Id_Perfil', 'ID');
    }

    public function negocio()
    {
        return $this->belongsTo('App\Negocio', 'Id_Negocio', 'ID');
    }
}
