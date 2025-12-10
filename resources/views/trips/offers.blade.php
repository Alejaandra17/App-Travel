@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-0">Ofertas Disponibles</h2>
            <small class="text-muted">Reserva tu próxima aventura</small>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">Volver</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($trips as $trip)
        <div class="col">
            <div class="card h-100 shadow border-primary">
                <img src="{{ route('image.private', ['filename' => $trip->image_url]) }}" 
                class="card-img-top" 
                alt="{{ $trip->title }}" 
                style="height: 200px; object-fit: cover; filter: grayscale(10%);">
                
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary">{{ $trip->destination->name }}</span>
                        <span class="badge bg-success fs-5">{{ number_format($trip->price, 0, ',', '.') }} €</span>
                    </div>
                    
                    <h5 class="card-title fw-bold mt-2">{{ $trip->title }}</h5>
                    <p class="card-text text-muted small flex-grow-1">{{ $trip->description }}</p>
                    
                    <div class="mt-3">
                        <form action="{{ route('trip.buy', $trip->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                                Reservar Plaza
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-footer bg-light border-top-0 d-flex justify-content-between align-items-center">
                    <small class="text-primary fw-bold">📅 Salida: {{ \Carbon\Carbon::parse($trip->travel_date)->format('d/m/Y') }}</small>
                    
                    <div class="btn-group">
                        <a href="{{ route('trip.edit', $trip->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('trip.destroy', $trip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta oferta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection