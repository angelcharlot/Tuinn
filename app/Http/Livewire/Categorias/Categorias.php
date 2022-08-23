<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;
use App\Models\categorias as category;
class Categorias extends Component
{

public $categorias=NULL,$id_atras,$categoria_seleccionada;
public $updateMode=false;

    public function render()
    {
        if ($this->categorias==Null) {
            $this->categorias=category::whereNull('id_categoria')->get();
        }


        return view('livewire.categorias.categorias');
    }
    public function buscar(category $categoria = NULL, $bn ){


        if ($bn == 1 ) {
            $str = str_replace(' -> '.$categoria->name, "", $this->categoria_seleccionada);
            $this->categoria_seleccionada = $str;
        }else{

            $this->categoria_seleccionada.=' -> '.$categoria->name;
        }

        $this->id_atras=$categoria->id_categoria;

        $this->categorias=category::where('id_categoria','=',$categoria->id)->get();

    }



}
