<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PerfilFormRequest;
use App\Perfil;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $perfiles=Perfil::all();
        return view('perfiles.index',['perfiles'=>$perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('perfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(PerfilFormRequest $request)
     {
         //
         $date = new \DateTime();
         $perfil = new Perfil;
         $perfil->FechaCreacion=$date->format('Y-m-d H:i:s');//date_default_timezone_get()
         $perfil->FechaModificacion=$date->format('Y-m-d H:i:s');
         $perfil->ID_Usuario=1;
         $perfil->Nombre =$request->get('Nombre');
         $perfil->Descripcion =$request->get('Descripcion');

         $perfil->save();
         return redirect('/perfiles')->with('mensaje','Se inserto correctamente!');
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
         $perfil = Perfil::findOrFail($id);
         return view('perfiles.edit',compact('perfil'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(PerfilFormRequest $request, $id)
     {
         //
         $date = new \DateTime();
         $perfil= Perfil::findOrFail($id);
         $perfil->FechaModificacion=$date->format('Y-m-d H:i:s');
         $perfil->ID_Usuario=1;
         $perfil->Nombre =$request->get('Nombre');
         $perfil->Descripcion =$request->get('Descripcion');
         $perfil->save();
         return redirect('/perfiles')->with('mensaje','Se modificó correctamente!');
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
         $perfil=Perfil::findOrFail($id);
         $perfil->delete();
         return redirect('/perfiles')->with('mensaje','El perfil con id : '.$id.' , se elimino correctamente!!');
     }
}
