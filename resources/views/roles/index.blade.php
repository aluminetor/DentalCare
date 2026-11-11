@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Roles List</h5>
                <a href="#" class="btn btn-primary btn-sm">New Role</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Administrator</td>
                                <td>Full system access</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // SweetAlert2 listener for .btn-delete
    </script>
@endpush
