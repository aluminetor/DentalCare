@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Editar Paciente</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" value="María López">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Documento</label>
                            <input type="text" class="form-control" value="12345678">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" value="3001234567">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" class="form-control" value="maria@example.com">
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
