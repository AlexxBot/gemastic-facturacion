<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FabricanteFormRequest;
use App\Fabricante;

use App\User;

class FabricanteController extends Controller
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
        $fabricantes=Fabricante::all();
        return view('fabricantes.index',['fabricantes'=>$fabricantes]);
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
        $fabricante = new Fabricante;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $fabricante->FechaCreacion = $fechaActual;
        $fabricante->FechaModificacion = $fechaActual;
        $fabricante->ID_Usuario=Auth::id();

        $fabricante->Ruc =$request->get('Ruc');
        $fabricante->RazonSocial=$request->get('RazonSocial');
        $fabricante->Direccion =$request->get('Direccion');
        $fabricante->Telefono=$request->get('Telefono');
        $fabricante->Web =$request->get('Web');

        $fabricante->save();
        return redirect('/fabricantes')->with('mensaje','Se inserto correctamente!');
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
    public function update(FabricanteFormRequest $request, $id)
    {
        //
        $fabricante = Fabricante::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $fabricante->FechaModificacion = $fechaActual;
        $fabricante->ID_Usuario=Auth::id();

        $fabricante->Ruc =$request->get('Ruc');
        $fabricante->RazonSocial=$request->get('RazonSocial');
        $fabricante->Direccion =$request->get('Direccion');
        $fabricante->Telefono=$request->get('Telefono');
        $fabricante->Web =$request->get('Web');


        $fabricante->save();
        return redirect('/fabricantes')->with('mensaje','Se modificó correctamente!');
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
