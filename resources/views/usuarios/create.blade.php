@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Crear Usuario</h5>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" name="name" id="name"
                            class="form-control"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido"
                            class="form-control"
                            value="{{ old('apellido') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo electrónico *</label>
                        <input type="email" name="email" id="email"
                            class="form-control"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono"
                            class="form-control"
                            value="{{ old('telefono') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" name="especialidad" id="especialidad"
                            class="form-control"
                            value="{{ old('especialidad') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="rol_id" class="form-label">Rol *</label>
                        <select name="rol_id" id="rol_id" class="form-select" required>
                            <option value="">Selecciona un rol</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}"
                                    {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña *</label>
                        <input type="password" name="password" id="password"
                            class="form-control" minlength="8" required>
                        <small class="text-muted">Mínimo 8 caracteres.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirmar contraseña *
                        </label>
                        <input type="password" name="password_confirmation"
                            id="password_confirmation"
                            class="form-control" minlength="8" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar usuario</button>
                <a href="{{ route('usuarios.index') }}"
                class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection