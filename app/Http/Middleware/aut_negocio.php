<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class aut_negocio
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
        if (Auth()->user()->hasRole('admin')) {
             return $next($request);
            
      }
       return abort(401, 'upsss!!!, no tienes acceso a esta pagina');
    }
}
