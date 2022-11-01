<?php

namespace App\Http\Livewire\Productos;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\productos as producto;
use App\Models\categorias;
use App\Models\negocio;
use App\Models\presentacion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class Productos extends Component
{
    use WithFileUploads;
  
    public $productos,$negocio,$user, $categorias, $allcategorias, $selected_id;
    public $updateMode = false;
    public $nombre_categoria;
    public $array_cat;
    public $photo=NULL, $name, $descrip;
    public  $presentaciones;
    protected $listeners = ['destroy', 'select_update'];
    protected $messages = ['name.required' => 'campo obligatorio','descrip.required' => 'campo obligatorio','p_venta.required' => 'campo obligatorio','numeric' => 'tienen que ser numerico','required' => 'campo requerido',];
    protected $rules = [ 
        'name' => 'required', 
        'descrip' => 'Nullable', 
        'categorias' => 'required', 
        'presentaciones.*.name'=> 'required', 
        'presentaciones.*.volumen'=> '', 
        'presentaciones.*.peso'=> '', 
        'presentaciones.*.costo'=> '', 
        'presentaciones.*.precio_venta'=> 'required', 
        'presentaciones.*.unidad_medida'=> '',]; 

    public function mount(){
        $this->presentaciones=new Collection();
        $this->presentaciones->push(new presentacion());
        
    }
    public function render() {

        $this->user = auth()->user();

        $negocioid = auth()->user()->negocio;
       // dd($negocioid);
        $this->negocio=negocio::find($negocioid->id);
       // dd($negocio->productos);
        $this->productos=$this->negocio->productos;
        $this->allcategorias = categorias::where("id_negocio","=",auth()->user()->negocio->id,"and")->whereNull('id_categoria')->get();
        for ($i=0; $i < count($this->allcategorias) ; $i++) {
            $this->allcategorias[$i]->ids=$this->allcategorias[$i]->id;
        }
        return view('livewire.productos.productos');
    }
    public function add(){
        
       $this->presentaciones->push(new presentacion());
       
    }
    public function remove_pre($index){

        $this->presentaciones[$index]->delete();
        $this->presentaciones->forget($index);
        $this->emit('efecto_remove');
       
    }
    public function cancelar(){
        $this->resetInput();
        $this->updateMode = false;
        $this->presentaciones=new Collection();
        $this->presentaciones->push(new presentacion());
        $this->resetValidation();
    }
    public function destroy($id) {
        if ($id) {
            $producto_delete = producto::find($id);
            $url = str_replace('storage', 'public', $producto_delete->img);
            Storage::disk('local')->delete($url);
            $producto_delete->delete();
            $this->photo = NULL;
        }
    }
    public function select_update($id){
        $this->categorias = $id;
    }
    public function store(){

        $this->validate();


        $newproduct = new producto();
        if ( is_object($this->photo)){
            $newproduct->img = 'storage/' . $this->photo->store('productos', 'public');
        }elseif($this->photo==""){

            $newproduct->img="images/icons8-cubiertos-100.png";

        }else{
          //  dd($this->photo) ;
          $paht = str_replace("storage/", "", $this->photo);
          $extencio = explode(".", $paht);
          $newimagen='productos/Copy'.uniqid().'.'.$extencio[1];
          $newproduct->img='storage/'.$newimagen;
           Storage::copy($paht,$newimagen);
        }

        $newproduct->id_negocio = $this->negocio->id;
        $newproduct->name = $this->name;
        $newproduct->descrip = $this->descrip;
        $newproduct->save();
        $ids = explode("-", $this->array_cat);
        $newproduct->categorias()->attach($ids);
        $this->emit('ok');
        $this->emit('enable_copy');
        
        foreach ($this->presentaciones as  $presentacion) {

           
            $presentacion->producto_id=$newproduct->id;
            $presentacion->save();

           
        
        }

        $this->presentaciones=new Collection();
        $this->presentaciones->push(new presentacion());
        $this->resetInput();
    }
    public function update(){
        $this->validate();


        if ($this->selected_id) {
            $record = producto::find($this->selected_id);




            if ( is_object($this->photo)) {
                $url = str_replace('storage', 'public', $record->img);
                Storage::disk('local')->delete($url);

                $record->img = 'storage/' . $this->photo->store('productos', 'public');
            }


            $record->name = $this->name;
            $record->descrip = $this->descrip;

            $record->update();
            foreach ($this->presentaciones as  $presentacion) {
                $presentacion->producto_id=$record->id;
                $presentacion->save();
            }
            $this->presentaciones=new Collection();
            $this->presentaciones->push(new presentacion());
            $ids = explode("-", $this->array_cat);
            $record->categorias()->sync($ids);
            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert_update');
        }
    }
    public function edit($id){
        $change = producto::findOrFail($id);
        $this->selected_id = $id;
        $this->photo = $change->img;
        $this->updateMode = true;
        $this->name = $change->name;
        $this->descrip = $change->descrip;
        $this->presentaciones=presentacion::where('producto_id','=',$change->id)->get();
        $this->categorias = $change->id_categoria;
        $this->resetValidation();
        $this->emit('bolqueo_copy');
    }
    public function copiar($id){
        $this->resetValidation();
        $change = producto::findOrFail($id);
        $this->selected_id = $id;

        $this->name = $change->name;
        $this->descrip = $change->descrip;
        $this->photo=$change->img;
        $this->categorias = $change->id_categoria;
        $this->presentaciones=presentacion::select('name','volumen','costo','precio_venta','peso','unidad_medida')->where('producto_id','=',$change->id)->get(); 
        $this->emit('subir-scroll');
       
    }
    public function changeEvent($value1, $value2,$value3){
        $this->categorias = $value1;
        $this->nombre_categoria = $value2;
        $this->array_cat=$value3;
    }
    private function resetInput() {
        $this->photo = null;
        $this->name = null;
        $this->descrip = null;
        $this->p_compra = null;
        $this->p_venta = null;
        $this->peso = null;
        $this->unidad_medida = null;
        $this->volumen = null;
        $this->categorias = null;
        $this->emit('enable_copy');
        $this->resetValidation();
    }
}
