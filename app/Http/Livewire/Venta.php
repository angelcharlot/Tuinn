<?php

namespace App\Http\Livewire;

use App\Models\apertura_de_caja;
use App\Models\caja;
use App\Models\movimientocaja;
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
    public $observacion, $monto_operacion;
    public $tipoMovimiento = "ingreso";
    public $productoselect;
    public $total;
    public $tipo_de_venta = "venta en barra";
    public $detalles;
    public $presentaciones;
    public $presentacion;
    public $showModal = false;
    public $modal_caja = false;
    public $modal_apertura_de_caja = false;
    public $showModalingresoyegreso = false;
    public $showModalcobrar=false;   
    public $monto_caja;
    public $pago;
    public $caja, $apertura;
    public $diferencia_caja;
    public function mount()
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
        $this->negocio = negocio::find(auth()->user()->negocio->id);
        $this->caja = $this->negocio->cajas->where('nombre', request()->cookie('caja'))->first();
        $bn = $this->caja->apertura->where('caja_abierta', true)->count();

        if ($bn > 0) {
            $this->bn_apertura = 1;
            $this->apertura = $this->caja->apertura->where('caja_abierta', true)->first();
        } else {
            $this->bn_apertura = 0;
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
        if (!$this->verificarCajaAbierta()) {
            return;
        }
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
        if (!$this->verificarCajaAbierta()) {
            return;
        }
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
        $this->apertura = $apertura;
        $this->bn_apertura = 1;
        // Cerrar el modal de apertura de caja
        $this->modal_apertura_de_caja = false;
        $this->emit('mensaje-alert', "caja aperturada exitosamente");
    }
    public function cierre_de_caja()
    {

        dd($this->apertura);


    }
    public function update_diferencia()
    {
        $this->diferencia_caja = number_format($this->monto - $this->caja->saldo_actual, 2);
    }
    public function aperturar_caja_modal()
    {

        $this->monto_caja = number_format($this->caja->saldo_actual, 2);
        $this->diferencia_caja = number_format($this->caja->saldo_actual - $this->monto, 2);
        $this->modal_apertura_de_caja = true;

    }
    public function verificarCajaAbierta()
    {

        if ($this->bn_apertura == 0) {
            $this->emit('mensaje-alert', 'No se ha iniciado la caja, por favor aperture la caja para iniciar las operaciones de ventas');
            return false;
        }

        return true;
    }
    public function registrarMovimiento()
    {
        // Validar que no se pueda aplicar un egreso por un monto mayor al de la caja
        if ($this->tipoMovimiento === 'egreso' && $this->monto_operacion > $this->caja->saldo_actual) {
            $this->emit('mensaje-alert', 'El monto del egreso no puede ser mayor al saldo actual de la caja (' . $this->caja->saldo_actual . '€).');
            return;
        }
        // Validar que se haya seleccionado el tipo de movimiento
        $this->validate([
            'tipoMovimiento' => 'required|in:ingreso,egreso',
        ]);

        // Validar el monto
        $this->validate([
            'monto_operacion' => 'required|numeric|min:0',
        ]);

        // Validar la observación
        $this->validate([
            'observacion' => 'nullable|string|max:255',
        ]);


        $this->apertura = $this->caja->apertura->where('caja_abierta', true)->first();
        // Crear el movimiento
        $movimiento = new movimientocaja();
        $movimiento->monto = $this->monto_operacion;
        $movimiento->tipo_movimiento = $this->tipoMovimiento;
        $movimiento->observaciones = $this->observacion;
        $movimiento->apertura_de_cajas_id = $this->apertura->id;
        $movimiento->save();

        // Guardar el movimiento en la apertura de caja actual

        $saldo_anterior = $this->caja->saldo_actual;
        // Actualizar el saldo de la apertura de caja
        if ($this->tipoMovimiento === 'ingreso') {
            $this->caja->saldo_actual += $this->monto_operacion;
        } else {
            $this->caja->saldo_actual -= $this->monto_operacion;
        }
        $this->caja->save();

        // Cerrar el modal y emitir el evento de recargar datos
        $this->showModalingresoyegreso = false;
        $this->emit('mensaje-alert-btn', $this->tipoMovimiento . " realisado con exito");
        $impresora = $this->negocio->impresoras->first();

        $datos = [
            'usuario' => $this->caja->apertura->where('caja_abierta', true)->first()->usuario,
            'tipo' => $this->tipoMovimiento,
            'saldo_anterior' => $saldo_anterior,
            'monto' => $this->monto_operacion,
            'saldo_en_caja' => $this->caja->saldo_actual,
            'observaciones' => $this->observacion,
            'interface' => $impresora->interface,
            'caja' => $this->caja->nombre,
            'nombre_negocio' => $this->negocio->name,
        ];
        $this->enviarPeticionImprimir(json_encode($datos));


        $this->resetForm_ei();
    }
    public function modal_ingresoyegreso()
    {
        // Verificar si la caja está abierta
        if (!$this->verificarCajaAbierta()) {
            return;
        }
        $this->showModalingresoyegreso = true;
    }
    public function resetForm_ei()
    {
        $this->monto_operacion = null;
        $this->tipoMovimiento = 'ingreso';
        $this->observacion = null;
        $this->resetErrorBag();
    }
    function enviarPeticionImprimir($datos)
    {
        $url = $this->negocio->config->host_server_printer . ":" . $this->negocio->config->port_server_printer . '/imprimir_recibo';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type:application/json'
            )
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);


        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
    public function venta_en_barra_rapida()
    {
        if (!$this->verificarCajaAbierta()) {
            return;
        }
        $documento = new documento();
        $documento->estado = 'activa';
        $documento->negocio_id = $this->negocio->id;

        $estado = 'procesada'; // Tipo de documento a contar
        $negocio_id = $this->negocio->id;

        $count_documentos = Documento::where('negocio_id', $negocio_id)
            ->where('estado', $estado)
            ->count();

        $numero_documento = now()->format('Y') . "-" . str_pad(($count_documentos + 1), 4, "0", STR_PAD_LEFT);
        $documento->nro_documento=$numero_documento;
        $documento->tipo = "venta en barra";
        $documento->estado='procesada';
        $documento->sub_total = 0;
        $documento->total = 0;
        $documento->save();

        foreach ($this->detalles as $key => $detalle) {

            $new_detalle=new detalle();
            $new_detalle->producto_id=$detalle['producto_id'];
            $new_detalle->cantidad=$detalle['cantidad'];
            $new_detalle->name=$detalle['name'];
            $new_detalle->tipo_presentacion=$detalle['tipo_presentacion'];
            $new_detalle->precio_venta=$detalle['precio_venta'];
            $new_detalle->documento_id=$documento->id;
            $new_detalle->save();

            
        }
        $total_general = 0;
        foreach ($documento->detalles as $key => $detalle) {
            $retVal = ($detalle->cantidad > 1) ? $detalle->precio_venta : "";
            $array_detalle[] = [
                'cantidad' => $detalle->cantidad,
                'name' => (substr($detalle->name, 0, 15) . "-" . substr(($detalle->tipo_presentacion), 0, 10) . " " . $retVal),
                'precio' => $detalle->precio_venta,
                'total' => ($detalle->precio_venta * $detalle->cantidad)
                
            ];
            $total_general += $detalle->precio_venta * $detalle->cantidad;
        }

        $this->caja->saldo_actual+=$total_general;
        $this->caja->save();
        $name_n = urlencode($this->negocio->name);
        $direccion = urlencode($this->negocio->direccion);
        $nif = $this->negocio->nif;
        $datos=$array_detalle;
        $interface=$this->negocio->impresoras->first()->interface;

        $this->envio_a_empre_tiket($datos,$interface, $name_n, $direccion, $nif,$documento->nro_documento,$this->caja->nombre);

        $this->detalles = [];
        $this->emit("mensaje-alert", "venta realizada");

    }
    public function envio_a_empre_tiket($data, $interface, $name_n, $direccion, $nif, $serie,$caja)
    {




        $encodedData = json_encode($data);

        $url = $this->negocio->config->host_server_printer . ":" . $this->negocio->config->port_server_printer . "/venta_en_barra_rapida?interface=" . $interface ."&name_n=" . $name_n . "&direc=" . $direccion . "&nif=" . $nif . "&serie=" . $serie ."&caja=".$caja;
        
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, $url);

        curl_setopt($cliente, CURLOPT_HEADER, 0);
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cliente, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($cliente, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json'
        )
        );
        curl_setopt($cliente, CURLOPT_POST, true);
        curl_setopt($cliente, CURLOPT_POSTFIELDS, $encodedData);
        $respuesta = curl_exec($cliente);
        //dd($respuesta);
        curl_close($cliente);



    }
    public function cobrar(){

        $this->showModalcobrar=true;

    }


}