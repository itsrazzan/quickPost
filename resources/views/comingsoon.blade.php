{{-- resources/views/comingsoon.blade.php --}}
{{-- Shared placeholder for pages that have no design yet: program, ourteam, contactus. --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page }} - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-neutral-100 text-neutral-800 antialiased">
        @include('partials.header')

        <main class="mx-auto max-w-5xl px-6 pt-20">
            <div class="mx-auto max-w-xl rounded-3xl border border-neutral-200 bg-white px-12 py-14 text-center">
                <h1 class="text-3xl font-bold tracking-tight text-neutral-900">
                    {{ $page }} is coming soon
                </h1>
                <p class="mx-auto mt-3 max-w-sm leading-relaxed text-neutral-600">
                    This page does not exist yet. QuickPost is a learning project,
                    built one page at a time.
                </p>

                <div class="mt-8">
                    <x-button href="{{ route('home') }}" class="px-6 py-3">Back to home</x-button>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>
