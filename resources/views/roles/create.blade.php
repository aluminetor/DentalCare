@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Create Role</h5>
        </div>

        <div class="card-body">

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                {{-- Role information --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="e.g. Administrator"
                            value="{{ old('name') }}"
                            maxlength="50"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">
                            Description
                        </label>

                        <input
                            type="text"
                            id="description"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="e.g. Full access"
                            value="{{ old('description') }}"
                            maxlength="150"
                        >

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <hr>

                {{-- Permissions --}}
                <h6 class="mb-3">Assign Permissions</h6>

                <p class="text-muted small">
                    Select the permissions that this role will have.
                </p>

                @error('permissions')
                    <div class="alert alert-danger py-2">
                        {{ $message }}
                    </div>
                @enderror

                @foreach($modules as $module => $permissions)

                    <div class="card mb-3">

                        <div class="card-header bg-light">
                            <strong>{{ $module }}</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                @foreach($permissions as $permission)

                                    <div class="col-md-6 mb-2">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="permissions[]"
                                                id="permission_{{ $permission->id }}"
                                                value="{{ $permission->id }}"
                                                @checked(in_array($permission->id, old('permissions', [])))
                                            >

                                            <label
                                                class="form-check-label"
                                                for="permission_{{ $permission->id }}"
                                            >
                                                {{ $permission->name }}
                                            </label>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>
                    </div>

                @endforeach

                {{-- Actions --}}
                <div class="mt-4">

                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>

                    <a href="{{ route('roles.index') }}"
                    class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection
