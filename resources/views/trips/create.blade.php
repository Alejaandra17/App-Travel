@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h1 class="mb-0 fs-4 fw-bold text-center">✨ Crear Nuevo Viaje</h1>
                </div>
                
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h6 class="fw-bold"><i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Título del viaje</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Ej: Escapada a Roma" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="destination_id" class="form-label fw-bold">Destino</label>
                                <select class="form-select @error('destination_id') is-invalid @enderror" 
                                        id="destination_id" name="destination_id" required>
                                    <option value="" disabled selected>-- Selecciona --</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destination_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="travel_date" class="form-label fw-bold">Fecha de salida</label>
                                <input type="date" class="form-control @error('travel_date') is-invalid @enderror" 
                                       id="travel_date" name="travel_date" 
                                       value="{{ old('travel_date') }}" required>
                                @error('travel_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Estado</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="" disabled selected>-- Elige estado --</option>
                                    <option value="offer" {{ old('status') == 'offer' ? 'selected' : '' }}>Oferta (Disponible)</option>
                                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Realizado (Memoria)</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">Precio (€)</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" 
                                       value="{{ old('price') }}" placeholder="0.00">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 p-3 bg-light rounded border">
                            <label for="image" class="form-label fw-bold">Imagen de portada</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Descripción detallada</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" 
                                      required>{{ old('description') }}</textarea>
                            <div class="form-text text-muted">Mínimo 10 caracteres.</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                                Crear Viaje
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection