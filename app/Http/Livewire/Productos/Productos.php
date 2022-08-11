<?php

namespace App\Http\Livewire\Productos;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\productos as producto;
use App\Models\User;
use App\Models\categorias;
use Illuminate\Support\Facades\Storage;

class Productos extends Component
{
    use WithFileUploads;

    public $user, $photo, $name, $descrip, $p_compra, $p_venta, $peso, $unidad_medida, $volumen, $categorias, $allcategorias, $selected_id;
    public $updateMode = false;

    protected $messages = [
        'name.required' => 'campo obligatorio',
        'descrip.required' => 'campo obligatorio',
        'p_venta.required' => 'campo obligatorio',
        'numeric' => 'tienen que ser numerico',
        'required' => 'campo requerido',
    ];
    protected $rules = [
        'name' => 'required',
        'descrip' => 'required',
        'p_venta' => 'required|Numeric',
        'p_compra' => 'Numeric',
        'volumen' => 'Numeric',
        'unidad_medida' => 'required',
        'peso' => 'Numeric',
        'categorias' => 'required',
    ];

    public function render()
    {
        $this->user = auth()->user();
        $this->allcategorias = categorias::all();

        return view('livewire.productos.productos');
    }
    public function destroy($id)
    {
        if ($id) {
            $producto_delete = producto::find($id);
            $url=str_replace('storage','public',$producto_delete->img);
            Storage::disk('local')->delete($url);
            $producto_delete->delete();
            $this->photo=NULL;
        }
    }
    public function update()
    {
        $this->validate();

        if ($this->selected_id) {
            $record = producto::find($this->selected_id);
            if ($this->photo) {
                $imagen = 'storage/' . $this->photo->store('productos', 'public');
            } else {
                $imagen = 'images/icons8-cubiertos-100.png';
            }
            $url=str_replace('storage','public',$record->img);
            Storage::disk('local')->delete($url);
            $record->update([
                'img' => $imagen,
                'name' => $this->name,
                'descrip' => $this->descrip,
                'p_compra' => $this->p_compra,
                'precio_venta' => $this->p_venta,
                'peso' => $this->peso,
                'unidad_medida' => $this->unidad_medida,
                'volumen' => $this->volumen,
                'id_categoria' => $this->categorias,
            ]);

            $this->resetInput();
            $this->updateMode = false;
        }
    }
    public function store()
    {
        $this->validate();
        if ($this->photo) {
            $imagen = 'storage/' . $this->photo->store('productos', 'public');
        } else {
            $imagen = 'images/icons8-cubiertos-100.png';
        }

        $newproduct = new producto();
        $newproduct->id_usuario = $this->user->id;
        $newproduct->img = $imagen;
        $newproduct->name = $this->name;
        $newproduct->descrip = $this->descrip;
        $newproduct->precio_compra = $this->p_compra;
        $newproduct->precio_venta = $this->p_venta;
        $newproduct->peso = $this->peso;
        $newproduct->unidad_medida = $this->unidad_medida;
        $newproduct->volumen = $this->volumen;
        $newproduct->id_categoria = $this->categorias;
        $newproduct->save();
    }
    public function edit($id)
    {
        $change = producto::findOrFail($id);
        $this->selected_id = $id;
        $this->updateMode = true;
        $this->name = $change->name;
        $this->descrip = $change->descrip;
        $this->p_compra = $change->precio_compra;
        $this->p_venta = $change->precio_venta;
        $this->peso = $change->peso;
        $this->unidad_medida = $change->unidad_medida;
        $this->volumen = $change->volumen;
    }

    public function changeEvent($value)
    {
        $this->categorias = $value;
    }
    private function resetInput()
    {
        $this->photo = null;
    }
}
