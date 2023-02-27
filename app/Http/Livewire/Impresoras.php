<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\impresora;

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

        session()->flash('message', 'Impresora creada exitosamente.');

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

        session()->flash('message', 'Impresora actualizada exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Impresora::find($id)->delete();
        session()->flash('message', 'Impresora eliminada exitosamente.');
    }
}
