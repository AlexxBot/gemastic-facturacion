<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ImpuestoFormRequest;

use App\Impuesto;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos = Impuesto::all();
        return view('impuestos.index',['impuestos'=>$impuestos]);
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
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return array
     */
    public function recuperar_impuesto($id)
    {
        //
        //$impuesto = Impuesto::findOrFail($id);
        $impuesto = Impuesto::where('ID', $id)->first();
        return response()->json($impuesto);
        //echo json_encode($impuesto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $impuesto = new Impuesto;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $impuesto->FechaCreacion = $fechaActual;
        $impuesto->FechaModificacion = $fechaActual;
        $impuesto->ID_Usuario = 1; //pendiente
        $impuesto->ID = $request->get('ID');
        $impuesto->Nombre = $request->get('Nombre');
        $impuesto->Porcentaje = $request->get('Porcentaje');
        $impuesto->Fijo = $request->get('Fijo');
        $impuesto->save();
        return redirect('/impuestos')->with('mensaje','Se inserto correctamente!!');
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
        $impuesto = Impuesto::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $impuesto->FechaModificacion = $fechaActual;
        $impuesto->ID_Usuario = 1; //pendiente
        $impuesto->Nombre = $request->get('Nombre');
        $impuesto->Porcentaje = $request->get('Porcentaje');
        $impuesto->Fijo = $request->get('Fijo');
        $impuesto->save();
        return redirect('/impuestos')->with('mensaje','Se modifico correctamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $impuesto = Impuesto::findOrFail($id);
        $impuesto->delete();
        //return redirect('/negocios')->with('mensaje','El impuesto con id: '.$id.', se elimino correctamente!!');
        return response()->json(['success' => 'Record has been deleted successfully!']);
    }
}
