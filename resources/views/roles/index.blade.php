@extends('layouts.app')

@section('content')
@php
    $permissions = Auth::user()->role?->permissions->pluck('code')->all() ?? [];
@endphp

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Roles List</h5>

            @if(in_array('roles.create', $permissions))
                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                    New Role
                </a>
            @endif
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="GET" action="{{ route('roles.index') }}">
                <div class="row mt-2 mb-3 g-2 align-items-center">

                    <div class="col-md-auto">
                        <select class="form-select bg-light border-0"
                                name="records_per_page"
                                onchange="this.form.submit()">
                            @foreach([2, 10, 15, 30, 50] as $number)
                                <option value="{{ $number }}"
                                    {{ request('records_per_page', 15) == $number ? 'selected' : '' }}>
                                    {{ $number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <div class="input-group">
                            <input type="text"
                                class="form-control bg-light border-0"
                                placeholder="Search by role name or description..."
                                name="filter"
                                value="{{ $data->filter ?? '' }}">

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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description ?? '—' }}</td>
                                <td>{{ $role->users_count }}</td>
                                <td>{{ $role->permissions_count }}</td>

                                <td class="text-nowrap">

                                    @if(in_array('roles.edit', $permissions))
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    @endif

                                    @if(in_array('roles.delete', $permissions))
                                        <form action="{{ route('roles.delete', $role->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this role?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No roles registered.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $roles->appends(request()->except('page'))->links('components.custom-pagination') }}
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-2">
                Back
            </a>

        </div>
    </div>
</div>
@endsection
