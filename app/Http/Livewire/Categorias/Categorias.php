<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;
use App\Models\categorias as category;
use Illuminate\Auth\Events\Validated;

class Categorias extends Component
{

    public $categorias = NULL, $id_atras = NULL, $categoria_seleccionada = array('home');
    public $updateMode = false;
    public $name, $id_padre_categoria, $descrip, $id_select;

    protected $rules = [
        'name' => 'required',
        'descrip' => 'required',
    ];
    protected $messages = [
        'required' => 'campo oblicatorio',
    ];

    public function render()
    {
        if ($this->categorias == NULL) {
            $this->categorias = category::where('id_negocio',"=",auth()->user()->negocio->id,'and')->whereNull('id_categoria')->get();
        }

        return view('livewire.categorias.categorias');
    }
    public function buscar($xx, $bn)
    {

        $this->emit( 'actualizar_update_select',$xx);

        $categoria = category::find($xx);

        if ($categoria) {
            $this->categorias = category::where('id_categoria', '=', $categoria->id)->get();



            $this->id_atras = $retVal = ($categoria->id_categoria) ? $categoria->id_categoria : 10000;
            $categoria->id_categoria;
            $this->id_padre_categoria = $categoria->id;

            if ($bn == 0) {
                $this->categoria_seleccionada[] = $categoria->name;
            } else if ($bn == 1) {
                array_pop($this->categoria_seleccionada);
            }

        } else {

            $this->categorias = NULL;
            $this->id_padre_categoria = null;
            $this->categoria_seleccionada = array('home');
        }
    }
    public function store()
    {
        $this->validate();
        $newcategoria = new category();
        $newcategoria->name = $this->name;
        $newcategoria->descrip = $this->descrip;
        $newcategoria->id_categoria = $this->id_padre_categoria;
        $newcategoria->id_negocio=auth()->user()->negocio->id;
        $newcategoria->save();

        $this->resete();

        $this->buscar($this->id_padre_categoria, 3);
    }
    public function delete(category $cat)
    {
        $xx = $cat->id_categoria;
        $cat->delete();
        $this->buscar($xx, 3);
    }
    public function edit(category $cat)
    {
        $this->updateMode = true;
        $this->id_select = $cat->id;
        $this->name = $cat->name;
        $this->descrip = $cat->descrip;
    }
    public function update()
    {
        $this->Validate();
        $cat = category::find($this->id_select);
        $xx = $cat->id_categoria;
        $cat->name = $this->name;
        $cat->descrip = $this->descrip;
        $cat->update();
        $this->updateMode = false;
        $this->resete();
        $this->buscar($xx, 3);
    }
    public function resete()
    {


        $this->name = "";
        $this->descrip = "";
    }
}
