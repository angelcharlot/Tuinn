<?php

namespace App\Http\Livewire\Menu;

use App\Models\alargeno;
use App\Models\negocio;
use App\Models\categorias;
use App\Models\productos;
use App\Models\like;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Menu extends Component
{
    /* negocio */
    public $id_negocio;
    public $negocio;
    /*categorias y productos*/
    public $categorias;
    public $idioma = "es";
    public $open = false;
    public $producto_selecionado;
    public $productos;
    public $migas;
    public $ip;
    public $agente;
    public $alargenos;
    public $apartados;
    public  $modalVisible =true;


    public function mount(Request $request)
    {
        $this->producto_selecionado = new productos();
        $this->migas=array();
        $this->negocio = negocio::find($this->id_negocio);
        $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
        $this->productos = productos::where('id_negocio', '=', $this->negocio->id)->where('activo', '=',1)->get();
        $this->apartados=$this->productos->unique('descrip3');
       
        if(session('id_sessions')==null){

            session(['id_sessions' => uniqid()]);
       }
        
       $this->ip=$request->ip();
       //$this->agente=$request->userAgentip();
      
       $this->alargenos=alargeno::all();
      
    }


    public function render()
    {
       
       
        return view('livewire.menu.menu');
    }
    public function nav_categorias($id)
    {

        if ($id == 'principal') {
            $this->productos = productos::where('id_negocio', '=', $this->negocio->id)->get();
            $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
            $this->migas = array();

        } else {
            $offset=NULL;
            $categoria = categorias::find($id);
            $this->categorias = $this->categorias->where('id_categoria', '=', $id);
            for ($i=0; $i < count($this->migas) ; $i++) {
                if ($this->migas[$i]['name']==$categoria->name) {
                    $offset=$i;
                }
            }

            $this->migas=(array_slice($this->migas,0,$offset));

            $this->migas[] = ['name' => $categoria->name, 'id' => $categoria->id];
            $this->productos=$categoria->productos;
        }
    }

    public function likes($bn,$id_producto){

        $x=like::where('session','=',session('id_sessions'))->where('producto_id','=',$id_producto);
        if($x->count()==0){
            $like=new like();
            $like->ip=$this->ip;
            $like->agente="sadsas";
            $like->tipo=$bn;
            $like->producto_id=$id_producto;
            $like->session=session('id_sessions');
            $like->save();
            if ($bn==1) {
                $this->emit('votoguardado1');
            }else{
                $this->emit('votoguardado0');
            }
            
        }else{
            $this->emit('unsolovoto');
        }
        
    }
    public function producto($id)
    {
        
        $this->producto_selecionado = $this->productos->find($id);
       
        $this->open = true;
    }
    public function idioma(){

        
        

    }

}
