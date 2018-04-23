<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\NegocioFormRequest;

use App\Negocio;

class NegocioController extends Controller
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
        $negocios = Negocio::where('ID',$usuario['Id_Negocio'])->get();
        return view('negocios.index',['negocios'=>$negocios]);
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
        $negocio = new Negocio;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $negocio->FechaCreacion = $fechaActual;
        $negocio->FechaModificacion = $fechaActual;
        $negocio->ID_Usuario = Auth::id();
        $negocio->Ruc = $request->get('Ruc');
        $negocio->RazonSocial = $request->get('RazonSocial');
        $negocio->Denominacion = $request->get('Denominacion');
        $negocio->Direccion = $request->get('Direccion');
        $negocio->Telefono1 = $request->get('Telefono1');
        $negocio->Telefono2 = $request->get('Telefono2');
        $negocio->Email = $request->get('Email');
        $negocio->Web = $request->get('Web');
        $negocio->RepLegal = $request->get('RepLegal');
        $negocio->Estado = 1;//$request->get('Estado');
        $negocio->Ubigeo = $request->get('Ubigeo');

        $negocio->save();
        return redirect('/negocios')->with('mensaje','Se inserto correctamente!!');

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
        $negocio = Negocio::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $negocio->FechaModificacion = $fechaActual;
        $negocio->ID_Usuario = Auth::id(); //pendiente
        $negocio->Ruc = $request->get('Ruc');
        $negocio->RazonSocial = $request->get('RazonSocial');
        $negocio->Denominacion = $request->get('Denominacion');
        $negocio->Direccion = $request->get('Direccion');
        $negocio->Telefono1 = $request->get('Telefono1');
        $negocio->Telefono2 = $request->get('Telefono2');
        $negocio->Email = $request->get('Email');
        $negocio->Web = $request->get('Web');
        $negocio->RepLegal = $request->get('RepLegal');
        $negocio->Estado = $request->get('Estado');
        $negocio->Ubigeo = $request->get('Ubigeo');

        $negocio->save();
        return redirect('/negocios')->with('mensaje','Se modifico correctamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negocio = Negocio::findOrFail($id);
        $res = $negocio->delete();
        //echo $res;
        //return redirect('/negocios')->with('mensaje','El negocio con id: '.$id.', se elimino correctamente!!');
        if($res){
          return response()->json(['success' => 'se elimino exitosamente!']);
        }

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
        $negocio = Negocio::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $negocio->FechaModificacion = $fechaActual;
        $negocio->ID_Usuario = Auth::id(); //pendiente
        $est = 1;
        if($estado == 1){
          $est = 0;
        }
        $negocio->Estado = $est;
        $negocio->save();
        return redirect('/negocios')->with('mensaje','El estado se modifico correctamente!!');
    }
}
