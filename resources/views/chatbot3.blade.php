@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Chatbot 1.3
                </div>


                {{-- Aqui va la respuesta del chatbot --}}
                <div class="card-body chat-box" style="max-height: 300px; overflow-y: auto;"> 
                   @if (isset($userMessage) && isset($botReply))
                        <p><strong>Usuario:</strong> {{ $userMessage }}</p>
                        <p><strong>Chatbot:</strong> {{ $botReply }}</p>
                    @endif
                </div>


                <!-- Formulario para enviar el mensaje -->
                <div class="card-footer">
                    <form action="{{ route('chatbot3.submit') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="askText" class="form-control me-2" placeholder="Escribe tu mensaje..." required>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                <div class="row" style="padding-top: 30px">
                    <div class="col"></div>
                    <div class="col-6" style="text-align: center">
                        <a class="btn btn-primary" href="{{ url('/') }}" id="regresar" name="regresar">Volver a Inicio</a>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
@endsection


