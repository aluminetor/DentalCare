@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pacientes</h5>
                <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle-fill"></i> Nuevo paciente
                </a>
            </div>

            <div class="card-body">
                <form class="navbar-search" method="GET" action="{{ route('pacientes.index') }}">
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
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por nombre, apellido, documento o teléfono..." aria-label="Search" name="filter" value="{{ $data->filter }}">
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
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Nacimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->id }}</td>
                                    <td>{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                                    <td>{{ $paciente->documento }}</td>
                                    <td>{{ $paciente->telefono }}</td>
                                    <td>{{ $paciente->fecha_nacimiento->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form action="{{ route('pacientes.delete', $paciente->id) }}" method="POST" style="display: contents;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aún no hay pacientes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $pacientes->appends(request()->except('page'))->links('components.custom-pagination') }}

                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Pide confirmación antes de eliminar
            $('.btn-delete').click(function(event) {

                event.preventDefault();

                Swal.fire({
                    title: "¿Desea eliminar el paciente?",
                    text: "No podrá revertirlo",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {

                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
