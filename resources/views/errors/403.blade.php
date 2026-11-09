@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">403</h1>
        <h4 class="mb-3">Access Denied</h4>
        <p class="text-muted">{{ $exception->getMessage() ?: 'You do not have permission to perform this action.' }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
    </div>
@endsection
