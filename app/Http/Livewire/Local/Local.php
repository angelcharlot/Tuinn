<?php

namespace App\Http\Livewire\Local;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\negocio;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Local extends Component
{
    use WithFileUploads;
    public $photo;
    public $name;
    public $negocio;
    public $direccion;
    public $telefono1;
    public $telefono2;
    public $nif;
    public $iva;



    public function mount()

    {
        $this->negocio = negocio::find(auth()->user()->negocio->id);
        $this->name = $this->negocio->name;
        $this->direccion = $this->negocio->direccion;
        $this->den_social = $this->negocio->denominacion_social;
        $this->telefono1 = $this->negocio->telefono1;
        $this->telefono2 = $this->negocio->telefono2;
        $this->nif = $this->negocio->nif;
        $this->iva = $this->negocio->iva;
    }

    public function render()
    {
        return view('livewire.local.local');
    }
    public function update()
    {



        if ($this->photo) {
            $imagen = 'storage/' . $this->photo->store('banner', 'public');
        } else {
            $imagen = 'images/olvera.jpg';
        }
        $url = str_replace('storage', 'public', $this->negocio->img);
        Storage::disk('local')->delete($url);

        $this->negocio->img = $imagen;
        $this->negocio->name = $this->name;
        $this->negocio->direccion = $this->direccion;
        $this->negocio->telefono1 = $this->telefono1;
        $this->negocio->telefono2 = $this->telefono2;

        $this->negocio->iva = $this->iva;
        $this->negocio->nif = $this->nif;
        $this->negocio->update();
    }
}
