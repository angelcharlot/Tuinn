<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\productos;
use App\Models\area;
use App\Models\documento;
use App\Models\detalle;
use App\Models\presentacion;
use App\Models\mesa;
use Livewire\WithModal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Venta extends Component
{
    //vistas

    //documentos
    
    //variables
    public $productos;
    public $productoselect;
   public $total;
  
    public $detalles;
    public $presentaciones;
    public $presentacion;
    public $showModal=false;
    public function mount(){
        $this->productoselect=new productos();
        $this->productos=productos::where('id_negocio','=',auth()->user()->negocio->id)->get();
        $this->comanda=new Collection();
        $this->areas=area::where("negocio_id","=",auth()->user()->negocio->id)->get();
        $this->all_documentos=documento::where("negocio_id","=",auth()->user()->negocio->id)->where('estado','=','activa')->get();
        $this->presentacion=new presentacion();
        $this->presentaciones=presentacion::all();
        $this->detalles=[];
        $this->total=0;

        //dd($this->documento->productos[0]->pivot->cantidad);
    }

    public function render()
    {
        return view('livewire.venta');
    }
    
    public function abrirModal()
    {
        $this->showModal = true;
    }
    public function verPresentaciones($productoId)
{
    $this->productoselect = Productos::find($productoId);
    $this->presentaciones = $this->productoselect->presentaciones;
    $this->abrirModal();
}

public function addProduct($producto_id, $presentacion_name, $precio_venta)
{   $this->total=0;
    $producto = Productos::find($producto_id);

    $presentacion = $producto->presentaciones->where('name', $presentacion_name)->first();

    // Busca si ya existe un detalle para el producto y presentación
    $indiceDetalleExistente = -1;
    foreach ($this->detalles as $indice => $detalle) {
        if ($detalle['producto_id'] === $producto_id && $detalle['tipo_presentacion'] === $presentacion_name) {
            $indiceDetalleExistente = $indice;
            break;
        }
    }

    if ($indiceDetalleExistente >= 0) {
        // Si ya existe un detalle para el producto y presentación, simplemente incrementa la cantidad
        $this->detalles[$indiceDetalleExistente]['cantidad']++;
        $this->detalles[$indiceDetalleExistente]['sub_total']=$precio_venta*$this->detalles[$indiceDetalleExistente]['cantidad'];
    } else {
        // Si no existe un detalle para el producto y presentación, crea un nuevo objeto detalle
        $detalle = [
            'producto_id' => $producto_id,
            'cantidad' => 1,
            'name' => $producto->name,
            'tipo_presentacion' => $presentacion_name,
            'precio_venta' => $precio_venta,
            'sub_total'=>$precio_venta,
        ];
       
        // Agrega el nuevo detalle al array de detalles
        $this->detalles[] = $detalle;
    }
       foreach ($this->detalles as $key => $detalle) {
        $this->total+=$detalle['sub_total'];
       }
       
    $this->showModal = false;
}



}
