@extends('layouts.master')

@section ('pageTitle', $project->title)

@section ('content')
@include('partials.alerts')
<div class="container mt-5 mb-5">
    <!-- BreadCrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>
    </nav>
    <!-- Project Title and subtitle -->
    <h2 class="text-uppercase text-center mt-4">{{ $project->title }}</h2>
    <p class="text-body-secondary text-center">{{ $project->subtitle }}</p>
    <div class="d-flex flex-column align-items-center">
        <span class="badge text-bg-primary mb-4">{{ $project->category['name'] }} - {{ $project->type['name'] }}</span>
        <!-- Project Cover Image -->
        @if ($project->cover_image)
        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="mb-5" style="max-height: 500px">
        @endif
        <!-- Project Details -->
        <div class="d-flex justify-content-between w-100">
            <div>
                <p class="text-muted text-capitalize">Status: {{ $project->status }}</p>
                <p class="text-muted">Client: {{ $project->client ? $project->client : 'Personal project'}}</p>
            </div>
            @if ($project->start_date)
            <div>
                <p class="text-muted">Started on {{ $project->start_date }}</p>
                <p class="text-muted">Ended on
                    {{ $project->end_date ? $project->end_date : 'On going' }}</p>
            </div>
            @endif
        </div>
    </div>
    <!-- Project Tags -->
    <div class="d-flex align-items-center mb-2">
        <p class="mb-0 me-2">Tags:</p>
        @if (count($project->tags) > 0)
        @foreach ($project->tags as $tag)
        <span class="badge rounded-pill me-2" style="background-color: {{ $tag->color }} ">{{ $tag->name }}</span>
        @endforeach
        @else
        <span>No tags</span>
        @endif
    </div>
    <!-- Project Tools -->
    <div class="d-flex align-items-center mb-2">
        <p class="mb-0 me-2">Tools:</p>
        @if (count($project->tools) > 0)
        @foreach ($project->tools as $tool)
        <span class="badge rounded-pill text-bg-dark me-2">{{ $tool->name }}</span>
        @endforeach
        @else
        <span>No tools</span>
        @endif
    </div>
    <!-- Project Description -->
    <p class="text-capitalize align-self-start mb-1 mt-3"><strong>description</strong></p>
    <p class="mb-5">{{ $project->description }}</p>
    <!-- Project Media -->
    <div class="col mb-3">
        <h3 class="text-center mb-3">Uploaded Media</h3>
        <div class="d-flex flex-column align-items-center">
            <!-- Media modal button -->
            <button type="button" data-bs-toggle="modal" data-bs-target="#mediaModal"
                class="btn btn-sm btn-primary mb-4">
                Add Media
            </button>
            <!-- Media Carousel -->
            @if (count($project->media) > 0)
            <div id="carouselMedia" class="carousel slide mb-4" style="height: 600px; width: 600px">
                <div class="carousel-inner w-100 h-100">
                    @foreach ($project->media as $media)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }} w-100 h-100">
                        <img src="{{ asset('storage/' . $media->url) }}" class="d-block w-100 h-100"
                            alt="{{ $media->description ?? $project->title }}"
                            style="object-fit: cover">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMedia"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMedia"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @endif
        </div>
    </div>

    <!-- Project Actions -->
    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">All Projects</a>
        <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-outline-warning">Edit</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Delete
        </button>
    </div>

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The project "{{ $project->title }}" will be <strong>permanently deleted</strong>. Are you sure you
                    want to proceed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal handle media -->
@include('partials.mediaFormModal')

@section('scripts')
<!-- Media handle Script -->
@vite('resources/js/mediaForm.js')
@endsection