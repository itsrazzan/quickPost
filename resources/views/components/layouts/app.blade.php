{{-- resources/views/components/layouts/app.blade.php --}}
{{-- Base skeleton shared by every page. Usage:
     <x-layouts.app><x-slot:title>About</x-slot:title> ...content... </x-layouts.app> --}}
@props(['title' => null])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ? $title.' - QuickPost' : 'QuickPost' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
    </head>
    <body class="bg-white text-neutral-800 antialiased">
        @include('partials.header')
        <main>{{ $slot }}</main>
        @include('partials.footer')
    </body>
</html>
