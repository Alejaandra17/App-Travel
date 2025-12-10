@extends('layout')

@section('content')
<div class="container mt-5 mb-5">

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm p-4 mb-4 border-0">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="mb-0 fw-bold">{{ $trip->title }}</h1>
                    <span class="badge bg-secondary fs-6">{{ $trip->destination->name }}</span>
                </div>
                
                <div class="border-bottom pb-3 mb-3 text-muted d-flex align-items-center">
                    <span class="me-3">📅 {{ \Carbon\Carbon::parse($trip->travel_date)->format('d/m/Y') }}</span>
                    
                    @if($trip->status == 'offer')
                        <span class="badge bg-success">Oferta: {{ number_format($trip->price, 2, ',', '.') }}€</span>
                    @endif
                </div>

                @if($trip->image_url)
                    <img src="{{ route('image.private', ['filename' => $trip->image_url]) }}" 
                         class="img-fluid rounded mb-4 w-100 shadow-sm" 
                         alt="{{ $trip->title }}" 
                         style="max-height: 400px; object-fit: cover;">

                @elseif($trip->destination && $trip->destination->image_url)
                    <img src="{{ route('image.private', ['filename' => $trip->destination->image_url]) }}" 
                         class="img-fluid rounded mb-4 w-100 shadow-sm" 
                         alt="{{ $trip->destination->name }}" 
                         style="max-height: 400px; object-fit: cover;">

                @else
                    <div class="bg-light rounded mb-4 w-100 d-flex align-items-center justify-content-center text-muted border" 
                         style="height: 300px;">
                        <div class="text-center">
                            <span>Sin imagen disponible</span>
                        </div>
                    </div>
                @endif
                <div class="lead text-dark mb-5" style="line-height: 1.8;">
                    {{ $trip->description }}
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-4">
                    <a href="{{ $trip->status == 'offer' ? route('trips.offers') : route('trips.memories') }}" class="btn btn-outline-secondary">
                        &larr; Volver al listado
                    </a>
                    
                    <div class="d-flex gap-2">
                        @if($trip->status == 'offer')
                            <form action="{{ route('trip.buy', $trip->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary fw-bold shadow-sm">🛒 Comprar Ahora</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm bg-light border-0 sticky-top" style="top: 20px; z-index: 1;">
                <div class="card-header bg-white fw-bold border-bottom py-3">
                    Notas y Recuerdos
                </div>
                
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                    
                    @if(count($trip->memories) > 0)
                        @foreach($trip->memories as $memory)
                            <div class="alert alert-warning shadow-sm border-0 mb-3">
                                <p class="mb-2 text-dark">{{ $memory->note }}</p>
                                <div class="text-end border-top border-warning pt-1">
                                    <small class="text-muted fst-italic" style="font-size: 0.75rem">
                                        Escrito el {{ $memory->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-muted">
                            <p class="mb-0">Todavía no hay recuerdos.</p>
                            <small>¡Sé el primero en escribir uno!</small>
                        </div>
                    @endif
                </div>

                <div class="card-footer bg-white p-3 border-top">
                    <form action="{{ route('memory.store', $trip->id) }}" method="POST">
                        @csrf
                        
                        @error('general')
                            <div class="alert alert-danger p-2 small mb-2">{{ $message }}</div>
                        @enderror

                        @error('note')
                            <div class="alert alert-danger p-2 small mb-2">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="note" class="form-label small text-muted fw-bold">Nuevo recuerdo:</label>
                            <div class="d-flex gap-2">
                                <input type="text" 
                                       id="note"
                                       name="note" 
                                       class="form-control" 
                                       placeholder="Escribe algo bonito..." 
                                       value="{{ old('note') }}"
                                       required>
                                <button class="btn btn-primary" type="submit">Añadir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection