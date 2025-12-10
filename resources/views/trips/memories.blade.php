@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold mb-0">Diario de Viajes</h2>
            <small class="text-muted">Experiencias por el mundo</small>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($trips as $trip)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ route('image.private', ['filename' => $trip->image_url]) }}" 
                class="card-img-top" 
                alt="{{ $trip->title }}" 
                style="height: 200px; object-fit: cover; filter: grayscale(10%);">
                
                <div class="card-body">
                    <div class="mb-2">
                        <span class="badge bg-secondary">{{ $trip->destination->name }}</span>
                    </div>
                    <h5 class="card-title fw-bold">{{ $trip->title }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($trip->description, 90) }}</p>
                    
                    <a href="{{ route('trip.show', $trip->id) }}" class="btn btn-link text-dark p-0 text-decoration-none stretched-link">
                        Leer más &rarr;
                    </a>
                </div>
                <div class="card-footer bg-white border-0 pt-0 d-flex justify-content-between align-items-center">
                    <small class="text-muted">📅 {{ \Carbon\Carbon::parse($trip->travel_date)->format('d/m/Y') }}</small>
                    
                    <div class="btn-group" style="position: relative; z-index: 2;">
                        <a href="{{ route('trip.edit', $trip->id) }}" class="btn btn-sm btn-outline-primary">
                            Editar
                        </a>
                        <form action="{{ route('trip.destroy', $trip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de querer borrar este recuerdo?');">
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