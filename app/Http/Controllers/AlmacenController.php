<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AlmacenFormRequest;

use App\Almacen;

use App\User;

class AlmacenController extends Controller
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
        $usuario = Auth::user();
        //$almacenes = Almacen::with(['usuario'])->where('Id_Negocio',$usuario['Id_Negocio'])->get();
        //$almacenes = Almacen::with(['usuario'])->get();
        $Id = $usuario['Id_Negocio'];
        $almacenes = Almacen::whereHas('usuario', function ($query) use ($Id) {
          $query->where('Id_Negocio', 'like', $Id);
        })->get();
        return view('almacenes.index',['almacenes'=>$almacenes]);
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
        $negocio = new Almacen;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $negocio->FechaCreacion = $fechaActual;
        $negocio->FechaModificacion = $fechaActual;
        $negocio->ID_Usuario = Auth::id();
        $negocio->Nombre = $request->get('Nombre');
        $negocio->Direccion = $request->get('Direccion');
        $negocio->Telefono1 = $request->get('Telefono1');
        $negocio->Telefono2 = $request->get('Telefono2');
        $negocio->Estado = 1;
        $negocio->save();
        return redirect('/almacenes')->with('mensaje','Se inserto correctamente!!');
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
        $almacen = Almacen::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $almacen->FechaModificacion = $fechaActual;
        $almacen->ID_Usuario = Auth::id();
        $almacen->Nombre = $request->get('Nombre');
        $almacen->Direccion = $request->get('Direccion');
        $almacen->Telefono1 = $request->get('Telefono1');
        $almacen->Telefono2 = $request->get('Telefono2');
        $almacen->save();
        return redirect('/almacenes')->with('mensaje','Se modifico correctamente!!');
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
        $almacen = Almacen::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $almacen->FechaModificacion = $fechaActual;
        $almacen->ID_Usuario = Auth::id();
        $est = 1;
        if($estado == 1){
          $est = 0;
        }
        $almacen->Estado = $est;
        $res = $almacen->save();
        //return redirect('/almacenes')->with('mensaje','El estado se modifico correctamente!!');

        if($res){
          return response()->json(['Estado' => $est]);
        }
    }
}
