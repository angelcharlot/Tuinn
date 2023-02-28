<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\impresora;
use App\Models\productos as producto;

class Impresoras extends Component
{
    public $impresora,$id_impre,$name, $default, $interface;
    public $tipo;
    public $isOpen = false;
    public $isEditing;

   

    public function render()
    {
        $this->tipo="EPSON";

        $this->impresoras = impresora::where("negocio_id","=",auth()->user()->negocio->id)->get();
        return view('livewire.impresoras');
    }

    public function create()
    {
        $this->isEditing=0;
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->tipo = '';
        $this->default = 0;
        $this->interface = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'tipo' => 'required',
            'interface' => 'required',
        ]);

        Impresora::create([
            'negocio_id' => auth()->user()->negocio->id,
            'name' => $this->name,
            'tipo' => $this->tipo,
            'default' => $this->default,
            'interface' => $this->interface,
        ]);

        
        $this->emit("mensaje-alert",'Impresora creada exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->isEditing=1;
        $impresora = Impresora::findOrFail($id);
        $this->id_impre = $id;
        $this->name = $impresora->name;
        $this->tipo = $impresora->tipo;
        $this->default = $impresora->default;
        $this->interface = $impresora->interface;
        $this->openModal();
    }

    public function update(impresora $impresora)
    {
        $this->validate([
            'name' => 'required',
            'tipo' => 'required',
            'interface' => 'required',
        ]);
      
       
        $impresora->update([
            'name' => $this->name,
            'tipo' => $this->tipo,
            'default' => $this->default,
            'interface' => $this->interface,
        ]);
        $this->emit("mensaje-alert",'Impresora actualizada exitosamente.');
       

        $this->closeModal();
        $this->resetInputFields();
    }

  
    public function delete($id)
    {
        $negocio_id = auth()->user()->negocio->id;
        $impresoras = impresora::where('negocio_id', $negocio_id)->get();
        $impresora = impresora::find($id);

        // Si hay más de una impresora, eliminar la impresora y actualizar los productos
        if ($impresoras->count() > 1) {
            $next_impresora = $impresoras->where('id', '!=', $id)->first();

            // Actualizar los productos que se imprimen en la impresora que se va a eliminar
            $productos = producto::where('id_negocio', $negocio_id)
                                ->where('impresora_id', $impresora->id)
                                ->update(['impresora_id' => $next_impresora->id]);

            $impresora->delete();
            $this->emit("mensaje-alert-btn","todos los productos que se imprimen en esa imresora seran cambiados a la siguiente impresora   ");
        }
        else {
            $this->emit("mensaje-alert", "Debes tener registrada al menos una impresora.");
        }
    }
}
