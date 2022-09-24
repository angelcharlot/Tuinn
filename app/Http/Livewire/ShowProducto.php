<?php

namespace App\Http\Livewire;

use App\Models\productos;
use Livewire\Component;

class ShowProducto extends Component
{
    public $open=false;
    public $producto;
    public $id_producto;

    public function render()
    {
        $this->producto=productos::find($this->id_producto);
        return view('livewire.show-producto');
    }
}
