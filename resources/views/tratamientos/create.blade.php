@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Crear Tratamiento</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ej: Limpieza dental">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Costo</label>
                            <input type="number" step="0.01" class="form-control" placeholder="Ej: 50.00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-control">
                                <option>Activo</option>
                                <option>Inactivo</option>
                            </select>
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
