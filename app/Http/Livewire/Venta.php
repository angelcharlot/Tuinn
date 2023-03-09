<?php

namespace App\Http\Livewire;

use App\Models\apertura_de_caja;
use App\Models\caja;
use Illuminate\Support\Facades\Cookie;
use App\Models\negocio;
use Livewire\Component;
use App\Models\productos;
use App\Models\area;
use App\Models\documento;
use App\Models\detalle;
use Illuminate\Http\Request;
use App\Models\presentacion;
use App\Models\mesa;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Venta extends Component
{
    //vistas

    //documentos

    //variables
    public $productos;
    public $monto;
    public $productoselect;
    public $total;
    public $tipo_de_venta = "venta en barra";
    public $detalles;
    public $presentaciones;
    public $presentacion;
    public $showModal = false;
    public $modal_caja = false;
    public $modal_apertura_de_caja = false;
    public $monto_caja;
    public $caja;
    public $diferencia_caja;
    public function mount($caja,$caso)
    {
        $this->productoselect = new productos();
        $this->productos = productos::where('id_negocio', '=', auth()->user()->negocio->id)->get();
        $this->comanda = new Collection();
        $this->areas = area::where("negocio_id", "=", auth()->user()->negocio->id)->get();
        $this->all_documentos = documento::where("negocio_id", "=", auth()->user()->negocio->id)->where('estado', '=', 'activa')->get();
        $this->presentacion = new presentacion();
        $this->presentaciones = presentacion::all();
        $this->detalles = [];
        $this->total = 0;
        $this->caja = Caja::where('nombre',$caja)->first();
        
        $negocio = negocio::find(auth()->user()->negocio->id);
      
        if ($caso==2) {
            
          
            $this->modal_caja = true;
       
        } else {
            
            $this->modal_caja = false;

        }





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
    {
        $this->total = 0;
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
            $this->detalles[$indiceDetalleExistente]['sub_total'] = $precio_venta * $this->detalles[$indiceDetalleExistente]['cantidad'];
        } else {
            // Si no existe un detalle para el producto y presentación, crea un nuevo objeto detalle
            $detalle = [
                'producto_id' => $producto_id,
                'cantidad' => 1,
                'name' => $producto->name,
                'tipo_presentacion' => $presentacion_name,
                'precio_venta' => $precio_venta,
                'sub_total' => $precio_venta,
            ];

            // Agrega el nuevo detalle al array de detalles
            $this->detalles[] = $detalle;
        }
        foreach ($this->detalles as $key => $detalle) {
            $this->total += $detalle['sub_total'];
        }
        $this->emit('productoAgregado');
        $this->showModal = false;
    }

    public function cancelar()
    {
        $this->detalles = [];
        $this->emit("mensaje-alert", "operacion cancelada");
    }

    public function aperturar()
    {
        // Validar el monto ingresado
        $this->validate([
            'monto' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo registro de apertura de caja
        $apertura = new apertura_de_caja();
        $apertura->fecha_apertura = now();
        $apertura->caja_id = $this->caja->id;
        $apertura->usuario = auth()->user()->name;
        $apertura->monto_inicial = $this->monto;
        $apertura->caja_abierta = true;
        $apertura->save();

        // Cerrar el modal de apertura de caja
        $this->modal_apertura_de_caja = false;
        $this->emit('mensaje_alert', "caja aperturada exitosamente");
    }
    public function update_diferencia()
    {
        $this->diferencia_caja = number_format($this->monto - $this->caja->saldo_actual, 2);
    }
    public function aperturar_caja_modal()
    {

        if ($this->caja && $this->caja->aperturasDeCaja->where('caja_abierta', true)->count() > 0) {

            $this->modal_apertura_de_caja = false;
        } else {
            $this->monto_caja = number_format($this->caja->saldo_actual, 2);
            $this->diferencia_caja = number_format($this->caja->saldo_actual - $this->monto, 2);
            $this->modal_apertura_de_caja = true;
        }
    }



}