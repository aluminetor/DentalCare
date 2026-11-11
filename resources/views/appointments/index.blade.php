@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Appointments List</h5>
            <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm">
                New Appointment
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="navbar-search" method="GET" action="{{ route('appointments.index') }}">
                <div class="row mt-2 mb-3 g-2 align-items-center">
                    <div class="col-md-auto">
                        <select class="form-select bg-light border-0 small" name="records_per_page">
                            <option {{ $data->records_per_page == 2 ? 'selected' : '' }} value="2">2</option>
                            <option {{ $data->records_per_page == 10 ? 'selected' : '' }} value="10">10</option>
                            <option {{ $data->records_per_page == 15 ? 'selected' : '' }} value="15">15</option>
                            <option {{ $data->records_per_page == 30 ? 'selected' : '' }} value="30">30</option>
                            <option {{ $data->records_per_page == 50 ? 'selected' : '' }} value="50">50</option>
                        </select>
                    </div>

                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search by patient, dentist, reason, status, or date..." aria-label="Search" name="filter" value="{{ $data->filter }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Dentist</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr>
                                <td>
                                    {{ $appointment->patient->first_name ?? 'No patient' }}
                                    {{ $appointment->patient->last_name ?? '' }}
                                </td>

                                <td>
                                    {{ $appointment->dentist->name ?? 'No dentist' }}
                                    {{ $appointment->dentist->last_name ?? '' }}
                                </td>

                                <td>{{ $appointment->date->format('d/m/Y') }}</td>
                                <td>{{ substr($appointment->time, 0, 5) }}</td>
                                <td>{{ $appointment->reason }}</td>

                                <td>
                                    @php
                                        $colors = [
                                            'Pending' => 'warning',
                                            'Confirmed' => 'primary',
                                            'Completed' => 'success',
                                            'Cancelled' => 'danger',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $colors[$appointment->status] ?? 'secondary' }}">
                                        {{ $appointment->status }}
                                    </span>
                                </td>

                                <td class="text-nowrap">
                                    <a href="{{ route('appointments.edit', $appointment->id) }}"
                                    class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('appointments.delete', $appointment->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No appointments registered.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $appointments->appends(request()->except('page'))->links('components.custom-pagination') }}

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
