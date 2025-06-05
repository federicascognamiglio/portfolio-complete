@extends('layouts.master')

@section ('pageTitle', 'Create new Project')

@section('content')
<div class="container mt-5">
    <h1 class="mt-5 text-uppercase text-center">Create a new Project</h1>
    <p class="text-muted text-center mb-5">Fields marked with * are mandatory</p>

    <!-- Form -->
    <div class="form">
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Title -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="New Project" required>
                </div>
                <!-- Subtitle -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                        placeholder="Subtitle for new project">
                </div>
                <!-- Client -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="client" class="form-label">Client</label>
                    <input type="text" class="form-control" id="client" name="client" placeholder="Company name">
                </div>
                <!-- Description -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea row=3 class="form-control" id="description" name="description"
                        placeholder="This project is about..."></textarea>
                </div>
                <!-- Start Date -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <!-- End Date -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <!-- Status -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="status" class="form-label">Status*</label>
                    <select name="status" class="form-select" id="status">
                        @foreach (App\ProjectStatus::cases() as $status)
                        <option value="{{ $status->value }}">{{ ($status->label()) }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Categories -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="category">
                        @foreach (App\CategoryEnum::cases() as $category)
                        <option value="{{ $category->categoryId() }}">{{ ($category->label()) }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Types -->
                <div class="col-sm-6 col-md-4 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type_id" class="form-select" id="type">
                        @foreach (App\TypeEnum::cases() as $type)
                        <option value="{{ $type->typeId() }}">{{ ($type->label()) }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Tags -->
                <div class="col-6 mt-4 mb-5">
                    <div class="d-flex align-items-center mb-2">
                        <p class="form-labe mb-0 me-2">Tags:</p>
                        <div id="selected-tags"></div>
                    </div>
                    <!-- Tag modal button -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#tagModal"
                        class="btn btn-sm btn-primary">
                        Select Tags
                    </button>
                </div>
                <!-- Tools -->
                <div class="col-6 mt-4 mb-5">
                    <div class="d-flex align-items-center mb-2">
                        <p class="form-labe mb-0 me-2">Tools:</p>
                        <div id="selected-tools"></div>
                    </div>
                    <!-- Tool modal button -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#toolModal"
                        class="btn btn-sm btn-primary">
                        Select Tools
                    </button>
                </div>
                <!-- Cover Image -->
                <div class="col mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image">
                </div>
            </div>
            <!-- Hidden inputs for selected tags and tools -->
            <div id="hidden-tags-wrapper"></div>
            <div id="hidden-tools-wrapper"></div>
            <!-- Submit -->
            <button type="submit" class="btn btn-primary mt-3">Create Project</button>
        </form>
    </div>
</div>
@endsection

<!-- Modal handle tags -->
@include('partials.tagFormModal')
<!-- Modal handle tools -->
@include('partials.toolFormModal')

@section('scripts')
<!-- Tag handle Script -->
@vite('resources/js/tagForm.js')
<!-- Tool handle Script -->
@vite('resources/js/toolForm.js')
@endsection