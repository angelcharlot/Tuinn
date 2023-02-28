<?php

namespace App\Http\Livewire\Productos;

use App\Models\alargeno;
use App\Models\idioma;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\productos as producto;
use App\Models\categorias;
use App\Models\negocio;
use App\Models\impresora;
use App\Models\presentacion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Intervention\Image\Facades\Image;

class Productos extends Component
{
    use WithFileUploads;
  
    public $productos,$negocio,$user, $categorias, $allcategorias, $selected_id;
    public $updateMode = false;
    public $nombre_categoria;
    public $array_cat;
    public $descrip2;
    public $impresoras;
    public $impresora;//select de la vista 
    public $select_apartado;
    public $input_apartado;
    public $apartados;
    Public $search="";
    public $photo=NULL, $name, $descrip;
    public  $presentaciones;
    protected $listeners = ['destroy', 'select_update'];
    protected $messages = ['name.required' => 'campo obligatorio',
    'input_apartado.required_if' => 'campo obligatorio',
    'descrip.required' => 'campo obligatorio','p_venta.required' => 'campo obligatorio','numeric' => 'tienen que ser numerico','required' => 'campo requerido',];
    public $allalargenos;
    public $alargenos=[];
    protected $rules = [ 
        'name' => 'required', 
        'alargenos' => '', 
        'descrip' => 'required', 
        'descrip2' => '', 
        'select_apartado' => 'required', 
        'input_apartado'=>'required_if:select_apartado,Otro...',
        'categorias' => 'required', 
        'impresora'=>'required',
        'presentaciones.*.name'=> 'required', 
        'presentaciones.*.volumen'=> '', 
        'presentaciones.*.peso'=> '', 
        'presentaciones.*.costo'=> '', 
        'presentaciones.*.precio_venta'=> 'required', 
        'presentaciones.*.unidad_medida'=> '',]; 

    public function mount(){
        
       $this->apartados=producto::where('id_negocio','=',auth()->user()->negocio->id)->get()->unique('descrip3');
        $this->presentaciones=new Collection();
        $this->presentaciones->push(new presentacion());
        $this->allalargenos=alargeno::all();
        if (impresora::where('negocio_id','=',auth()->user()->negocio->id)->first()) {
             $this->impresora=impresora::where('negocio_id','=',auth()->user()->negocio->id)->first()->id;
        }
       
      
        //dd($this->alargenos);
        
    }
    public function render() {

        $this->user = auth()->user();

        $negocioid = auth()->user()->negocio;

       // dd($negocioid);
        $this->negocio=negocio::find($negocioid->id);
        $this->impresoras=$this->negocio->impresoras;
      
       // dd($negocio->productos);
        $this->productos=producto::where('name','like','%'.$this->search.'%')->where('id_negocio','=',$this->negocio->id)->get();
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
        if (is_object($this->photo)) {
            $image = Image::make($this->photo);
            $image->resize(400,200, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
            });
            $path = 'productos/' . uniqid() . '.' . $this->photo->extension();
            Storage::disk('public')->put($path, $image->encode());
            $newproduct->img = 'storage/' . $path;
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
        $newproduct->impresora_id = $this->impresora;
        $newproduct->descrip = $this->descrip;
        $newproduct->descrip2 = $this->descrip2;
        
        if ($this->select_apartado==="Otro...") {
           $newproduct->descrip3 = $this->input_apartado; 
        }else{
            $newproduct->descrip3 = $this->select_apartado; 
        }
        

        $newproduct->save();
        $ids = explode("-", $this->array_cat);
        $newproduct->alargenos()->attach($this->alargenos);
        $newproduct->categorias()->attach($ids);

        $tr = new GoogleTranslate();
        $idioma=new idioma();
        $idioma->producto_id=$newproduct->id;
        $idioma->idioma='it';
        $idioma->descrip=$tr->setSource('es')->setTarget('it')->translate($newproduct->descrip);
        if ($newproduct->descrip2) {
        $idioma->descrip2=$tr->setSource('es')->setTarget('it')->translate($newproduct->descrip2);
        }
        
        $idioma->save();
        $idioma=new idioma();
        $idioma->producto_id=$newproduct->id;
        $idioma->idioma='en';
        $idioma->descrip=$tr->setSource('es')->setTarget('en')->translate($newproduct->descrip);
        if ($newproduct->descrip2) {
        $idioma->descrip2=$tr->setSource('es')->setTarget('en')->translate($newproduct->descrip2);
        }
        
        $idioma->save();
        $idioma=new idioma();
        $idioma->producto_id=$newproduct->id;
        $idioma->idioma='fr';
        $idioma->descrip=$tr->setSource('es')->setTarget('fr')->translate($newproduct->descrip);
        if ($newproduct->descrip2) {
        $idioma->descrip2=$tr->setSource('es')->setTarget('fr')->translate($newproduct->descrip2);
        }
        
        $idioma->save();
        $idioma=new idioma();
        $idioma->producto_id=$newproduct->id;
        $idioma->idioma='de';
        $idioma->descrip=$tr->setSource('es')->setTarget('de')->translate($newproduct->descrip);
        if ($newproduct->descrip2) {
        $idioma->descrip2=$tr->setSource('es')->setTarget('de')->translate($newproduct->descrip2);
        }
        
        $idioma->save();


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

                $image = Image::make($this->photo); // Se crea una instancia de la clase "Image" utilizando la imagen recibida como parámetro.

                $image->resize(400,200, function ($constraint) { // Se redimensiona la imagen utilizando el método "resize" de la instancia de la clase "Image".
                    $constraint->aspectRatio(); // Se mantiene la proporción original de la imagen.
                    $constraint->upsize(); // Se asegura de que la imagen no sea redimensionada a una escala mayor que la original.
                });
              
                $path = 'productos/' . uniqid() . '.' . $this->photo->extension();
                Storage::disk('public')->put($path, $image->encode());
                $record->img = 'storage/' . $path;


            }

            $record->impresora_id = $this->impresora;
            $record->name = $this->name;
            $record->descrip = $this->descrip;
            $record->descrip2 = $this->descrip2;

            if ($this->select_apartado==="Otro...") {
                $record->descrip3 = $this->input_apartado; 
             }else{
                 $record->descrip3 = $this->select_apartado; 
             }

            $record->update();
            foreach ($this->presentaciones as  $presentacion) {
                $presentacion->producto_id=$record->id;
                $presentacion->save();
            }
            $this->presentaciones=new Collection();
            $this->presentaciones->push(new presentacion());
            $ids = explode("-", $this->array_cat);
            $record->categorias()->sync($ids);
            $record->alargenos()->sync($this->alargenos);
            $tr = new GoogleTranslate();
            foreach ($record->idiomas as $key => $idioma) {
               
                $idioma->descrip=$tr->setSource('es')->setTarget($idioma->idioma)->translate($record->descrip);
                if ($record->descrip2) {
                $idioma->descrip2=$tr->setSource('es')->setTarget($idioma->idioma)->translate($record->descrip2);
                }
                
                $idioma->save();
            }


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
        $this->impresora = $change->impresora_id;
        $this->descrip = $change->descrip;
        $this->descrip2 = $change->descrip2;
        $this->presentaciones=presentacion::where('producto_id','=',$change->id)->get();
        $this->array_cat="";
        //cargar las categorias ya pertenecioentes
        foreach ($change->categorias as $key => $categoria) {
            if ($key==0) {
                $this->array_cat.=$categoria->id;
            }else{
               $this->array_cat.="-".$categoria->id; 
            }
            
        }
         $this->categorias = $change->categorias->max();
         //cargando alargenos 
        $this->alargenos=[];
        foreach ($change->alargenos as  $alargeno) {
        $this->alargenos[]=$alargeno->id;
        }
        $this->select_apartado=$change->descrip3;

        $this->resetValidation();
        $this->emit('bolqueo_copy');

    }
    public function copiar($id){
        $this->resetValidation();
        $change = producto::findOrFail($id);
        $this->selected_id = $id;

        $this->name = $change->name;
        $this->descrip = $change->descrip;
        $this->descrip2 = $change->descrip2;
        $this->photo=$change->img;
        $this->array_cat="";
        foreach ($change->categorias as $key => $categoria) {
            if ($key==0) {
                $this->array_cat.=$categoria->id;
            }else{
               $this->array_cat.="-".$categoria->id; 
            }
            
        }
         $this->categorias = $change->categorias->max();
        $this->presentaciones=presentacion::select('name','volumen','costo','precio_venta','peso','unidad_medida')->where('producto_id','=',$change->id)->get(); 
        $this->alargenos=[];
        foreach ($change->alargenos as  $alargeno) {
        $this->alargenos[]=$alargeno->id;
        }
        $this->select_apartado=$change->descrip3;
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
        $this->alargenos=[];
        $this->descrip2="";
        $this->emit('enable_copy');
        $this->resetValidation();
        $this->apartados=producto::where('id_negocio','=',auth()->user()->negocio->id)->get()->unique('descrip3');
        $this->input_apartado="";
        $this->select_apartado="";
        $this->emit('apartado');
    }
    public function pausar(producto $producto){

            $producto->activo=0;
            $producto->save();

    }
    public function reanudar(producto $producto){

        $producto->activo=1;
        $producto->save();

}

    
}
