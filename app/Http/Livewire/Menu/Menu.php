<?php

namespace App\Http\Livewire\Menu;

use App\Models\alargeno;
use App\Models\negocio;
use App\Models\categorias;
use App\Models\productos;
use App\Models\like;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Menu extends Component
{
    /* negocio */
    public $id_negocio;
    public $negocio;
    /*categorias y productos*/
    public $categorias;
    public $idioma = "es";
    public $open = false;
    public $producto_selecionado;
    public $productos;
    public $migas;
    public $ip;
    public $agente;
    public $alargenos;
    public $apartados;
    public $modalVisible = false;


    public function mount(Request $request)
    {


        $this->enviarwasap();


        $this->producto_selecionado = new productos();
        $this->migas = array();
        $this->negocio = negocio::find($this->id_negocio);
        $this->categorias = Categorias::where('id_negocio', '=', $this->negocio->id)
                             ->whereNull('id_categoria')
                            // ->orderBy('peso', 'asc')
                             ->get();

        $this->productos = productos::where('id_negocio', '=', $this->negocio->id)->where('activo', '=', 1)->get();
        $this->apartados = $this->productos->unique('descrip3');
       




         $this->apartados->prepend($this->apartados->pop());
         $this->apartados->prepend($this->apartados->pop());

        if (session('id_sessions') == null) {

            session(['id_sessions' => uniqid()]);
        }

        $this->ip = $request->ip();
        //$this->agente=$request->userAgentip();

        $this->alargenos = alargeno::all();

    }


    public function render()
    {


        return view('livewire.menu.menu');
    }
    public function nav_categorias($id)
    {

        if ($id == 'principal') {
            $this->productos = productos::where('id_negocio', '=', $this->negocio->id)->get();
            $this->categorias = categorias::where('id_negocio', '=', $this->negocio->id)->whereNull('id_categoria')->get();
            $this->migas = array();

        } else {
            $offset = NULL;
            $categoria = categorias::find($id);
            $this->categorias = $this->categorias->where('id_categoria', '=', $id);
            for ($i = 0; $i < count($this->migas); $i++) {
                if ($this->migas[$i]['name'] == $categoria->name) {
                    $offset = $i;
                }
            }

            $this->migas = (array_slice($this->migas, 0, $offset));

            $this->migas[] = ['name' => $categoria->name, 'id' => $categoria->id];
            $this->productos = $categoria->productos;
        }
    }

    public function likes($bn, $id_producto)
    {

        $x = like::where('session', '=', session('id_sessions'))->where('producto_id', '=', $id_producto);
        if ($x->count() == 0) {
            $like = new like();
            $like->ip = $this->ip;
            $like->agente = "sadsas";
            $like->tipo = $bn;
            $like->producto_id = $id_producto;
            $like->session = session('id_sessions');
            $like->save();
            if ($bn == 1) {
                $this->emit('votoguardado1');
            } else {
                $this->emit('votoguardado0');
            }

        } else {
            $this->emit('unsolovoto');
        }

    }
    public function producto($id)
    {

        $this->producto_selecionado = $this->productos->find($id);

        $this->open = true;
    }
    public function idioma()
    {




    }
 
   /*  public function enviarwasap()
{
    $url = "https://graph.facebook.com/v16.0/102751036152700/messages";

    $headers = [
        "Authorization: Bearer EAAK1XPFuHvcBAG9ped6M0BJ3XDhMZCoXZCc7IPJ9UVwOtOgRkyRZCHi8WVDNMoozTaN1VuUmF9Rp4tY85WJtdRX1ZAObEXcyZBjNKuLyp7nZBNxcxRb5vd7ZCzAe6lSMSotJZACkWEYjzrXdr9IF29SrqxSSe0nZA1dSBLUIBv29Q1hlrpo2H1rvA17VIMZASHQOgtysqx5qIt3wZDZD",
        "Content-Type: application/json"
    ];

    $data = [
        "messaging_product" => "whatsapp",
        "to" => "34624064559",
        "type" => "text",
        "text" => [
            "body" => "Qué bueno que alguien ha visto nuestra carta... " . date('d-m-Y') . "-- " . date('H:i:s')
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Imprime la respuesta para ver si hay errores
    //echo $response;
     // Decodifica la respuesta JSON
     $decodedResponse = json_decode($response, true);

     // Imprime los detalles de la respuesta
     echo "Messaging product: " . $decodedResponse["messaging_product"] . "\n";
     echo "WhatsApp ID: " . $decodedResponse["contacts"][0]["wa_id"] . "\n";
     echo "Message ID: " . $decodedResponse["messages"][0]["id"] . "\n";
} */

public function enviarwasap()
{
    $url = "https://graph.facebook.com/v16.0/102751036152700/messages";

    $headers = [
        "Authorization: Bearer EAAK1XPFuHvcBAFpj84wZAN3GigrG4aF9lUCP291bETlQuyxE1FNCAU8GcGQXFX7sBZAZCJisVI5wuueQOJSVBus75IehaXUIEDe3W9PDZAJ93ksCHqzII6RN3an95QCXaBRZBZC4UT1A5XXj9j2XHRMH2pQXYFrlRqocMMaYRP0ulJDdoc4c7gkUlO4amlWMXweBBpZAy8OhAZDZD",
        "Content-Type: application/json"
    ];

    $data = [
        "messaging_product" => "whatsapp",
        "recipient_type" => "individual",
        "to" => "34624064559",
        "type" => "text",
        "text" => [
            "preview_url" => false,
            "body" => "hola"
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Imprime la respuesta para ver si hay errores
    //echo $response;
}




}