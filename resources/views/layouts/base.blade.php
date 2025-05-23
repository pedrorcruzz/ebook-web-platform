<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
</head>

<body>
    <header>
        @include('layouts.header')
    </header>

    <main>
        @yield('content')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>
</body>

</html>
