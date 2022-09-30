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
    public $idioma = "es";
    public $open = false;
    public $producto_selecionado;
    public $productos;
    public $migas;




    public function mount()
    {
        $this->producto_selecionado = new productos();
        $this->migas=array();
        $this->negocio = negocio::find($this->id_negocio);
        $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
        $this->productos = productos::where('id_negocio', '=', $this->negocio->id)->get();
    }


    public function render()
    {

        $tr = new GoogleTranslate();
        for ($i = 0; $i < count($this->productos); $i++) {
            $this->productos[$i]->descrip = $tr->setSource('es')->setTarget($this->idioma)->translate($this->productos[$i]->descrip);
        }
        for ($i = 0; $i < count($this->categorias); $i++) {
            $this->categorias[$i]->name = $tr->setSource('es')->setTarget($this->idioma)->translate($this->categorias[$i]->name);
        }
        $productos = $this->productos;
        return view('livewire.menu.menu', compact('productos'));
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
            $this->categorias = categorias::where('id_categoria', '=', $id)->get();
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

    public function producto(productos $producto)
    {
        $tr = new GoogleTranslate();
        $this->producto_selecionado = $producto;
        $this->producto_selecionado->descrip = $tr->setSource('es')->setTarget($this->idioma)->translate($this->producto_selecionado->descrip);
        $this->open = true;
    }
}
