<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\area;

class WhatsAppController extends Controller
{
    public function handleIncomingMessage(Request $request)
    {
        // Aquí puedes procesar el mensaje entrante de WhatsApp
        // Por ejemplo, puedes almacenar el mensaje en la base de datos o responder al usuario
    
        // Obtiene el valor del hub.challenge en la solicitud
        $hubChallenge = $request->input('hub_challenge');
    
        // Devuelve una respuesta HTTP 200 con el contenido del hub.challenge
        return response($hubChallenge, 200);
    }
/*     public function recibir_mensajes(Request $request)
    {
        $bodyContent = json_decode($request->getContent(), true);
        Log::info('Request received: ', ['request' => $bodyContent]);
        if (isset($bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'])) {
            $messageBody = $bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
    
            $area = new Area();
            $area->name = $messageBody;
            $area->negocio_id = 1;
            $area->save();
            Log::info('Area saved: ', ['area' => $area->toArray()]); // Registro del área guardada
        } else {
            Log::warning('no hay mendaje en la respuesta'); // Registro de advertencia si no se encuentra el cuerpo del mensaje
        }
    
        $hubChallenge = $request->input('hub_challenge');
        return response($hubChallenge, 200);

    } */

    public function recibir_mensajes(Request $request)
    {
        $bodyContent = json_decode($request->getContent(), true);
        Log::info('Request received: ', ['request' => $bodyContent]);
    
        if (isset($bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'])) {
            $messageBody = $bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
           // $senderPhone = $bodyContent['entry'][0]['changes'][0]['value']['metadata']['display_phone_number']; // Extraer el número de teléfono de "display_phone_number"
            $senderPhone = $bodyContent['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id']; // Extraer el WhatsApp ID del remitente
            $area = new Area();
            $area->name = $senderPhone . ': ' . $messageBody; // Concatenar el número de teléfono del remitente con el cuerpo del mensaje
            $area->negocio_id = 1;
            $area->save();
            Log::info('Area saved: ', ['area' => $area->toArray()]); // Registro del área guardada
            $this->enviarwasap($senderPhone);
        } else {
            Log::warning('no hay mensaje en la respuesta'); // Registro de advertencia si no se encuentra el cuerpo del mensaje
        }
    
        $hubChallenge = $request->input('hub_challenge');
        return response($hubChallenge, 200);
    }
    
    


    public function enviarwasap($tlf)
    {
        $url = "https://graph.facebook.com/v16.0/102751036152700/messages";
    
        $headers = [
            "Authorization: Bearer EAAK1XPFuHvcBAG9ped6M0BJ3XDhMZCoXZCc7IPJ9UVwOtOgRkyRZCHi8WVDNMoozTaN1VuUmF9Rp4tY85WJtdRX1ZAObEXcyZBjNKuLyp7nZBNxcxRb5vd7ZCzAe6lSMSotJZACkWEYjzrXdr9IF29SrqxSSe0nZA1dSBLUIBv29Q1hlrpo2H1rvA17VIMZASHQOgtysqx5qIt3wZDZD",
            "Content-Type: application/json"
        ];
    
        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $tlf,
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
