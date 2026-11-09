@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Register Patient</h5>
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm">
                Back to list
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please check the following fields:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            maxlength="60"
                            value="{{ old('first_name') }}"
                            required
                        >
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="form-control @error('last_name') is-invalid @enderror"
                            maxlength="60"
                            value="{{ old('last_name') }}"
                            required
                        >
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="document" class="form-label">Document *</label>
                        <input
                            type="text"
                            id="document"
                            name="document"
                            class="form-control @error('document') is-invalid @enderror"
                            maxlength="20"
                            value="{{ old('document') }}"
                            required
                        >
                        @error('document')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone *</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            maxlength="20"
                            value="{{ old('phone') }}"
                            required
                        >
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="birth_date" class="form-label">
                            Birth Date *
                        </label>
                        <input
                            type="date"
                            id="birth_date"
                            name="birth_date"
                            class="form-control @error('birth_date') is-invalid @enderror"
                            max="{{ now()->format('Y-m-d') }}"
                            value="{{ old('birth_date') }}"
                            required
                        >
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <p class="text-muted small">* Required fields.</p>

                <button type="submit" class="btn btn-primary">
                    Save Patient
                </button>

                <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
