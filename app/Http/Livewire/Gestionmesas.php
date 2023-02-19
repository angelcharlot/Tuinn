<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\area;
use App\Models\mesa;

class Gestionmesas extends Component
{

    public $areas;
    public $bn_mesa=0;
    public $bn_modal_area=0;
    public $bn_modal_mesas=0;
    public $area_selec;
    public $name_area;
    public $name_mesa; 

    public function mount(){
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
        foreach ($this->areas as $key => $mesas) {
           //  dd($mesas);
        }
       
      
    }
    public function render()
    {
        return view('livewire.gestionmesas');
    }
    public function seleccionar(area $area){
        $this->area_selec=$area;
        $this->bn_mesa=1;
    }
    public function agregar_area(){
        
        $area=new area();
        $area->name=$this->name_area;
        $area->negocio_id=auth()->user()->negocio->id;
        $area->save();
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
        $this->bn_modal_area=0;
    }
    public function agregar_mesa($id){
        
        $mesa=new mesa();
        $mesa->name="mesa ".$this->name_mesa;
        $mesa->area_id=$id;
        $mesa->nro=$this->name_mesa;
        $mesa->save();
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
        $this->area_selec=area::find($id);
        $this->bn_modal_mesas=0;
    }
}
