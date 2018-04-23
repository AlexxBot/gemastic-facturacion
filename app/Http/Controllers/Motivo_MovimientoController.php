<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Motivo_MovimientoFormRequest;

use App\Motivo_Movimiento;

class Motivo_MovimientoController extends Controller
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
        $motivo_movimientos = Motivo_Movimiento::all();
        return view('motivo_movimientos.index',['motivo_movimientos'=>$motivo_movimientos]);
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
        $motivo_movimiento = new Motivo_Movimiento;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $motivo_movimiento->FechaCreacion = $fechaActual;
        $motivo_movimiento->FechaModificacion = $fechaActual;
        $motivo_movimiento->ID_Usuario = Auth::id();
        $motivo_movimiento->Nombre = $request->get('Nombre');
        $motivo_movimiento->Descripcion = $request->get('Descripcion');
        $motivo_movimiento->Estado = 1;
        $motivo_movimiento->save();
        return redirect('/motivo_movimientos')->with('mensaje','Se inserto correctamente!!');
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
        $motivo_movimiento = Motivo_Movimiento::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $motivo_movimiento->FechaModificacion = $fechaActual;
        $motivo_movimiento->ID_Usuario = Auth::id();
        $motivo_movimiento->Nombre = $request->get('Nombre');
        $motivo_movimiento->Descripcion = $request->get('Descripcion');
        $motivo_movimiento->save();
        return redirect('/motivo_movimientos')->with('mensaje','Se modifico correctamente!!');
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
        $motivo_movimiento = Motivo_Movimiento::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $motivo_movimiento->FechaModificacion = $fechaActual;
        $motivo_movimiento->ID_Usuario = Auth::id();
        $est = 1;
        if($estado == 1){
          $est = 0;
        }
        $motivo_movimiento->Estado = $est;
        $res = $motivo_movimiento->save();
        //return redirect('/motivo_movimientos')->with('mensaje','El estado se modifico correctamente!!');
        if($res){
          return response()->json(['Estado' => $est]);
        }
    }
}
