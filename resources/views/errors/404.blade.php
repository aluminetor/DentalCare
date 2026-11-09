@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">404</h1>
        <h4 class="mb-3">No encontrado</h4>
        <p class="text-muted">{{ $exception->getMessage() ?: 'El recurso que buscas no existe.' }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
