@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Patient</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('patients.update') }}" method="POST">
                    @csrf
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
                    @method('PUT')
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}" />

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="e.g. Mary" value="{{ old('first_name', $patient->first_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="e.g. Lopez" value="{{ old('last_name', $patient->last_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Document</label>
                            <input type="text" name="document" class="form-control" placeholder="e.g. 1012345678" value="{{ old('document', $patient->document) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="e.g. 3001234567" value="{{ old('phone', $patient->phone) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $patient->birth_date->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
