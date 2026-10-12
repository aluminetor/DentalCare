@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Editar paciente</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('pacientes.update') }}" method="POST">
                    @csrf
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
                    @method('PUT')
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}" />

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: María" value="{{ old('nombre', $paciente->nombre) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ej: López" value="{{ old('apellido', $paciente->apellido) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Documento</label>
                            <input type="text" name="documento" class="form-control" placeholder="Ej: 1012345678" value="{{ old('documento', $paciente->documento) }}" required >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567" value="{{ old('telefono', $paciente->telefono) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection
