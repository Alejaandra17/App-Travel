@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-8">
            <div class="card shadow-sm p-4 mb-4 border-0">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h1 class="mb-0 fw-bold fs-2">Editar Viaje</h1>
                </div>

                <form action="{{ route('trip.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Título del viaje</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" 
                               value="{{ old('title', $trip->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="destination_id" class="form-label fw-bold">Destino</label>
                            <select class="form-select @error('destination_id') is-invalid @enderror" 
                                    id="destination_id" name="destination_id">
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" 
                                        {{ (old('destination_id', $trip->destination_id) == $destination->id) ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="travel_date" class="form-label fw-bold">Fecha de salida</label>
                            <input type="date" class="form-control @error('travel_date') is-invalid @enderror" 
                                   id="travel_date" name="travel_date" 
                                   value="{{ old('travel_date', \Carbon\Carbon::parse($trip->travel_date)->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Precio (€)</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" 
                               value="{{ old('price', $trip->price) }}">
                    </div>

                    <div class="mb-4 p-3 bg-light rounded border">
                        <label for="image" class="form-label fw-bold">Cambiar imagen de portada</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Descripción detallada</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="6" required>{{ old('description', $trip->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ route('trips.offers') }}" class="btn btn-outline-secondary">
                            &larr; Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
@endsection