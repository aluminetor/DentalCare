@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Create Role</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="e.g. Administrator">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" placeholder="e.g. Full access">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Form validation / jQuery scripts
    </script>
@endpush
