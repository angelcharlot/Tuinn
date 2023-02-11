<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\area;
use App\Models\mesa;
use App\Models\detalle;
use App\Models\documento;
use App\Models\negocio;
use App\Models\productos;

class apiuser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(request $request)
    {
        $respuesta=[];

        $pass=json_decode($request->pass);
    
        $usuario=User::where('email','=',$request->email)->first();
        $negocio=negocio::find($usuario->id_negocio);
        $negocio->img=asset($negocio->img);
        $negocio->img_qr=asset("storage/qr/")."/".$negocio->id.".png";
        $areas=area::where("negocio_id","=",$negocio->id)->get();
        foreach ($areas as  $area) {
            
            foreach ($area->mesas as  $mesa) {
                if ($mesa->documento->where("estado","=","activa")->first()) {
                    $mesa->doc_activo=1;
                    $mesa->id_doc_activo=$mesa->documento->where("estado","=","activa")->first()->id;
                    $mesa->total_doc=$mesa->documento->where("estado","=","activa")->first()->total;

                }else{
                    $mesa->doc_activo=0;
                }
                  
            }
           
        }

      


        $productos=productos::where("id_negocio","=",$negocio->id)->get() ;
        foreach ($productos as $key => $value) {
            $value->presentaciones;
        }
        
  
        if ($usuario) {
            if(Hash::check($pass,$usuario->password)){
                
                $respuesta['usuario']=$usuario;
                $respuesta["negocio"]=$negocio;
                $respuesta["productos"]=$productos;
                $respuesta["areas"]=$areas;
                return json_encode($respuesta);
            }
            
        }
        
    }
    public function mesas(request $request){
                //dd(json_decode($request->id));

        $usuario=User::find(json_decode($request->id));
        $negocio=$usuario->negocio;
        $negocio->areas;
        $negocio->img=asset($negocio->img);
        $negocio->img_qr=asset("storage/qr/")."/".$negocio->id.".png";
        //dd($negocio->img_qr);
        foreach ($negocio->areas as $key => $area) {
            $area->mesas;
          
        }
    
        return $negocio->toJson();
    
    }
    public function comanda(request $request){



        $mesa=mesa::find($request->id_mesa);
        $id_negocio=$mesa->area->negocio->id;

       
        
        if(!$mesa->documento->where('estado', '=', 'activa')->first()){
            $documento=new documento();
            $documento->estado='activa';
            $documento->negocio_id=$id_negocio;
            $documento->nro_documento="-----";
            
            $documento->mesa_id=$mesa->id;
            $documento->tipo="comanda";
            $documento->sub_total=0;
            $documento->total=0;
           // $documento->save();
        }else{
            $documento=$mesa->documento->where('estado', '=', 'activa')->first();
        }

        $documento->negocio->productos;
        foreach ($documento->negocio->productos as $key => $value) {
            
            $value->img=asset($value->img);

        }

       

        return $documento->toJson();

    }
    public function areas(request $request){

            $areas=area::where('negocio_id','=',$request->id)->get();
            foreach ($areas as  $area) {
            
                foreach ($area->mesas as  $mesa) {
                    if ($mesa->documento->where("estado","=","activa")->first()) {
                        $mesa->doc_activo=1;
                        $mesa->id_doc_activo=$mesa->documento->where("estado","=","activa")->first()->id;
                        $mesa->total_doc=$mesa->documento->where("estado","=","activa")->first()->total;
                    }else{
                        $mesa->doc_activo=0;
                    }
                      
                }
               
            }
            return $areas->toJson();
    }
    public function detalle(Request $request){

        $mesa=mesa::find($request->id_mesa);
        $documento=$mesa->documento->where('estado', '=', 'activa')->first();
        $documento->detalles;
        $documento->mesa;
        

        return $documento->toJson();


    }
    public function comandar(request $request){

        
        //recuperer datos 
        $area=area::find($request->id_area);
        $negocio=negocio::find($area->negocio_id);
        $mesa=mesa::find($request->id_mesa);
        $user=User::find($request->user_id);
        
        $coment=urlencode($request->comentario);
        $array=$request->json()->all();

        if (!$mesa->documento->where('estado', '=', 'activa')->first()) {
                    
            $documento=new documento();
            $documento->estado='activa';
            $documento->negocio_id=$negocio->id;
            $documento->nro_documento="-----";
            
            $documento->mesa_id=$mesa->id;
            $documento->tipo="comanda";
            $documento->sub_total=0;
            $documento->total=0;
            $documento->cam1=$request->nro_comensales;
            $documento->save();

                }else{
                    $documento=$mesa->documento->where('estado', '=', 'activa')->first();
                }

            for ($i=0; $i <count($array) ; $i++) { 
                
                $new_detalle=new detalle();
                $new_detalle->producto_id=$array[$i]["producto_id"];
                $new_detalle->cantidad=$array[$i]["cantidad"];
                $new_detalle->name=$array[$i]["name"];
                $new_detalle->tipo_presentacion=$array[$i]["tipo"];
                $new_detalle->precio_venta=$array[$i]["precio"];
                $new_detalle->documento_id=$documento->id;
                $documento->total+=($array[$i]["cantidad"]*$array[$i]["precio"]);
                $documento->save();
                $new_detalle->save();

            }


        //datos del json recibido
       
        //declaracion de array para divivir comanda en las impresoras correspondientes
        $aray_comanda_impre=[]; 
        //divicion de comandas por impresra
       foreach ($negocio->impresoras as $key_im => $impresora) {
        foreach ($array as $key_item => $item) {

            if ($item['impresora']==$impresora->id) {
               
            $item["name"]= substr($item["name"],0,25 )."(".$item["tipo"].")";
             $aray_comanda_impre[$key_im][]=$item;
            }
 
         }
 
       }
       $aray_comanda_impre=array_values($aray_comanda_impre);
       
       
       //envio de data a imprimir
       foreach ($negocio->impresoras as $key_im => $impresora) {
         
         if (isset($aray_comanda_impre[$key_im])) {
             $this->envio_a_empre_comanda($aray_comanda_impre[$key_im],$impresora->interface,$mesa->nro,$user->id,$area->name,$coment,$documento->cam1);
         }
         
       }

       return json_encode($aray_comanda_impre);
 
  
 
    }
   
    public function envio_a_empre_comanda($data,$interface,$mesa,$usu,$area,$coment,$nr_comensales){




        $encodedData= json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($encodedData);
        
      
           $cliente = curl_init();
          curl_setopt($cliente, CURLOPT_URL, "http://185.141.222.250:8080/comanda/?interface=".$interface."&mesa=".$mesa."&usu=".$usu."&area=".$area."&coment=".$coment."&nro_comensales=".$nr_comensales);
          curl_setopt($cliente, CURLOPT_HEADER, 0);
          curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($cliente, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($cliente, CURLOPT_HTTPHEADER, array(
          'Content-Type:application/json'
          ));
          curl_setopt($cliente, CURLOPT_POST, true);
          curl_setopt($cliente, CURLOPT_POSTFIELDS, $encodedData);
            $respuesta=curl_exec($cliente);
          print_r($respuesta);
          curl_close($cliente); 
  
         




    }
 
    public function prueba(request $request){
    }
}
