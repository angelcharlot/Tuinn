<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\productos;
use App\Models\negocio;



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

    public function recibir_mensajes(Request $request)
    {
        $bodyContent = json_decode($request->getContent(), true);
        Log::info('Request received: ', ['request' => $bodyContent]);

        if (isset($bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'])) {
            $messageBody = $bodyContent['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
            $senderPhone = $bodyContent['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id']; // Extraer el WhatsApp ID del remitente

            // Guardar el mensaje del usuario en la tabla conversations
            $userMessage = new Conversation();
            $userMessage->nro_tlf = $senderPhone;
            $userMessage->tipo = 'mensaje';
            $userMessage->contenido = $messageBody;
            $userMessage->save();
            Log::info('User message saved: ', ['message' => $userMessage->toArray()]);

            // Obtener la respuesta de OpenAI y guardarla en la tabla conversations
            $responseText = $this->callOpenAI($messageBody, $senderPhone);

            $aiResponse = new Conversation();
            $aiResponse->nro_tlf = $senderPhone;
            $aiResponse->tipo = 'respuesta';
            $aiResponse->contenido = $responseText;
            $aiResponse->save();
            Log::info('AI response saved: ', ['response' => $aiResponse->toArray()]);

            // Enviar la respuesta de OpenAI al usuario
            $this->enviarwasap($senderPhone, $responseText);
        } else {
            Log::warning('no hay mensaje en la respuesta'); // Registro de advertencia si no se encuentra el cuerpo del mensaje
        }

        $hubChallenge = $request->input('hub_challenge');
        return response($hubChallenge, 200);
    }

    public function enviarwasap($tlf, $respuesta)
    {
        Log::info('Sending WhatsApp message: ', ['to' => $tlf, 'message' => $respuesta]); // Agregar log al inicio de la función

        $url = "https://graph.facebook.com/v16.0/106010125825283/messages";

        $headers = [
            "Authorization: Bearer EAAK1XPFuHvcBAGUB6SeCDZA2VeyzvSPjLuTKKvTE1lvUpUAGfQ5VZA7sUM8wgPkrYmy9LhPnq9HCZAyYH1E2Nrom2Y9X9zZAqwMZBW8B6rLso14nCLFrqjEDTW4KiQQs2hDZApHKENqtdExeOi4prmEAV6nzzD5SjBllfIFp9SA58OdJcvAlBSoBpusGtGyZCZAJBhIyzdlO6QZDZD",
            "Content-Type: application/json"
        ];

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $tlf,
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $respuesta,
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // Agregar log antes de imprimir la respuesta
        Log::info('WhatsApp API response: ', ['response' => $response]);

        // Imprime la respuesta para ver si hay errores
        //echo $response;
    }

    public function pruebaia()
    {



        // Obtener información del negocio (bar)
        $bar = negocio::find(1); // Asume que el negocio con id=1 es el bar Bodeguita mi pueblo

        // Obtener algunos productos populares (por ejemplo, los 5 primeros productos activos)
        $productosPopulares = Productos::where('id_negocio', $bar->id)->where('activo', 1)->orderBy('precio_venta', 'desc')->get();

        // Construir el contexto con la conversación anterior y detalles del negocio
        $contexto = "Eres el Encargado de reservas del bar {$bar->name}, ubicado en {$bar->direccion}, que tiene los horarios de lunes a viernes de 2 de la tarde a 5 de la tarde. Las reservas solo se pueden hacer a las 2 de la tarde. En base a esto,no puedes actar reservas que se sean a la 2 de la tarde,respnde sin espesificar que es una respuesta osea haslo de manera natural, tienes que conseguir que el cliente reserve. Hoy es " . date('Y-m-d') . ".\n\n";

        $contexto .= "Algunos de nuestros productos populares son:\n";
        foreach ($productosPopulares as $producto) {
            $contexto .= "- {$producto->name} ({$producto->descrip}): \n";
            foreach ($producto->presentaciones as $key => $presentacion) {
                $contexto .= "presentacion " . $presentacion->name . " con precio :" . $presentacion->precio_venta . " \n";
            }

        }
        $contexto .= "\n";

        return $contexto;

    }
    public function callOpenAI($prompt, $senderPhone)
    {
        // Obtener la conversación anterior basada en el número de teléfono
        $previousConversation = Conversation::where('nro_tlf', $senderPhone)->orderBy('created_at')->get();

        // Obtener información del negocio (bar)
        $bar = negocio::find(1); // Asume que el negocio con id=1 es el bar Bodeguita mi pueblo

        // Obtener algunos productos populares (por ejemplo, los 5 primeros productos activos)
        $productosPopulares = Productos::where('id_negocio', $bar->id)
            ->where('activo', 1)
            ->orderBy('precio_venta', 'desc')
            ->take(10)
            ->get();


        // Construir el contexto con la conversación anterior y detalles del negocio
        $contexto = "Hoy es " . date('Y-m-d') . ". Eres una IA encargada de las reservas del bar {$bar->name}, ubicado en {$bar->direccion}, Olvera, Cádiz. El horario del bar es de miércoles a domingo, de 2 PM a 5 PM. Las reservas solo se pueden hacer a las 2 PM. Estamos en España y en verano se recomienda a los clientes sentarse en las mesas de la terraza, a menos que estén todas ocupadas. La carta digital está disponible en https://www.tuinn.es/menu/1. No se pueden reservar tapas, platos o bebidas aparte de la reserva. No se proporciona información adicional del menú.\n\n";

        $contexto .= "Instrucciones para la reserva:\n";
        $contexto .= "- Solicitar solo, nombre de la persona, número de comensales, fecha (sin hora) y preferencia de salón o terraza.\n";
        $contexto .= "- No ofrecer servicios adicionales, solo reservas.\n";
        $contexto .= "- Obtener confirmación del cliente y finalizar la conversación.\n";
        $contexto .= "- No ser insistente ni repetir las mismas cosas en varios mensajes.\n";
        $contexto .= "- Generar y devolver un JSON con los detalles de la reserva confirmada.\n";

        /*  $contexto .= "-en dado caso que las reservas esten completas, se dire al cliente que no se puede reservar pero que pueden ir a local y esperar por turno " . " \n"; */



        /*         $contexto .= "Algunos de nuestros productos populares son:\n";
        foreach ($productosPopulares as $producto) {
        $contexto .= "- {$producto->name} ({$producto->descrip}): \n";
        foreach ($producto->presentaciones as $key => $presentacion) {
        $contexto .= "-" . $presentacion->name . "precio :" . $presentacion->precio_venta . " \n";
        }
        } */
        $contexto .= "\n";

        // Crear un arreglo de mensajes
        $messages = [];

        // Opcional: Agregar el mensaje del sistema al arreglo de mensajes
        $messages[] = [
            'role' => 'system',
            'content' => $contexto,
        ];

        // Agregar la conversación anterior al arreglo de mensajes
        foreach ($previousConversation as $message) {
            $role = $message->tipo === 'mensaje' ? 'user' : 'assistant';
            $messages[] = [
                'role' => $role,
                'content' => $message->contenido,
            ];
        }
        // Agregar el último mensaje del usuario al arreglo de mensajes
        $messages[] = [
            'role' => 'user',
            'content' => $prompt,
        ];

        $apiKey = config('services.openai.api_key');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
            'temperature' => 0.8,
            'top_p' => 1,
            'n' => 1,
        ]));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);
        $decoded_json = json_decode($response, true);

        // Comprobar si existe la clave 'choices' en la respuesta
        if (isset($decoded_json['choices'])) {
            // Retorna la respuesta que se extrae del JSON
            return $decoded_json['choices'][0]['message']['content'];
        } else {
            // Retorna la respuesta completa para examinarla
            return $response;
        }


    }

    

}