<?php

namespace App\Http\Livewire;

use App\Models\productos;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;
class ShowProducto extends Component
{
    public $open=false;
    public $producto;
    public $id_producto;
    public $idioma;

    public function render()
    {
        $tr = new GoogleTranslate();
        $this->producto=productos::find($this->id_producto);
        $this->producto->descrip=$tr->setSource('es')->setTarget($this->idioma)->translate($this->producto->descrip);
        return view('livewire.show-producto');
    }
}
