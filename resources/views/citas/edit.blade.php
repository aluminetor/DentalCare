@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Editar cita</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Revisa los siguientes errores:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="paciente_id" class="form-label">Paciente *</label>
                        <select name="paciente_id" id="paciente_id" class="form-select" required>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}"
                                    @selected(old('paciente_id', $cita->paciente_id) == $paciente->id)>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                                    — {{ $paciente->documento }}
                                </option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="odontologo_id" class="form-label">Odontólogo *</label>
                        <select name="odontologo_id" id="odontologo_id" class="form-select" required>
                            @foreach ($odontologos as $odontologo)
                                <option value="{{ $odontologo->id }}"
                                    @selected(old('odontologo_id', $cita->odontologo_id) == $odontologo->id)>
                                    {{ $odontologo->name }} {{ $odontologo->apellido }}
                                    @if ($odontologo->especialidad)
                                        — {{ $odontologo->especialidad }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('odontologo_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        @if ($odontologos->isEmpty())
                            <small class="text-danger">
                                No hay odontólogos registrados.
                            </small>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha" class="form-label">Fecha *</label>
                        <input type="date" name="fecha" id="fecha"
                            class="form-control"
                            min="{{ date('Y-m-d') }}"
                            value="{{ old('fecha', $cita->fecha->format('Y-m-d')) }}"
                            required>
                        @error('fecha')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hora" class="form-label">Hora *</label>
                        <input type="time" name="hora" id="hora"
                            class="form-control"
                            value="{{ old('hora', substr($cita->hora, 0, 5)) }}"
                            required>
                        @error('hora')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="motivo" class="form-label">Motivo *</label>
                        <input type="text" name="motivo" id="motivo"
                            maxlength="200" class="form-control"
                            value="{{ old('motivo', $cita->motivo) }}"
                            required>
                        @error('motivo')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="estado" class="form-label">Estado *</label>
                        <select name="estado" id="estado" class="form-select" required>
                            @foreach (['Pendiente', 'Confirmada', 'Atendida', 'Cancelada'] as $estado)
                                <option value="{{ $estado }}"
                                    @selected(old('estado', $cita->estado) === $estado)>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                        @error('estado')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" id="observaciones"
                                rows="3" class="form-control">{{ old('observaciones', $cita->observaciones) }}</textarea>
                        @error('observaciones')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection