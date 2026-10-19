{{-- resources/views/components/layouts/app.blade.php --}}

{{-- 
    Base HTML layout skeleton used across public marketing pages.
    Usage:
        <x-layouts.app>
            <x-slot:title>Custom Page Title</x-slot:title>
            ...page content...
        </x-layouts.app>
--}}
@props(['title' => null])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Appends product name to title when provided --}}
        <title>{{ $title ? $title.' - QuickPost' : 'QuickPost' }}</title>
        {{-- Bundled CSS & JavaScript assets via Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
    </head>
    <body class="bg-white text-neutral-800 antialiased">
        {{-- Shared public header navbar --}}
        @include('partials.header')

        {{-- Page-specific content slot --}}
        <main>{{ $slot }}</main>

        {{-- Shared public footer --}}
        @include('partials.footer')
    </body>
</html>
