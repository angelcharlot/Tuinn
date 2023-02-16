<?php

namespace App\Http\Livewire;
use App\Models\negocio;
use Livewire\Component;

class Config extends Component
{
    public $port;
    public $host;
    public $test="";
    public $bn=0;

    public function mount(){
        $negocio=negocio::find( Auth()->user()->negocio->id);
        $this->port=$negocio->config->port_server_printer;
        $this->host=$negocio->config->host_server_printer;
      
    }
    public function render()
    {
        return view('livewire.config');
    }
    public function update()
    {
        $negocio=negocio::find( Auth()->user()->negocio->id);
        $negocio->config->port_server_printer=$this->port;
        $negocio->config->host_server_printer=$this->host;
        $negocio->config->save();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->host."/test");
        curl_setopt($ch, CURLOPT_PORT, $this->port);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Petición HEAD
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);

        $content = curl_exec($ch);

        if (!curl_errno($ch)) {
            $info = curl_getinfo($ch);
                if ($info['http_code']==411) {
                    $this->test=("\nError en el puerto, verifique e intente nuevamente");
                }else{
                   $this->bn=1;
            $this->test="\n Se recibió respuesta positiva server (connected print server " . $info['http_code'].")"; 
                }

            
        } else {
            $this->bn=0;
            $this->test=("\nError en petición: " . curl_error($ch) . "\n");
        }

        curl_close($ch);


    }
 

}
