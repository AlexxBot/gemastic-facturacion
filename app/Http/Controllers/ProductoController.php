<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\Auth;

use App\Producto;
use App\Unidad_Medida;
use App\Categoria;
use App\Fabricante;
use App\Producto_Empaque;

use Yajra\DataTables\Facades\DataTables;
use DB;

use App\User;


class ProductoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unidad_medidas=Unidad_Medida::all();
        $categorias=Categoria::all();
        $fabricantes=Fabricante::all();
        $productos=Producto::all();
        return view('productos.index',['productos'=>$productos,'unidad_medidas'=>$unidad_medidas,'categorias'=>$categorias,'fabricantes'=>$fabricantes]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function agregar_producto($id)
     {
       $claves = explode("-", $id);
       if(count($claves)==1)
       {
         //es un producto
         $producto=DB::table('productos')
         ->join('unidad_medidas','productos.ID_UnidadMedida','=','unidad_medidas.ID')
         ->select('productos.ID as ID','productos.Nombre as Nombre','productos.Stock as Stock','unidad_medidas.Nombre as UnidadMedida','productos.Precio1 as Precio1','productos.Precio2 as Precio2','productos.Precio3 as Precio3',DB::raw("1 as Equivalencia"))
         ->where('productos.ID', $id)
         ->first();
         //$producto= Producto::findOrFail($id);

         echo json_encode($producto);
       }
       else {
         //es un producto empque
         //$productos=Producto::select('productos.ID','productos.Nombre');
         $producto = Producto::select('productos.ID','productos.Nombre')
         ->join('producto_empaques','productos.ID','=','producto_empaques.ID_Producto')
         ->join('unidad_medidas','producto_empaques.ID_UnidadMedida','=','unidad_medidas.ID')
         ->where('producto_empaques.ID_Producto', $claves[0])->where('producto_empaques.ID_UnidadMedida', $claves[1])

         ->select(DB::raw("CONCAT(productos.ID,'-',producto_empaques.ID_UnidadMedida) as ID"),'productos.Nombre as Nombre',DB::raw('productos.Stock / producto_empaques.Equivalencia as Stock'),'unidad_medidas.Nombre as UnidadMedida','producto_empaques.Equivalencia','producto_empaques.*')
         //->join('productos','productos.ID','=','producto_empaques.ID_Producto')
         ->first();
         echo json_encode($producto);
       }

     }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function listar_productos()
     {
       //$respuesta= Producto::all();
       //echo json_encode($respuesta);
       $productos_generales=DB::table('productos')
       ->join('unidad_medidas','productos.ID_UnidadMedida','=','unidad_medidas.ID')
       ->select('productos.ID','productos.Nombre','productos.Stock','unidad_medidas.Nombre as UnidadMedida','productos.Precio1 as Precio1','productos.Precio2 as Precio2','productos.Precio3 as Precio3');
       $productos_empaques=DB::table('producto_empaques')
       ->join('unidad_medidas','producto_empaques.ID_UnidadMedida','=','unidad_medidas.ID')
       ->join('productos','productos.ID','=','producto_empaques.ID_Producto')
       ->select(DB::raw("CONCAT(producto_empaques.ID_Producto,'-',unidad_medidas.ID) as ID"),'productos.Nombre','productos.Stock','unidad_medidas.Nombre as UnidadMedida','producto_empaques.Precio1 as Precio1','producto_empaques.Precio2 as Precio2','producto_empaques.Precio3 as Precio3');
       $respuesta=$productos_generales->union($productos_empaques)->get();
       //return Datatables::of($respuesta)->make(true);
       //return response()->json($respuesta);
       echo json_encode($respuesta);
       //return $respuesta->toJson();*/
     }

     /*public function listado_productos()
     {
         //$productos = Producto::select('ID','ID_UnidadMedida','Descripcion','Stock','Precio1','Precio2','Precio3');

         //para precio 1
         $id="Precio2";

         if($id=="Precio2")
         {
           $productos_generales=DB::table('productos')
           ->join('unidad_medidas','productos.ID_UnidadMedida','=','unidad_medidas.ID')
           ->select('productos.ID','productos.Descripcion','productos.Stock','unidad_medidas.Nombre as UnidadMedida','productos.Precio2 as Precio');
           $productos_empaques=DB::table('producto_empaques')
           ->join('unidad_medidas','producto_empaques.ID_UnidadMedida','=','unidad_medidas.ID')
           ->join('productos','productos.ID','=','producto_empaques.ID_Producto')
           ->select('producto_empaques.ID_Producto as ID','productos.Descripcion','productos.Stock','unidad_medidas.Nombre as UnidadMedida','producto_empaques.Precio2 as Precio');
           $productos=$productos_generales->union($productos_empaques);
           return Datatables::of($productos)->make(true);
           //echo json_encode($productos);
         }
         else {
           $productos_generales=DB::table('productos')
           ->join('unidad_medidas','productos.ID_UnidadMedida','=','unidad_medidas.ID')
           ->select('productos.ID','productos.Descripcion','productos.Stock','unidad_medidas.Nombre as UnidadMedida','productos.Precio1 as Precio');
           $productos_empaques=DB::table('producto_empaques')
           ->join('unidad_medidas','producto_empaques.ID_UnidadMedida','=','unidad_medidas.ID')
           ->join('productos','productos.ID','=','producto_empaques.ID_Producto')
           ->select('producto_empaques.ID_Producto as ID','productos.Descripcion','productos.Stock','unidad_medidas.Nombre as UnidadMedida','producto_empaques.Precio1 as Precio');
           $productos=$productos_generales->union($productos_empaques);
           return Datatables::of($productos)->make(true);
           //echo json_encode($productos);
         }
     }*/


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usuarioActual = Auth::user();
        $producto = new Producto;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $producto->FechaCreacion = $fechaActual;
        $producto->FechaModificacion = $fechaActual;
        $producto->ID_Usuario=Auth::id();

        $producto->CodigoSunat =$request->get('CodigoSunat');
        $producto->ID_UnidadMedida=$request->get('ID_UnidadMedida');
        $producto->Nombre =$request->get('Nombre');
        $producto->Descripcion=$request->get('Descripcion');
        $producto->ID_Categoria =$request->get('ID_Categoria');
        $producto->ID_Fabricante=$request->get('ID_Fabricante');
        $producto->Stock =$request->get('Stock');
        $producto->Estado=1;
        $producto->StockMinimo =$request->get('StockMinimo');
        $producto->Precio1=$request->get('Precio1');
        $producto->Precio2 =$request->get('Precio2');
        $producto->Precio3=$request->get('Precio3');
        $producto->PrecioRefCompra =$request->get('PrecioRefCompra');

        $producto->save();
        return redirect('/productos')->with('mensaje','Se inserto correctamente!');
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $unidad_medidas=Unidad_Medida::all();
        $producto = Producto::where('ID',$id)->first();
        $productos = Producto_Empaque::all();
        $producto_empaques = $productos->where('ID_Producto',$id);
        return view('producto_empaques.show',['producto'=>$producto,'producto_empaques'=>$producto_empaques,'unidad_medidas'=>$unidad_medidas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $producto = Producto::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $producto->FechaModificacion = $fechaActual;
        $producto->ID_Usuario=Auth::id();

        $producto->CodigoSunat =$request->get('CodigoSunat');
        $producto->ID_UnidadMedida=$request->get('ID_UnidadMedida');
        $producto->Nombre =$request->get('Nombre');
        $producto->Descripcion=$request->get('Descripcion');
        $producto->ID_Categoria =$request->get('ID_Categoria');
        $producto->ID_Fabricante=$request->get('ID_Fabricante');
        $producto->Stock =$request->get('Stock');
        $producto->StockMinimo =$request->get('StockMinimo');
        $producto->Precio1=$request->get('Precio1');
        $producto->Precio2 =$request->get('Precio2');
        $producto->Precio3=$request->get('Precio3');
        $producto->PrecioRefCompra =$request->get('PrecioRefCompra');


        $producto->save();
        return redirect('/productos')->with('mensaje','Se modificó correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Modifica el estado del registro especificado.
     *
     * @param  int  $id
     * @param  int  $estado
     * @return \Illuminate\Http\Response
     */
    public function modificarEstado($id, $estado)
    {
        //$id = $datos['id'];
        //$estado = $datos['estado'];
        $producto = Producto::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $producto->FechaModificacion = $fechaActual;
        $producto->ID_Usuario = Auth::id();
        $est = 1;
        if($estado == 1){
          $est = 0;
        }
        $producto->Estado = $est;
        $res = $producto->save();

        if($res){
          return response()->json(['Estado' => $est]);
        }
    }
}
