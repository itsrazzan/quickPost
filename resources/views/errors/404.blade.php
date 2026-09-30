{{-- resources/views/errors/404.blade.php --}}
{{-- Laravel shows this file automatically for any 404 (unknown URL, abort(404), missing model). --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page not found - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-neutral-100 text-neutral-800 antialiased">
        @include('partials.header')

        <main class="mx-auto max-w-5xl px-6 pt-20">
            <div class="mx-auto max-w-xl rounded-3xl bg-white px-12 py-14 text-center shadow-[0_20px_60px_rgba(0,0,0,0.10)]">
                <p class="text-8xl font-bold tracking-tight text-neutral-900">404</p>

                <h1 class="mt-4 text-2xl font-bold tracking-tight text-neutral-900">
                    Page not found
                </h1>
                <p class="mx-auto mt-3 max-w-sm leading-relaxed text-neutral-600">
                    This address doesn't exist or the page has moved.
                    Check the URL for typos, or head back to the home page.
                </p>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <x-button href="{{ route('home') }}" class="px-6 py-3">Back to home</x-button>
                    <x-button variant="light" href="{{ route('about') }}" class="px-6 py-3">About QuickPost</x-button>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>
