<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\negocio;
use App\Models\categorias;

class Panel extends Component
{
    public $nro_productos;
    public $negocio;
    public $categorias;
    

    public function mount(){
        $this->negocio=negocio::find(auth()->user()->negocio->id);
        $this->nro_productos=$this->negocio->productos->count();
        $this->categorias=categorias::where('id_negocio',"=",$this->negocio->id)->get();
        $this->productos_false=$this->negocio->productos->where('activo','=','0')->count();
        //dd($this->productos_false);
        
    }
    public function render()
    {
        return view('livewire.panel');
    }
}
