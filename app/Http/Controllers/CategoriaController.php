<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CategoriaFormRequest;

use App\Categoria;

use App\User;

class CategoriaController extends Controller
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
        $categorias=Categoria::all();
        return view('categorias.index',['categorias'=>$categorias]);
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
        $categoria = new Categoria;
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $categoria->FechaCreacion = $fechaActual;
        $categoria->FechaModificacion = $fechaActual;
        $categoria->ID_Usuario=Auth::id();

        $categoria->CodigoSunat =$request->get('CodigoSunat');
        $categoria->Nombre=$request->get('Nombre');
        $categoria->Descripcion =$request->get('Descripcion');

        $categoria->save();
        return redirect('/categorias')->with('mensaje','Se inserto correctamente!');
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
        $categoria = Categoria::findOrFail($id);
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');

        $categoria->FechaModificacion = $fechaActual;
        $categoria->ID_Usuario=Auth::id();

        $categoria->CodigoSunat =$request->get('CodigoSunat');
        $categoria->Nombre=$request->get('Nombre');
        $categoria->Descripcion =$request->get('Descripcion');


        $categoria->save();
        return redirect('/categorias')->with('mensaje','Se modificó correctamente!');
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
