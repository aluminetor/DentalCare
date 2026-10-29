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

            <form class="navbar-search" method="GET" action="{{ route('usuarios.index') }}">
                <div class="row mt-2 mb-3 g-2 align-items-center">
                    <div class="col-md-auto">
                        <select class="form-select bg-light border-0 small" name="records_per_page">
                            <option {{ $data->records_per_page == 2 ? 'selected' : '' }} value="2">2</option>
                            <option {{ $data->records_per_page == 10 ? 'selected' : '' }} value="10">10</option>
                            <option {{ $data->records_per_page == 15 ? 'selected' : '' }} value="15">15</option>
                            <option {{ $data->records_per_page == 30 ? 'selected' : '' }} value="30">30</option>
                            <option {{ $data->records_per_page == 50 ? 'selected' : '' }} value="50">50</option>
                        </select>
                    </div>

                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por nombre, apellido, correo o rol..." aria-label="Search" name="filter" value="{{ $data->filter }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

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
                {{ $usuarios->appends(request()->except('page'))->links('components.custom-pagination') }}
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-2">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection