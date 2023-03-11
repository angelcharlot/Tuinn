<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;

class chekeo_de_caja
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if (Cookie::has('caja')) {
            // Si la cookie existe, continuar con la petición.

            return $next($request);
        } else {
            // Si la cookie no existe, hacer algo adicional, como redirigir o mostrar un mensaje de error.
            return redirect('/caja/error');
        }


       
    }
}
