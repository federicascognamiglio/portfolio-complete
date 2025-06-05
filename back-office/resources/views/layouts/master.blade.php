<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <header>
        @include('partials.header')
    </header>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>