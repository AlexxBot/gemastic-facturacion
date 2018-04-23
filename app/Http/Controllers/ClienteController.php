<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ClienteFormRequest;

use App\Cliente;

use App\User;



class ClienteController extends Controller
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
        $Id = $usuario['Id_Negocio'];
        $clientes = Cliente::whereHas('usuario', function ($query) use ($Id) {
          $query->where('Id_Negocio', 'like', $Id);
        })->get();
        return view('clientes.index',['clientes'=>$clientes]);
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
         $cliente = new Cliente;
         date_default_timezone_set('America/Lima');
         $fechaActual = date('Y-m-d H:i:s');

         $cliente->FechaCreacion = $fechaActual;
         $cliente->FechaModificacion = $fechaActual;
         $cliente->ID_Usuario=Auth::id();

         $cliente->RazonSocial =$request->get('RazonSocial');
         $cliente->TipoDocumento=$request->get('TipoDocumento');
         $cliente->NroDocumento =$request->get('NroDocumento');
         $cliente->Denominacion=$request->get('Denominacion');
         $cliente->Direccion =$request->get('Direccion');
         $cliente->Telefono =$request->get('Telefono');
         $cliente->Email =$request->get('Email');
         $cliente->Estado=1;
         $cliente->Ubigeo =$request->get('Ubigeo');
         $cliente->save();
         return redirect('/clientes')->with('mensaje','Se inserto correctamente!');
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
         $cliente = Cliente::findOrFail($id);
         date_default_timezone_set('America/Lima');
         $fechaActual = date('Y-m-d H:i:s');

         $cliente->FechaModificacion = $fechaActual;
         $cliente->ID_Usuario=Auth::id();

         $cliente->RazonSocial =$request->get('RazonSocial');
         $cliente->TipoDocumento=$request->get('TipoDocumento');
         $cliente->NroDocumento =$request->get('NroDocumento');
         $cliente->Denominacion=$request->get('Denominacion');
         $cliente->Direccion =$request->get('Direccion');
         $cliente->Telefono =$request->get('Telefono');
         $cliente->Email =$request->get('Email');
         $cliente->Ubigeo =$request->get('Ubigeo');

         $cliente->save();
         return redirect('/clientes')->with('mensaje','Se modificó correctamente!');
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
         $cliente = Cliente::findOrFail($id);
         date_default_timezone_set('America/Lima');
         $fechaActual = date('Y-m-d H:i:s');

         $cliente->FechaModificacion = $fechaActual;
         $cliente->ID_Usuario = Auth::id();
         $est = 1;
         if($estado == 1){
           $est = 0;
         }
         $cliente->Estado = $est;
         $res = $cliente->save();

         if($res){
           return response()->json(['Estado' => $est]);
         }
     }
}
