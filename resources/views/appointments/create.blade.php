@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Create Appointment</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please check the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="patient_id" class="form-label">Patient *</label>
                        <select name="patient_id" id="patient_id"
                                class="form-select @error('patient_id') is-invalid @enderror"
                                required>
                            <option value="">Select a patient</option>

                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    @selected(old('patient_id') == $patient->id)>
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                    — {{ $patient->document }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dentist_id" class="form-label">Dentist *</label>
                        <select name="dentist_id" id="dentist_id"
                                class="form-select @error('dentist_id') is-invalid @enderror"
                                required>
                            <option value="">Select a dentist</option>

                            @foreach ($dentists as $dentist)
                                <option value="{{ $dentist->id }}"
                                    @selected(old('dentist_id') == $dentist->id)>
                                    {{ $dentist->name }} {{ $dentist->last_name }}
                                    @if ($dentist->specialty)
                                        — {{ $dentist->specialty }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('dentist_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($dentists->isEmpty())
                            <small class="text-danger">
                                No dentists registered. Please register a user with the Dentist role before creating appointments.
                            </small>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date *</label>
                        <input type="date" name="date" id="date"
                               class="form-control @error('date') is-invalid @enderror"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('date') }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">Time *</label>
                        <input type="time" name="time" id="time"
                               class="form-control @error('time') is-invalid @enderror"
                               value="{{ old('time') }}" required>
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="reason" class="form-label">Reason *</label>
                        <input type="text" name="reason" id="reason"
                               maxlength="200"
                               class="form-control @error('reason') is-invalid @enderror"
                               value="{{ old('reason') }}"
                               placeholder="e.g. General checkup" required>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach (['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $status)
                                <option value="{{ $status }}"
                                    @selected(old('status', 'Pending') === $status)>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes"
                                  rows="3" class="form-control"
                                  placeholder="Additional information (optional)">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Appointment</button>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
