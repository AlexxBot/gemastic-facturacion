<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $usuario = Auth::user();
        if($usuario['Estado'] == 1){
          if($usuario['Id_Perfil'] == 2){
              return view('layout.layoutVendedor');
          }
          if($usuario['Id_Perfil'] == 3){
              return view('layout.layoutConsultor');
          }
          return view('layout.layout');
        }
        else{
          Auth::logout();
          return view('auth.login');
        }
    }
}
