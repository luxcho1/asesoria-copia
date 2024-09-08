{{-- <a class="btn btn-primary" href="{{ url('/') }}" id="regresar" name="regresar">Regresar</a> --}}
@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Chatbot Legal - Asesoría en Leyes Chilenas</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar mensaje al chatbot -->
                    <form action="{{ route('chatbot2') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Escribe tu pregunta:</label>
                            <input type="text" class="form-control" id="message" name="message" required placeholder="Escribe tu pregunta aquí...">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                    @if(isset($response))
                        <hr>
                        <h5>Respuesta del Chatbot:</h5>
                        <p class="mt-3">{{ $response }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection