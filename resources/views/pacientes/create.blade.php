
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Registrar paciente</h5>
            <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary btn-sm">
                Volver al listado
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Revisa los siguientes campos:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            maxlength="60"
                            value="{{ old('nombre') }}"
                            required
                        >
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido *</label>
                        <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            class="form-control @error('apellido') is-invalid @enderror"
                            maxlength="60"
                            value="{{ old('apellido') }}"
                            required
                        >
                        @error('apellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="documento" class="form-label">Documento *</label>
                        <input
                            type="text"
                            id="documento"
                            name="documento"
                            class="form-control @error('documento') is-invalid @enderror"
                            maxlength="20"
                            value="{{ old('documento') }}"
                            required
                        >
                        @error('documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono *</label>
                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="form-control @error('telefono') is-invalid @enderror"
                            maxlength="20"
                            value="{{ old('telefono') }}"
                            required
                        >
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_nacimiento" class="form-label">
                            Fecha de nacimiento *
                        </label>
                        <input
                            type="date"
                            id="fecha_nacimiento"
                            name="fecha_nacimiento"
                            class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                            max="{{ now()->format('Y-m-d') }}"
                            value="{{ old('fecha_nacimiento') }}"
                            required
                        >
                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <p class="text-muted small">* Campos obligatorios.</p>

                <button type="submit" class="btn btn-primary">
                    Guardar paciente
                </button>

                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
