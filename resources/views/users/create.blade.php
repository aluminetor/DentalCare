@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Create User</h5>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">First Name *</label>
                        <input type="text" name="name" id="name"
                            class="form-control"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" name="last_name" id="last_name"
                            class="form-control"
                            value="{{ old('last_name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" name="email" id="email"
                            class="form-control"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control"
                            value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="specialty" class="form-label">Specialty</label>
                        <input type="text" name="specialty" id="specialty"
                            class="form-control"
                            value="{{ old('specialty') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Role *</label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <option value="">Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="password" id="password"
                            class="form-control" minlength="8" required>
                        <small class="text-muted">Minimum 8 characters.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password *
                        </label>
                        <input type="password" name="password_confirmation"
                            id="password_confirmation"
                            class="form-control" minlength="8" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save User</button>
                <a href="{{ route('users.index') }}"
                class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
