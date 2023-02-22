<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\negocio;
class CheckIncompleteConfigurations
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
        $negocio = negocio::find(auth()->user()->negocio->id);
        $config_faltantes = 0;

        if (count($negocio->categorias) <= 0) {
            $config_faltantes+=1;
        }

        if (count($negocio->productos) <= 0) {
            $config_faltantes+=1;
        }

        if (count($negocio->impresoras) <= 0) {
            $config_faltantes+=1;
        }
        if($negocio->config->host_server_printer=="" or $negocio->config->port_server_printer=="" ){
            $config_faltantes+=1;
            
        }

        if ($config_faltantes > 0) {
            return redirect()->route('configuraciones');
        }

        return $next($request);
    }
}
