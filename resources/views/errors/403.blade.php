@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">403</h1>
        <h4 class="mb-3">Acceso denegado</h4>
        <p class="text-muted">{{ $exception->getMessage() ?: 'No tienes permiso para realizar esta acción.' }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
