<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Consultor
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
        if(Auth::check()){
            $usuario = Auth::user();
            if($usuario['Id_Perfil'] != 3){

                return redirect('home');
            }

            return $next($request);
        }

        return redirect('login');
    }
}
