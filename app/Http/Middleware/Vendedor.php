<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Vendedor
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
            /*if ($usuario['Id_Perfil'] != 2) {
                if ($usuario['Id_Perfil'] == 1) {
                    return redirect('layout.layout');// Administrador
                }
                return redirect('layout.layoutConsultor');// Consultor
            }

            return $next($request);*/
            if($usuario['Id_Perfil'] == 1 || $usuario['Id_Perfil'] == 2) {
              return $next($request);
            }
            return redirect('home');
            /*return redirect('layout.layoutConsultor');*/
        }
        return redirect('login');
    }
}
