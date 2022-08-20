<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;
use App\Models\categorias as category;
class Categorias extends Component
{

    public $categorias;

    public function render()
    {
        $this->categorias=category::whereNull('id_categoria')->get();

        return view('livewire.categorias.categorias');
    }
    public function buscar($id){

        $this->categorias=category::where('id_categoria','=',$id)->get();

    }
}
