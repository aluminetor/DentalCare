@extends('layouts.app')

@section('content')
@php
    $permisos = Auth::user()->rol?->permisos->pluck('codigo')->all() ?? [];
@endphp

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Listado de Usuarios</h5>

            @if(in_array('usuarios.crear', $permisos))
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm">
                    Nuevo Usuario
                </a>
            @endif
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->apellido ?? '—' }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->rol?->nombre ?? 'Sin rol' }}</td>

                                <td class="text-nowrap">
                                    @if(in_array('usuarios.editar', $permisos))
                                        <a href="{{ route('usuarios.edit', $usuario) }}"
                                        class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                    @endif

                                    @if(in_array('usuarios.eliminar', $permisos))
                                        <form action="{{ route('usuarios.delete', $usuario) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No hay usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $usuarios->links() }}
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-2">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection