@extends('layout')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="height: 80vh;">
    
    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold">✈️ TRIPPY</h1>
        <p class="lead text-muted mb-3">¿Qué quieres hacer hoy?</p>
        
        <a href="{{ route('trips.create') }}" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm">
            + Crear Nuevo Viaje
        </a>
    </div>

    <div class="row w-100 justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card h-100 shadow-sm border-0 text-center p-5 hover-shadow" style="background-color: #f8f9fa;">
                <div class="card-body">
                    <h2 class="card-title fw-bold mb-3">📖 Recuerdos</h2>
                    <p class="card-text mb-4">Revive tus aventuras pasadas.</p>
                    <a href="{{ route('trips.memories') }}" class="btn btn-secondary btn-lg w-100 stretched-link">Ver Diario</a>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card h-100 shadow-sm border-primary text-center p-5" style="border-width: 2px;">
                <div class="card-body">
                    <h2 class="card-title fw-bold text-primary mb-3">🚀 Próximo Destino</h2>
                    <p class="card-text mb-4">Descubre nuevas ofertas y reserva tu aventura.</p>
                    <a href="{{ route('trips.offers') }}" class="btn btn-primary btn-lg w-100 stretched-link">Ver Ofertas</a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center mt-4 w-50 shadow-sm">
              {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger text-center mt-4 w-50 shadow-sm">
              {{ session('error') }}
        </div>
    @endif
</div>
@endsection