@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Editar Cita</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" value="2026-10-15">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" class="form-control" value="09:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paciente</label>
                            <input type="text" class="form-control" value="María López">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Motivo</label>
                            <input type="text" class="form-control" value="Revisión general">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">Cancelar</a>
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
