<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;
use App\Models\produtos;
use App\Models\User;


class Productos extends Component
{

    public $user;


    public function render()
    {
        $this->user=auth()->user();

        return view('livewire.productos.productos');
    }
}
