@extends('layouts.app')

@section('content')
@php
    $permissions = Auth::user()->role?->permissions->pluck('code')->all() ?? [];
@endphp

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users List</h5>

            @if(in_array('users.create', $permissions))
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                    New User
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

            <form class="navbar-search" method="GET" action="{{ route('users.index') }}">
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
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search by first name, last name, email, or role..." aria-label="Search" name="filter" value="{{ $data->filter }}">
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name ?? '—' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role?->name ?? 'No role' }}</td>

                                <td class="text-nowrap">
                                    @if(in_array('users.edit', $permissions))
                                        <a href="{{ route('users.edit', $user) }}"
                                        class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    @endif

                                    @if(in_array('users.delete', $permissions))
                                        <form action="{{ route('users.delete', $user) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No users registered.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->appends(request()->except('page'))->links('components.custom-pagination') }}
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-secondary mt-2">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
