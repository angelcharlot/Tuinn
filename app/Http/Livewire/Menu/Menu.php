<?php

namespace App\Http\Livewire\Menu;

use App\Http\Livewire\Categorias\Categorias as CategoriasCategorias;
use App\Models\negocio;
use App\Models\categorias;
use App\Models\productos;
use Livewire\Component;

class Menu extends Component
{
    /* negocio */
    public $id_negocio, $negocio;
    /*categorias y productos*/
    public $categorias;
    public $categoria_padre;
    public $id_atras = null;



    public function mount()

    {
        $this->categoria_padre = new categorias();
        $this->negocio = negocio::find($this->id_negocio);
        $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
        $this->categoria_padre->name = "inicio";
        $this->categoria_padre->id_categoria = Null;
        $this->categoria_padre->productos = productos::where('id_negocio', '=', $this->id_negocio)->get();
    }
    public function render()
    {

        return view('livewire.menu.menu');
    }
    public function navegacion($id,$bn)
    {

        if ($bn == 0)
        {
            $this->categoria_padre = categorias::find($id);
            $this->categorias = categorias::where('id_categoria', '=', $id)->get();

            if (count($this->categorias) == 0) {
                $this->categorias = categorias::where('id', '=', $id)->get();
            }
        }else{

            if ($this->categoria_padre->id_categoria=='') {
            $this->categoria_padre = new categorias();
            $this->negocio = negocio::find($this->id_negocio);
            $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
            $this->categoria_padre->name = "inicio";
            $this->categoria_padre->id_categoria = Null;
            $this->categoria_padre->productos = productos::where('id_negocio', '=', $this->id_negocio)->get();
            }else{
                $this->categoria_padre = categorias::find($this->categoria_padre->id_categoria);
                $this->categorias = categorias::where('id_categoria', '=',$this->categoria_padre->id)->get();

            }

        }
    }
}
