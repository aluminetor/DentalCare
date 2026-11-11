@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Editar Usuario</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                        </div>
                        
                        <!-- Agregamos el campo Apellido que faltaba en la vista -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $usuario->apellido) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rol</label>
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
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection