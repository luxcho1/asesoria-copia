<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class Chatbot3Controller extends Controller
{
   // Este método se encargará de recibir las solicitudes del usuario y enviar la consulta a OpenAI
   public function submit(Request $request)
   {
       // Validar que el campo de pregunta está presente
       $request->validate([
           'askText' => 'required|string'
       ]);

       // Obtener la pregunta del usuario desde el Request
       $userMessage = $request->input('askText');

       // Definir los mensajes que se enviarán al modelo (incluyendo la pregunta del usuario)
       $messages = [
           ['role' => 'system', 'content' => 'Eres un asesor juridico para responedr cualquier inquiertud sobre las leyes de Chile. Ademas solo debes responder en base a eso, si te hacen una pregunta sobre un tema diferente no puedes responder'], // Definir un comportamiento base para el chatbot
           ['role' => 'user', 'content' => $userMessage], // La pregunta del usuario
       ];

       // Ajustar los parámetros como la temperatura
       $temperature = 0.7; // Controla cuán "creativa" será la IA. Valores más altos (como 1) hacen respuestas más variadas

       // Enviar la solicitud a OpenAI
       $response = OpenAI::chat()->create([
           'model' => 'gpt-3.5-turbo', // Puedes cambiar este modelo por otro si tienes acceso
           'messages' => $messages,
           'temperature' => $temperature, // Control de creatividad
           'max_tokens' => 150, // Limita la cantidad de tokens en la respuesta
       ]);

       // Obtener la respuesta de la IA
       $botReply = $response->choices[0]->message->content;
       
       // Enviar la respuesta a la vista
        return view('chatbot3', [
            'userMessage' => $userMessage,
            'botReply' => $botReply
        ]);  
   }
}



// Devolver la respuesta a la vista o como JSON
// return response()->json([
// 'user_message' => $userMessage,
// 'bot_reply' => $botReply,
// ]);
