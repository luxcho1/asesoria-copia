<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Chatbot2 extends Controller
{
    //
    public function interact(Request $request)
    {
        // Obtener la clave de API de OpenAI desde .env
        $apiKey = env('OPENAI_API_KEY');

        // Definir el mensaje del usuario
        $userMessage = $request->input('message');

        // Hacer la solicitud a la API de OpenAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un asesor legal especializado en leyes chilenas. Debes ayudar a los usuarios respondiendo preguntas legales de manera precisa y profesional, basándote en el marco jurídico de Chile.'
                ],
                [
                    'role' => 'user',
                    'content' => $userMessage
                ]
            ],
            'temperature' => 0.7
        ]);

        // Decodificar la respuesta
        $result = $response->json();

        // Enviar la respuesta del chatbot a la vista
        return view('chatbot2', ['response' => $result['choices'][0]['message']['content']]);
    }
}
