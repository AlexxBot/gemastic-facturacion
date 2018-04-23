<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Unidad_MedidaFormRequest;

use App\Unidad_Medida;

use App\User;

class Unidad_MedidaController extends Controller
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
        return view('unidad_medidas.index',['unidad_medidas'=>$unidad_medidas]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usuarioActual = Auth::user();
        $unidad_medida = new Unidad_Medida;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $unidad_medida->FechaCreacion = $fechaActual;
        $unidad_medida->FechaModificacion = $fechaActual;
        $unidad_medida->ID_Usuario=Auth::id();;

        $unidad_medida->CodigoPeru =$request->get('CodigoPeru');
        $unidad_medida->Nombre=$request->get('Nombre');
        $unidad_medida->CodigoSunat =$request->get('CodigoSunat');
        $unidad_medida->NombreSunat=$request->get('NombreSunat');

        $unidad_medida->save();
        return redirect('/unidad_medidas')->with('mensaje','Se inserto correctamente!');
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
        $unidad_medida = Unidad_Medida::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $unidad_medida->FechaModificacion = $fechaActual;
        $unidad_medida->ID_Usuario=Auth::id();

        $unidad_medida->CodigoPeru =$request->get('CodigoPeru');
        $unidad_medida->Nombre=$request->get('Nombre');
        $unidad_medida->CodigoSunat =$request->get('CodigoSunat');
        $unidad_medida->NombreSunat=$request->get('NombreSunat');


        $unidad_medida->save();
        return redirect('/unidad_medidas')->with('mensaje','Se modificó correctamente!');
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
