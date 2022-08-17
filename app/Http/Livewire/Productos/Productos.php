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

    public $user, $photo, $name, $descrip, $p_compra, $p_venta, $peso, $unidad_medida='ml', $volumen, $categorias, $allcategorias, $selected_id;
    public $updateMode = false;

    protected $listeners = ['destroy'];


    protected $messages = [
        'name.required' => 'campo obligatorio',
        'descrip.required' => 'campo obligatorio',
        'p_venta.required' => 'campo obligatorio',
        'numeric' => 'tienen que ser numerico',
        'required' => 'campo requerido',];
    protected $rules = [
        'name' => 'required',
        'descrip' => 'Nullable',
        'p_venta' => 'required|Numeric',
        'p_compra' => 'Nullable|Numeric',
        'volumen' => 'Nullable|Numeric',
        'unidad_medida' => 'required',
        'peso' => 'Nullable|Numeric',
        'photo'=>'Nullable|image',
        'categorias' => 'required',];

    public function cancelar(){
        $this->resetInput();
        $this->updateMode = false;}


    public function render(){
        $this->user = auth()->user();
        $this->allcategorias = categorias::all();
        return view('livewire.productos.productos');}
    public function destroy($id) {
        if ($id) {
            $producto_delete = producto::find($id);
            $url=str_replace('storage','public',$producto_delete->img);
            Storage::disk('local')->delete($url);
            $producto_delete->delete();
            $this->photo=NULL; }}

    public function update(){
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



            $record->img = $imagen;
            $record->name = $this->name;
            $record->descrip = $this->descrip;
            $record->precio_compra = $this->p_compra;
            $record->precio_venta = $this->p_venta;
            $peso = ($this->peso=="") ? NULL : $this->peso;
            $record->peso = $peso;
            $record->unidad_medida = $this->unidad_medida;
            $record->volumen = $this->volumen;
            $record->id_categoria = $this->categorias;

            $record->update();

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert_update');
        }}
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
        $peso = ($this->peso=="") ? NULL : $this->peso;
        $newproduct->peso = $peso;
        $newproduct->unidad_medida = $this->unidad_medida;
        $newproduct->volumen = $this->volumen;
        $newproduct->id_categoria = $this->categorias;
        $newproduct->save();
        $this->emit('alert_guardado');
        $this->emit('enable_copy');
        $this->resetInput();

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
        $this->categorias=$change->id_categoria;


        $this->emit('bolqueo_copy');
    }
    public function copiar($id)
    {
        $change = producto::findOrFail($id);
        $this->selected_id = $id;

        $this->name = $change->name;
        $this->descrip = $change->descrip;
        $this->p_compra = $change->precio_compra;
        $this->p_venta = $change->precio_venta;
        $this->peso = $change->peso;
        $this->unidad_medida = $change->unidad_medida;
        $this->volumen = $change->volumen;
        $this->categorias=$change->id_categoria;
        $this->emit('subir-scroll');
    }
    public function changeEvent($value)
    {
        $this->categorias = $value;
    }
    private function resetInput()
    {
        $this->photo = null;
        $this->name = null;
        $this->descrip = null;
        $this->p_compra = null;
        $this->p_venta = null;
        $this->peso = null;
        $this->unidad_medida = null;
        $this->volumen = null;
        $this->categorias=null;
        $this->emit('enable_copy');
    }
}
