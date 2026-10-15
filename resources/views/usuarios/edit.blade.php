@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Editar Usuario</h5>
            </div>
            <div class="card-body">
                {{-- Muestra los errores de validación si existen --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Se ajustó la ruta, y se añadieron las directivas obligatorias de Laravel --}}
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $usuario->apellido) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $usuario->telefono) }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Especialidad</label>
                            <input type="text" name="especialidad" class="form-control" value="{{ old('especialidad', $usuario->especialidad) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rol *</label>
                            {{-- Aquí cargamos los roles dinámicamente desde el controlador --}}
                            <select name="rol_id" class="form-control" required>
                                <option value="">Seleccione un rol...</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Sección para cambiar contraseña (es opcional según el controlador) --}}
                    <hr class="my-4">
                    <h6 class="mb-3">Cambiar Contraseña (Opcional)</h6>
                    <p class="text-muted small">Deja estos campos en blanco si no deseas cambiar la contraseña actual.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirmar Contraseña</label>
                            {{-- Laravel busca automáticamente el campo terminado en _confirmation --}}
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
                        {{-- Cambié la ruta del botón cancelar para que devuelva a la lista de usuarios --}}
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // TODO: validación / jQuery del formulario
    </script>
@endpush