@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Citas</h5>
                <a href="#" class="btn btn-primary btn-sm">Nueva Cita</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Odontólogo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>María López</td>
                                <td>Dr. Carlos Ruiz</td>
                                <td>2026-10-15</td>
                                <td>09:00</td>
                                <td><span class="badge bg-warning">Pendiente</span></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // TODO: listener SweetAlert2 para .btn-delete
    </script>
@endpush
