<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Chatbot
        </div>
        <div class="card-body chat-box" style="max-height: 300px; overflow-y: auto;">
            @foreach($messages as $message)
                <div class="d-flex {{ $message['role'] == 'user' ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                    <div class="{{ $message['role'] == 'user' ? 'bg-primary text-white' : 'bg-light' }} p-2 rounded">
                        <p class="mb-0">{{ $message['content'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <form wire:submit.prevent="submit" class="d-flex">
                <input type="text" wire:model="askText" class="form-control me-2" placeholder="Escribe tu mensaje..." required>
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a class="btn btn-primary" href="{{ url('/') }}" id="regresar" name="regresar">Regresar</a>
            </form>
        </div>
    </div>
</div>
