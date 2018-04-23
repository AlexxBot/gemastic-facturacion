<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            if ($usuario['Id_Perfil'] != 1) {
                return redirect('home');//login
                //echo 'error';
                /*if($usuario['Id_Perfil'] == 2){
                    return redirect('layout.layoutVendedor');
                }

                return redirect('layout.layoutConsultor');*/
            }

            return $next($request);
        }
        return redirect('login');
    }
}
