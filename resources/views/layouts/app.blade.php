<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- OPTIONAL (online) font – comment out for offline use --}}
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    {{-- If you STILL want to keep Vite when available, leave this safe-guarded block.
         It will only run when the build manifest exists. Otherwise it’s skipped. --}}
    @php $viteManifest = public_path('build/manifest.json'); @endphp
    @if (file_exists($viteManifest))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    {{-- Page/feature styles (Bootstrap/DataTables, etc.) --}}
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Page Content --}}
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- Page/feature scripts (jQuery/DT/Swal/Bootstrap, etc.) --}}
    @stack('scripts')
</body>
</html>
