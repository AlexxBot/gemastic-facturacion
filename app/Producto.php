<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos';

    protected $primaryKey ='ID';

    /**
    *timestamped
    *@var bool
    */
    public $timestamps = false;
    public function Unidad_Medida()
    {
        return $this->belongsTo('App\Unidad_Medida','ID_UnidadMedida','ID');
    }
    public function Categoria()
    {
        return $this->belongsTo('App\Categoria','ID_Categoria','ID');
    }
    public function Fabricante()
    {
        return $this->belongsTo('App\Fabricante','ID_Fabricante','ID');
    }
}
