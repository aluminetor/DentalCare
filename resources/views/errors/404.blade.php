@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">404</h1>
        <h4 class="mb-3">Not Found</h4>
        <p class="text-muted">{{ $exception->getMessage() ?: 'The resource you are looking for does not exist.' }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
    </div>
@endsection
