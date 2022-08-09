<?php

namespace App\Http\Livewire\Productos;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\produtos;
use App\Models\User;


class Productos extends Component
{
    use WithFileUploads;

    public $user;
    public $updateMode = false;
    public $photo;

    public function render()
    {
        $this->user=auth()->user();


        return view('livewire.productos.productos');
    }
    public function save()

    {

        $this->validate([

            'photo' => 'image|max:2048',

        ]);
        $this->photo->store('photos');
    }
}
