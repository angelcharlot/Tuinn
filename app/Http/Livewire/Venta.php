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
    public $productos;
    public $area;
    public $comanda;
    public $array_comanda=[];
    public $documento;
    public $vista_principal=1;
    public $area_seleccionada;
    public $mesa_seleccionada;
    public $presentaciones_view=0;
    public $presentaciones;
    

    public function mount(){
        $this->productos=productos::where('id_negocio','=',auth()->user()->negocio->id)->get();
        $this->comanda=new Collection();
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
    
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
            if($producto->name."(".$presentacion->name.")"==$this->array_comanda[$i]['name']){
                $this->array_comanda[$i]['cantidad']+=1;
                $bn=1;
            }
            }
            if($bn==0){
                $this->array_comanda[]=[

                    'cantidad'=>1,
                    'name'=>$producto->name."(".$presentacion->name.")"
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
            'area'=>$this->mesa_seleccionada->area->name,
            'mesa'=>$this->mesa_seleccionada->nro,
            'cantidad'=>1,
            'name'=>$producto->name."(".$presentacion->name.")"
        ];
        


            }
            $this->documento->total+=$presentacion->precio_venta;
            $base=($this->documento->total) / (1.10);
            
            $this->documento->sub_total=$base;
            $this->documento->save();
        //update la mesa 
        $this->mesa_seleccionada=mesa::find($this->documento->mesa_id);




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

       
        

       $encodedData= json_encode($this->array_comanda);
      // dd($encodedData);
      
    
         $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, "http://185.141.222.250:8080/comanda/?mesa=".$this->mesa_seleccionada->nro);
        curl_setopt($cliente, CURLOPT_HEADER, 0);
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cliente, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($cliente, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json'
        ));
        curl_setopt($cliente, CURLOPT_POST, true);
        curl_setopt($cliente, CURLOPT_POSTFIELDS, $encodedData);
        $respuesta=curl_exec($cliente);
        //print_r($respuesta);
        curl_close($cliente); 

        $this->array_comanda=[];

        $this->vista_principal=1;
        $this->mesa_seleccionada="";
        $this->area="";


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
            $this->documento->nro_documento=1000;
            $this->documento->mesa_id=$mesa->id;
            $this->documento->tipo="comanda";
            $this->documento->sub_total=0;
            $this->documento->total=0;
            $this->documento->save();

        }
        else{
            $this->documento=$this->mesa_seleccionada->documento->where('estado', '=', 'activa')->first();
        }
        $this->vista_principal=3;

        
    }
    public function cobrar(){

        
    }

}
