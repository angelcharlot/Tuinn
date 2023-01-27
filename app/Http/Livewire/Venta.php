<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\productos;
use App\Models\area;
use App\Models\documento;
use App\Models\detalle;
use App\Models\presentacion;
use App\Models\mesa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Venta extends Component
{
    //vistas
    public $vista_principal=1;
    public $presentaciones_view=0;
    public $mesas_view=1;
    //documentos
    public $all_documentos;
    //variables
    public $productos;
    public $area;
    public $comanda;
    public $array_comanda=[];
    public $documento;
   
    public $area_seleccionada;
    public $mesa_seleccionada;

    public $presentaciones;
    

    public function mount(){
        $this->productos=productos::where('id_negocio','=',auth()->user()->negocio->id)->get();
        $this->comanda=new Collection();
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
        $this->all_documentos=documento::where("negocio_id","=",auth()->user()->negocio->id)->where('estado','=','activa')->get();
        $this->presentacion=new presentacion();

        //dd($this->documento->productos[0]->pivot->cantidad);
    }

    public function render()
    {
        return view('livewire.venta');
    }
    public function agregar(productos $producto,presentacion $presentacion){

        
        if($this->documento->detalles->where('producto_id','=',$producto->id)->where('tipo_presentacion','=',$presentacion->name)->first()){
           //agregar un producto que no este en los detalles con la misma presentacion. 
            $update_detalle=$this->documento->detalles->where('producto_id','=',$producto->id)->where('tipo_presentacion','=',$presentacion->name)->first();
            $update_detalle->cantidad+=1;
            $update_detalle->save();
            $bn=0;
            for ($i=0; $i < count($this->array_comanda) ; $i++) { 
            if(substr($producto->name,0,15)."(".$presentacion->name.")"==$this->array_comanda[$i]['name']){
                $this->array_comanda[$i]['cantidad']+=1;
                $bn=1;
            }
            }
            if($bn==0){
                $this->array_comanda[]=[
                    
                    'cantidad'=>1,
                    'name'=>substr($producto->name,0,15)."(".$presentacion->name.")",
                    "impresora"=>$producto->impresora->id
                ];
            }
           
        }else{
            //agregar un producto nuevo
        $new_detalle=new detalle();
        $new_detalle->producto_id=$producto->id;
        $new_detalle->cantidad=1;
        $new_detalle->name=$producto->name;
        $new_detalle->tipo_presentacion=$presentacion->name;
        $new_detalle->precio_venta=$presentacion->precio_venta;
        $new_detalle->documento_id=$this->documento->id;
        $new_detalle->save();
        $this->array_comanda[]=[
            'cantidad'=>1,
            'name'=>substr($producto->name,0,15)."(".$presentacion->name.")",
            "impresora"=>$producto->impresora->id
        ];
        


            }
            $this->documento->total+=$presentacion->precio_venta;
            $base=($this->documento->total) / (1.10);
            
            $this->documento->sub_total=$base;
            $this->documento->save();
        //update la mesa 
        $this->mesa_seleccionada=mesa::find($this->documento->mesa_id);

           // dd($producto);
      
            
            $this->presentaciones_view=0;
            $this->presentaciones=new presentacion();
        
    }
    public function mostrar_presentacion(productos $producto){


        if($producto->presentaciones->count()>1){
            $this->presentaciones=$producto->presentaciones;
            $this->presentaciones_view=1;
        }else{
            $this->agregar($producto,$producto->presentaciones->first());
        }
        

    }
    public function comandar(){

       //dd($this->documento->negocio->impresoras);
      
      $aray_comanda_impre=[]; 
       
      foreach ($this->documento->negocio->impresoras as $key_im => $impresora) {
        
        foreach ($this->array_comanda as $key_item => $item) {
           if ($item['impresora']==$impresora->id) {
            $aray_comanda_impre[$key_im][]=$item;
            
           }

        }

      }

      $aray_comanda_impre=array_values($aray_comanda_impre);

      //dd($aray_comanda_impre);
     
      

      foreach ($this->documento->negocio->impresoras as $key_im => $impresora) {
        
        if (isset($aray_comanda_impre[$key_im])) {
            $this->envio_a_empre_comanda($aray_comanda_impre[$key_im],$impresora->interface,$this->mesa_seleccionada->nro,auth()->user()->id,$this->mesa_seleccionada->area->name);
        }
        


      }

      $this->array_comanda=[];
      $this->mesas_view=1;
      $this->vista_principal=1;
      $this->mesa_seleccionada="";
      $this->area="";
      $this->all_documentos=documento::where("negocio_id","=",auth()->user()->negocio->id)->where('estado','=','activa')->get();
      $this->documento=0;



    }
    public function selecionar_area(area $area){
        $this->area_seleccionada=$area;
        $this->vista_principal=2;
    }
    public function volver_areas(){
        $this->area_seleccionada="";
        $this->vista_principal=1;
    }
    public function mostrar_comanda(mesa $mesa){

        $this->mesa_seleccionada=$mesa;
        
        if (!$this->mesa_seleccionada->documento->where('estado', '=', 'activa')->first()) {

            $this->documento=new documento();
            $this->documento->estado='activa';
            $this->documento->negocio_id=auth()->user()->negocio->id;
            $this->documento->nro_documento="-----";
            
            $this->documento->mesa_id=$mesa->id;
            $this->documento->tipo="comanda";
            $this->documento->sub_total=0;
            $this->documento->total=0;
            $this->documento->save();
            $this->mesa_seleccionada->refresh();
        }
        else{
            $this->documento=$this->mesa_seleccionada->documento->where('estado', '=', 'activa')->first();
        }
        $this->vista_principal=3;
        $this->mesas_view=2;
        
    }
    public function disminuir(detalle $detalle){


        if ($detalle->cantidad==1) {
       
                $detalle->delete();
            }else{
                $detalle->cantidad-=1;
            $detalle->save();
            }
      
            $bn=0;

            for ($i=0; $i < count($this->array_comanda) ; $i++) { 
            if(substr($detalle->producto->name,0,15)."(".substr($detalle->tipo_presentacion,0,3).")"==$this->array_comanda[$i]['name']){
                $this->array_comanda[$i]['cantidad']-=1;
                if ($this->array_comanda[$i]['cantidad']==0) {
                   unset($this->array_comanda[$i]);
                }
                $bn=1;
            }
            }
            if($bn==0){
                $this->array_comanda[]=[
                    
                    'cantidad'=>-1,
                    'name'=>substr($detalle->producto->name,0,15)."(".substr($detalle->tipo_presentacion,0,3).")",
                    "impresora"=>$detalle->producto->impresora->id,
                ];
            }
            
            $this->documento->total-=$detalle->precio_venta;
            //dd($detalle->documento->total,$detalle->precio_venta);
            $base=($this->documento->total) / (1.10);
            $this->documento->sub_total=$base;
            $this->documento->save();
           
           

        $this->mesa_seleccionada=mesa::find($detalle->documento->mesa_id);
       
    }
    public function imprimir_tiket(documento $documento){


       

        $negocio=$documento->negocio;
        // dd($negocio->documentos->where('tipo','=','factura'));
        $usu=auth()->user()->id;
        $mesa=$documento->mesa->nro;
        $area=$documento->mesa->area->name;
        if ($documento->tipo!="factura") {
            $numero_de_doc=$documento->created_at->format('Y')."-".str_pad(($negocio->documentos->where('tipo','=','factura')->count())+1, 4, "0", STR_PAD_LEFT);
            $documento->nro_documento=$numero_de_doc;
            $documento->tipo="factura";
        
        }
            
        
        
        $documento->save();
        $negocio->documentos->fresh();
        $array_detalle=[];
       
        foreach ($documento->detalles as $key => $detalle) {
            $retVal = ($detalle->cantidad>1) ? $detalle->precio_venta : "" ;
           //dd($retVal);
            $array_detalle[]=[
                'cantidad'=>$detalle->cantidad,
                'name'=> (substr($detalle->name,0,15)."-".substr(($detalle->tipo_presentacion),0,10)." ".$retVal),
                'precio'=>$detalle->precio_venta,
                'total'=>($detalle->precio_venta*$detalle->cantidad)
              
            ];


        }
       // dd($array_detalle);
        $name_n=urlencode($negocio->name);
      
        $direccion=urlencode($negocio->direccion);
        $nif=$negocio->nif;
     
        $this->envio_a_empre_tiket($array_detalle,$negocio->impresoras->first()->interface,$mesa,$usu,$area,$name_n,$direccion,$nif,$documento->nro_documento);

        

        
    }
    public function envio_a_empre_comanda($data,$interface,$mesa,$usu,$area){




        $encodedData= json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($encodedData);
        
      
           $cliente = curl_init();
          curl_setopt($cliente, CURLOPT_URL, "http://185.141.222.250:8080/comanda/?interface=".$interface."&mesa=".$mesa."&usu=".$usu."&area=".$area);
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
    public function envio_a_empre_tiket($data,$interface,$mesa,$usu,$area,$name_n,$direccion,$nif,$serie){


        
        
        $encodedData= json_encode($data);
        
        

        $cliente = curl_init();
          curl_setopt($cliente, CURLOPT_URL, "http://185.141.222.250:8080/?interface=".$interface."&mesa=".$mesa."&usu=".$usu."&area=".$area."&name_n=".$name_n."&direc=".$direccion."&nif=".$nif."&serie=".$serie);
          
          curl_setopt($cliente, CURLOPT_HEADER, 0);
          curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($cliente, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($cliente, CURLOPT_HTTPHEADER, array(
          'Content-Type:application/json'
          ));
          curl_setopt($cliente, CURLOPT_POST, true);
          curl_setopt($cliente, CURLOPT_POSTFIELDS, $encodedData);
            $respuesta=curl_exec($cliente);
          //dd($respuesta);
          curl_close($cliente); 
  
         


    }

}
