<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Producto_EmpaqueFormRequest;

use Illuminate\Support\Facades\Auth;
use App\Producto_Empaque;
use App\Producto;

use DB;

use App\User;


class Producto_EmpaqueController extends Controller
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
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request, $id)
    {
        //
        $date = new \DateTime();
        $producto_empaque = new Producto_Empaque;
        $producto_empaque->FechaCreacion=$date->format('Y-m-d H:i:s');//date_default_timezone_get()
        $producto_empaque->FechaModificacion=$date->format('Y-m-d H:i:s');
        $producto_empaque->ID_Usuario=1;

        $producto_empaque->ID_Producto="1";

        $producto_empaque->ID_UnidadMedida=$request->get('ID_UnidadMedida');
        $producto_empaque->Precio1=$request->get('Precio1');
        $producto_empaque->Precio2 =$request->get('Precio2');
        $producto_empaque->Precio3=$request->get('Precio3');
        $producto_empaque->Equivalencia =$request->get('Equivalencia');

        $producto_empaque->save();
        //return redirect('/producto_empaques')->with('mensaje','Se inserto correctamente!');

    }
    */
    public function nuevo(Producto_EmpaqueFormRequest $request,$id)
    {
        $usuarioActual = Auth::user();
        $producto = Producto::where('ID', $id)->where('ID_UnidadMedida', $request->get('ID_UnidadMedida'))->first();
        if(count($producto)==0)
        {

          $producto_empaques = Producto_Empaque::where('ID_Producto', $id)->where('ID_UnidadMedida', $request->get('ID_UnidadMedida'))->first();
          if(count($producto_empaques)==0)
          {

              $producto_empaque = new Producto_Empaque;

              date_default_timezone_set('America/Lima');
              $fechaActual = date('Y-m-d H:i:s');

              $producto_empaque->FechaCreacion = $fechaActual;
              $producto_empaque->FechaModificacion = $fechaActual;
              $producto_empaque->ID_Usuario=Auth::id();

              $producto_empaque->ID_Producto=$id;
              $producto_empaque->ID_UnidadMedida=$request->get('ID_UnidadMedida');

              $producto_empaque->Precio1=$request->get('Precio1');
              $producto_empaque->Precio2 =$request->get('Precio2');
              $producto_empaque->Precio3=$request->get('Precio3');
              $producto_empaque->Equivalencia =$request->get('Equivalencia');

              $producto_empaque->save();
              return redirect("/productos/$id")->with('mensaje','Se inserto correctamente!');
          }
          else
          {
            return redirect("/productos/$id")->with('mensaje','el producto empaque ya existe!');
          }
        }
        else
        {
          return redirect("/productos/$id")->with('mensaje','el producto ya existe!');
        }

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
        $parametros=explode('-', $id, 2);
        $id_Producto=(int)$parametros[0];
        $id_UnidadMedida=(int)$parametros[1];

        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $request->request->add(['FechaModificacion' => $fechaActual]);
        $request->request->add(['ID_Usuario' => Auth::id()]);

        $producto_empaque = Producto_Empaque::where('ID_Producto', $id_Producto)->where('ID_UnidadMedida', $id_UnidadMedida)->update($request->except(['_token','_method']));
        /*$producto_empaque = Producto_Empaque::where('ID_Producto', $id_Producto)->where('ID_UnidadMedida', $id_UnidadMedida)->first();

        if ( ! is_null($producto_empaque))
        {
          date_default_timezone_set('America/Lima');
          $fechaActual = date('Y-m-d H:i:s');

          //$producto_empaque->FechaModificacion = $fechaActual;
          $producto_empaque->ID_Usuario=Auth::id();


          $producto_empaque->Precio1=$request->get('Precio1');
          $producto_empaque->Precio2 =$request->get('Precio2');
          $producto_empaque->Precio3=$request->get('Precio3');
          $producto_empaque->Equivalencia =$request->get('Equivalencia');

          $producto_empaque->save();

        }*/
        return redirect("/productos/$id_Producto")->with('mensaje','mensaje','Se modificó correctamente!');
        //return redirect("/productos/$id_Producto")->with('mensaje','El Producto con id : '.$id_Producto.' y unidad de medida con id : '.$id_UnidadMedida.' , se elimino correctamente!!');
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
}
