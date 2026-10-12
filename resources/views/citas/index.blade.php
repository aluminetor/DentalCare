@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Listado de citas</h5>
            <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">
                Nueva cita
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Odontólogo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($citas as $cita)
                            <tr>
                                <td>
                                    {{ $cita->paciente->nombre ?? 'Sin paciente' }}
                                    {{ $cita->paciente->apellido ?? '' }}
                                </td>

                                <td>
                                    {{ $cita->odontologo->name ?? 'Sin odontólogo' }}
                                    {{ $cita->odontologo->apellido ?? '' }}
                                </td>

                                <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                                <td>{{ substr($cita->hora, 0, 5) }}</td>
                                <td>{{ $cita->motivo }}</td>

                                <td>
                                    @php
                                        $colores = [
                                            'Pendiente' => 'warning',
                                            'Confirmada' => 'primary',
                                            'Atendida' => 'success',
                                            'Cancelada' => 'danger',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $colores[$cita->estado] ?? 'secondary' }}">
                                        {{ $cita->estado }}
                                    </span>
                                </td>

                                <td class="text-nowrap">
                                    <a href="{{ route('citas.edit', $cita->id) }}"
                                    class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('citas.delete', $cita->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta cita?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No hay citas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection