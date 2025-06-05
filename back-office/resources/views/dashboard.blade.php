@extends('layouts.master')

@section('content')
<div class="container mt-5 d-flex flex-column align-items-center">
    <h4 class="mt-5 fs-5">You logged-in successfully!</h4>
    <h2 class="text-uppercase mt-3">Welcome to the Portfolio admin page</h2>
    <p class="mb-4">Here you'll be able to handle your projects and manage your portfolio content. </p>
    <a href="/projects" class="btn btn-primary">View projects</a>
</div>
@endsection
