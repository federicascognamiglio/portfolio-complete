@extends('layouts.master')

@section ('pageTitle', 'My Projects')

@section('content')
@include('partials.alerts')
<div class="container mt-5">
    <!-- Title -->
    <h1 class="mt-5 text-center text-uppercase">My Projects</h1>

    <!-- Create Project Button -->
    <div class="text-center mt-3 mb-5">
        <a href="{{ route('projects.create') }}" class="btn btn-outline-primary">Create New Project</a>
    </div>

    <!-- Status Filters -->
    <div class="mb-4 text-center">
        <a href="{{ route('projects.index') }}"
            class="btn btn-sm btn-outline-secondary {{ request('status') == null ? 'active' : '' }}">
            All
        </a>
        <a href="{{ route('projects.index', ['status' => 'published']) }}"
            class="btn btn-sm btn-outline-secondary {{ request('status') == 'published' ? 'active' : '' }}">
            Published
        </a>
        <a href="{{ route('projects.index', ['status' => 'draft']) }}"
            class="btn btn-sm btn-outline-secondary {{ request('status') == 'draft' ? 'active' : '' }}">
            Draft
        </a>
        <a href="{{ route('projects.index', ['status' => 'archived']) }}"
            class="btn btn-sm btn-outline-secondary {{ request('status') == 'archived' ? 'active' : '' }}">
            Archived
        </a>
    </div>

    <!-- Projects Table -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th scope="col text-uppercase">Title</th>
                <th scope="col text-uppercase">Client</th>
                <th scope="col text-uppercase">Category</th>
                <th scope="col text-uppercase">Status</th>
                <th scope="col text-uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>
                    @if ($project->client)
                    {{ $project->client }}
                    @else
                    Personal Project
                    @endif
                </td>
                <td>{{ $project->category['name'] }}</td>
                <td class="text-capitalize">{{ $project->status }}</td>
                <td>
                    <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-outline-primary me-2">View</a>
                    <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection