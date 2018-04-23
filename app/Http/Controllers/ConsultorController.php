<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Venta;
use App\Categoria;
use App\Fabricante;
use App\Producto;
use App\Cliente;
use App\Almacen;
use App\Unidad_Medida;
use App\Producto_Empaque;

class ConsultorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function consultarVentas() //datos separados por negocio
    {
        $usuario = Auth::user();
        $ventas = Venta::where('ID_Negocio',$usuario['Id_Negocio'])->get();
        return view('perfil_consultor.listadoVentas',['ventas'=>$ventas]);
    }

    public function consultarProductos() //datos compartidos por todos los negocios
    {
        $unidad_medidas=Unidad_Medida::all();
        $categorias=Categoria::all();
        $fabricantes=Fabricante::all();
        $productos=Producto::all();
        return view('perfil_consultor.listadoProductos',['productos'=>$productos,'unidad_medidas'=>$unidad_medidas,'categorias'=>$categorias,'fabricantes'=>$fabricantes]);
    }

    public function productoslistado()
    {
        $productos=DB::table('productos')
        ->join('unidad_medidas','productos.ID_UnidadMedida','=','unidad_medidas.ID')
        ->join('categorias','productos.ID_Categoria','=','categorias.ID')
        ->join('fabricantes','productos.ID_Fabricante','=','fabricantes.ID')
        ->select('productos.ID as ID','productos.Nombre as Nombre','productos.Stock','unidad_medidas.Nombre as UnidadMedida','categorias.Nombre as Categoria','fabricantes.RazonSocial as Fabricante','productos.*');
        /*$productos_empaques=DB::table('producto_empaques')
        ->join('unidad_medidas','producto_empaques.ID_UnidadMedida','=','unidad_medidas.ID')
        ->join('productos','productos.ID','=','producto_empaques.ID_Producto')
        ->select(DB::raw("CONCAT(producto_empaques.ID_Producto,'-',unidad_medidas.ID) as ID"),'productos.Nombre',DB::raw('productos.Stock / producto_empaques.Equivalencia as Stock'),'unidad_medidas.Nombre as UnidadMedida','producto_empaques.Precio1 as Precio1','producto_empaques.Precio2 as Precio2','producto_empaques.Precio3 as Precio3');
        $productos=$productos_generales->union($productos_empaques);
        return Datatables::of($productos)->make(true);

        $productos=Producto::all();*/
        return Datatables::of($productos)->make(true);
    }

    public function consultarPresentacionesProducto($id)
    {
        $unidad_medidas=Unidad_Medida::all();
        $producto = Producto::where('ID',$id)->first();
        $productos = Producto_Empaque::all();
        $producto_empaques = $productos->where('ID_Producto',$id);
        return view('perfil_consultor.listadoPresentacionesProducto',['producto'=>$producto,'producto_empaques'=>$producto_empaques,'unidad_medidas'=>$unidad_medidas]);
    }

    public function consultarClientes() //datos separados por negocio
    {
        $usuario = Auth::user();
        $Id = $usuario['Id_Negocio'];
        $clientes = Cliente::whereHas('usuario', function ($query) use ($Id) {
          $query->where('Id_Negocio', 'like', $Id);
        })->get();
        return view('perfil_consultor.listadoClientes',['clientes'=>$clientes]);
    }

    public function consultarCategorias() //datos compartidos por todos los negocios
    {
        $categorias=Categoria::all();
        return view('perfil_consultor.listadoCategorias',['categorias'=>$categorias]);
    }

    public function consultarAlmacenes() //datos compartidos por todos los negocios
    {
        $usuario = Auth::user();
        //$almacenes = Almacen::with(['usuario'])->where('Id_Negocio',$usuario['Id_Negocio'])->get();
        //$almacenes = Almacen::with(['usuario'])->get();
        $Id = $usuario['Id_Negocio'];
        $almacenes = Almacen::whereHas('usuario', function ($query) use ($Id) {
          $query->where('Id_Negocio', 'like', $Id);
        })->get();
        return view('perfil_consultor.listadoAlmacenes',['almacenes'=>$almacenes]);
    }

    public function consultarPresentacionProductos($id)
    {
        $unidad_medidas=Unidad_Medida::all();
        $producto = Producto::where('ID',$id)->first();
        $productos = Producto_Empaque::all();
        $producto_empaques = $productos->where('ID_Producto',$id);
        return view('perfil_consultor.listadoPresentacionesProducto',['producto'=>$producto,'producto_empaques'=>$producto_empaques,'unidad_medidas'=>$unidad_medidas]);
    }

}
