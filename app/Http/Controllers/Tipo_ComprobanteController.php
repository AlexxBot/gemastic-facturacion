<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Tipo_ComprobanteFormRequest;

use App\Tipo_Comprobante;

class Tipo_ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_comprobantes = Tipo_Comprobante::all();
        return view('tipo_comprobantes.index',['tipo_comprobantes'=>$tipo_comprobantes]);
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
        $tipo_comprobante = new Tipo_Comprobante;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $tipo_comprobante->FechaCreacion = $fechaActual;
        $tipo_comprobante->FechaModificacion = $fechaActual;
        $tipo_comprobante->ID_Usuario = 1; //pendiente
        $tipo_comprobante->ID = $request->get('ID');
        $tipo_comprobante->Abreviacion = $request->get('Abreviacion');
        $tipo_comprobante->Nombre = $request->get('Nombre');
        $tipo_comprobante->save();
        return redirect('/tipo_comprobantes')->with('mensaje','Se inserto correctamente!!');
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
        $tipo_comprobante = Tipo_Comprobante::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $tipo_comprobante->FechaModificacion = $fechaActual;
        $tipo_comprobante->ID_Usuario = 1; //pendiente
        $tipo_comprobante->Abreviacion = $request->get('Abreviacion');
        $tipo_comprobante->Nombre = $request->get('Nombre');
        $tipo_comprobante->save();
        return redirect('/tipo_comprobantes')->with('mensaje','Se modifico correctamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_comprobante = Tipo_Comprobante::findOrFail($id);
        $tipo_comprobante->delete();
        //return redirect('/negocios')->with('mensaje','El tipo_comprobante con id: '.$id.', se elimino correctamente!!');
        return response()->json(['success' => 'Record has been deleted successfully!']);
    }
}
