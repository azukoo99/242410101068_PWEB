<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiamondStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.navbar')

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    {{-- KONTEN --}}
    @yield('content')

    <footer class="footer">
    <!-- footer -->
    </footer>

    {{-- Script --}}
    @stack('scripts')

</body>
</html>
