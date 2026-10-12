@extends('layouts.app')

@section('content')
    <div class="pagetitle">

        <h1>Secciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Secciones</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">

            <div class="card-header">

                <div class="row">
                    <div class="col-md-11">
                        <h3>Secciones</h3>
                    </div>

                    <div class="col-md-1">
                        <a href="{{ route('sections.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sections as $section)

                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>
                                    <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form action="{{ route('sections.delete', $section->id) }}" method="POST" style="display: contents;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>

                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection
