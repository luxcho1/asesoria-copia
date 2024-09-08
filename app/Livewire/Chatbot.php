<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use OpenAI;

class Chatbot extends Component
{
    public $askText;
    public $messages = []; // Para almacenar la conversación

    public function render()
    {
        return view('livewire.chatbot')->layout('layouts.app');

    }

    public function submit()
{
    // Pregunta del usuario
    $userQuestion = strtolower($this->askText);

    // Preguntas específicas sobre los usuarios
    $userRequestKeywords = ['dime el nombre de los usuarios registrados', 'show users', 'user list'];
    $containsUserRequest = collect($userRequestKeywords)->contains(function($keyword) use ($userQuestion) {
        return strpos($userQuestion, $keyword) !== false;
    });

    if ($containsUserRequest) {
        // Obtener usuarios registrados en la base de datos
        $users = User::all(); // Obtiene todos los usuarios, puedes modificar esto según sea necesario

        // Convertir la información de usuarios a un formato legible
        $userInfo = $users->map(function($user) {
            return "Nombre: {$user->name}, Correo: {$user->email}";
        })->join("\n");

        // Añadir la información de usuarios a la respuesta
        $responseMessage = "Aquí tienes el nombre de los usuarios registrados:\n$userInfo";
    } else {
        // Ruta al archivo de texto en storage
        $filePath = 'public/leyes_familiares.txt';

        // Verifica si la pregunta del usuario menciona leer el archivo
        $fileContainsKeyword = strpos($userQuestion, 'leer archivo') !== false;
        if ($fileContainsKeyword) {
            // Verifica si el archivo existe
            if (Storage::exists($filePath)) {
                // Leer el contenido del archivo
                $fileContent = Storage::get($filePath);
                $responseMessage = "Aquí está el contenido del archivo:\n$fileContent";
            } else {
                $responseMessage = "El archivo no se encontró.";
            }
        } else {
            // Añade la pregunta del usuario a la lista de mensajes
            $this->messages[] = ['role' => 'user', 'content' => $this->askText];

            // Consultar la API de OpenAI
            $client = OpenAI::client(env("OPENAI_API_KEY"));
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $this->messages,
            ]);

            // Obtener la respuesta del asistente
            $responseMessage = $response->choices[0]->message->content;
        }
    }

    // Añadir la respuesta del asistente a la lista de mensajes
    $this->messages[] = ['role' => 'assistant', 'content' => $responseMessage];

    // Limpiar el campo de entrada después de enviar el mensaje
    $this->askText = '';
    }
}
