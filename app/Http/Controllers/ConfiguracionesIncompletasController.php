<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\negocio;

class ConfiguracionesIncompletasController extends Controller
{
    public function index()
    {
        $negocio = negocio::find(auth()->user()->negocio->id);
      
        $config_fantantes=[];
        
        if(count($negocio->areas)<=0){
            $config_fantantes[]=
            [
                "mensaje"=>"No has registrado ninguna Area para recibir a tu clientela en tu negocio. ¡Registra tus areas ahora!",
                "url"=> route('areaymesa.index'),
            ];

        }
        foreach ($negocio->areas as $key => $area) {
           
            if (count($area->mesas)<=0) {
                $config_fantantes[]= [
                    "mensaje"=>"deves registrar las mesas correspondientes en cada area, no puedes tener areas sin mesas",
                    "url"=> route('areaymesa.index'),
                ];
            }

        }

        if(count($negocio->categorias)<=0){
            $config_fantantes[]=
            [
                "mensaje"=>"No has registrado ninguna categoría en tu negocio. ¡Registra tus categorías ahora!",
                "url"=> route('categorias.index'),
            ];

        }
        if(count($negocio->productos)<=0){
            $config_fantantes[]= [
                "mensaje"=>"No has registrado ningún producto en tu negocio. ¡Registra tus productos ahora!",
                "url"=> route('productos.index'),
            ];
            
        }
        if(count($negocio->impresoras)<=0){
            $config_fantantes[]= [
                "mensaje"=>"No has registrado ninguna impresora en tu negocio. ¡Registra tus impresoras ahora!",
                "url"=> route("impresoras.index"),
            ];
            
        }
        if($negocio->config->host_server_printer=="" or $negocio->config->port_server_printer=="" ){
            $config_fantantes[]= [
                "mensaje"=>"La configuración del servidor de impresión no está completa. ¡Completa la configuración ahora!",
                "url"=> route('profile.show2'),
            ];
            
        }
        if($negocio->img=="" ){
            $config_fantantes[]= [
                "mensaje"=>"carga una imagen o el logo de tu negocio",
                "url"=> route('profile.show2'),
            ];
            
        }
        if($negocio->name=="" ){
            $config_fantantes[]= [
                "mensaje"=>"registra el nombre de tu negocio",
                "url"=> route('profile.show2'),
            ];
            
        }
        if($negocio->telfono1=="" ){
            $config_fantantes[]= [
                "mensaje"=>"registra por lo menos un telefono de contacto",
                "url"=> route('profile.show2'),
            ];
            
        }

    






        $config_fantantes=collect( $config_fantantes);

        return view('configuraciones-incompletas', compact('config_fantantes'));
    }
}
