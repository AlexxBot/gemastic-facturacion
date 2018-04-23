<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UsuarioFormRequest;

use App\User;

use App\Perfil;

class UsuarioController extends Controller
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
        $usuarios = User::where('Id_Negocio',$usuario['Id_Negocio'])->get();
        $perfiles = Perfil::all();

        return view('usuarios.index',['usuarios'=>$usuarios, 'perfiles'=>$perfiles]);
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
        $usuarioActual = Auth::user();
        $usuario = new User;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $usuario->created_at = $fechaActual;
        $usuario->updated_at = $fechaActual;
        $usuario->ID_Usuario = Auth::id();
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->Estado = 1;
        $usuario->Id_Perfil = $request->get('Id_Perfil');
        $usuario->Id_Negocio = $usuarioActual['Id_Negocio'];
        $usuario->UrlImagen = $request->get('UrlImagen');
        $usuario->save();
        return redirect('/usuarios')->with('mensaje','Se inserto correctamente!!');
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
        $usuario = User::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $usuario->updated_at = $fechaActual;
        $usuario->ID_Usuario = Auth::id();
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        if($request->get('password') != null){
          $usuario->password = bcrypt($request->get('password'));
        }
        $usuario->Id_Perfil = $request->get('Id_Perfil');
        $usuario->UrlImagen = $request->get('UrlImagen');
        $usuario->save();
        return redirect('/usuarios')->with('mensaje','Se modifico correctamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

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
        $usuario = User::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $usuario->updated_at = $fechaActual;
        $usuario->ID_Usuario = Auth::id();
        $est = 1;
        if($estado == 1){
          $est = 0;
        }
        $usuario->Estado = $est;
        $res = $usuario->save();
        //return redirect('/usuarios')->with('mensaje','El estado se modifico correctamente!!');

        if($res){
          return response()->json(['Estado' => $est]);
        }
    }
}
