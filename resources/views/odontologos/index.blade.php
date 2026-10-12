@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Odontólogos</h5>
                <a href="#" class="btn btn-primary btn-sm">Nuevo Odontólogo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Licencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dr. Carlos Ruiz</td>
                                <td>Ortodoncia</td>
                                <td>LIC-001</td>
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
