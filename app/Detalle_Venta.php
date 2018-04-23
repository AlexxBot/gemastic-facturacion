<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Venta extends Model
{
    //
    //
    protected $table = 'detalle_ventas';

    //protected $primaryKey =['ID_Producto','ID_UnidadMedida'];
    //protected $primaryKey ='ID_Producto';


    protected $primaryKey = array('ID_Venta','ID_Producto','ID_UnidadMedida');

    /**
    *
    *
    * @var boolean*/
    public $timestamps = false;
    public $incrementing = false;
    public function Venta()
    {
        return $this->belongsTo('App\Venta','ID_Venta','ID');
    }
    public function Producto()
    {
        return $this->belongsTo('App\Producto','ID_Producto','ID');
    }
    public function Unidad_Medida()
    {
        return $this->belongsTo('App\Unidad_Medida','ID_UnidadMedida','ID');
    }
}
