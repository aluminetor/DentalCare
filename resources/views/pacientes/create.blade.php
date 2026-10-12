@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Nuevo paciente</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('pacientes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>

                            <input type="text" name="nombre" class="form-control" placeholder="Ej: María" value="{{ old('nombre') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ej: López" value="{{ old('apellido') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Documento</label>
                            <input type="text" name="documento" class="form-control" placeholder="Ej: 1012345678" value="{{ old('documento') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567" value="{{ old('telefono') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection

