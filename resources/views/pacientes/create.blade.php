@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Crear Paciente</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: María" required>
                        </div>
                        
                        <!-- Apellido (Faltaba) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ej: López" required>
                        </div>

                        <!-- Documento -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Documento</label>
                            <input type="text" name="documento" class="form-control" placeholder="Ej: 12345678" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567">
                        </div>

                        <!-- Fecha de nacimiento (Faltaba) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
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