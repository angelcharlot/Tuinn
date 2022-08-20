<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;
use App\Models\categorias as category;
class Categorias extends Component
{

public $categorias=NULL,$id_atras;


    public function render()
    {
        if ($this->categorias==Null) {
            $this->categorias=category::whereNull('id_categoria')->get();
        }


        return view('livewire.categorias.categorias');
    }
    public function buscar(category $categoria = NULL){

        $this->id_atras=$categoria->id_categoria;
        $this->categorias=category::where('id_categoria','=',$categoria->id)->get();

    }



}
