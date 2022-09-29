<?php

namespace App\Http\Livewire\Menu;

use App\Models\negocio;
use App\Models\categorias;
use App\Models\productos;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Menu extends Component
{
    /* negocio */
    public $id_negocio;
    public $negocio;
    /*categorias y productos*/
    public $categorias;
    public $categoria_padre;
    public $idioma="es";
    public $open=false;
    public $producto_selecionado;
    public $productos;
    public $sorf;



    public function mount()
    {
        $this->producto_selecionado=new productos();
        $this->negocio = negocio::find($this->id_negocio);
        $this->categorias = categorias::where('id_negocio','=', $this->negocio->id)->whereNull('id_categoria')->get();
        $this->categoria_padre = categorias::find(1);
        $this->categoria_padre->productos = productos::where('id_negocio','=',$this->negocio->id)->get();

    }


    public function render()
    {
        $this->productos= productos::where('id_negocio','=',$this->negocio->id)->where('name','like','%'.$this->sorf.'%')->get();
          $tr = new GoogleTranslate();
        for ($i=0; $i < count($this->productos) ; $i++) {
            $this->productos[$i]->descrip=$tr->setSource()->setTarget($this->idioma)->translate($this->productos[$i]->descrip);
        }
        $productos=$this->productos;
        return view('livewire.menu.menu',compact('productos'));

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
            $this->categorias = categorias::where('id_negocio', '=',$this->negocio->id)->whereNull('id_categoria')->get();
            $this->categoria_padre->name = "inicio";
            $this->categoria_padre->id_categoria = Null;
            $this->categoria_padre->productos = productos::where('id_negocio', '=', $this->id_negocio)->get();
            $this->productos= productos::where('id_negocio','=',$this->negocio->id)->get();
            }else{
                $this->categoria_padre = categorias::find($this->categoria_padre->id_categoria);
                $this->productos= $this->categoria_padre->productos;
                $this->categorias = categorias::where('id_categoria', '=',$this->categoria_padre->id)->get();

            }

        }
    }

    public function producto(productos $producto){
        $tr = new GoogleTranslate();
        $this->producto_selecionado=$producto;
        $this->producto_selecionado->descrip=$tr->setSource()->setTarget($this->idioma)->translate($this->producto_selecionado->descrip);
        $this->open=true;

    }

}
