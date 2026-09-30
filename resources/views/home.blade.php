<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.header')
        <main>
           {{-- @include('welcome') --}}
           @php
    // Dummy data. Later, move these arrays into a controller and pass them with view('welcome', compact(...)).
    $posts = [
        ['text' => 'We just shipped our new landing page.', 'platforms' => ['Instagram', 'LinkedIn'], 'time' => 'Today, 15:00',    'status' => 'scheduled'],
        ['text' => 'Behind the scenes from this week.',     'platforms' => ['Instagram'],             'time' => 'Yesterday, 09:30', 'status' => 'published'],
        ['text' => 'Quick tip: plan your week on Sunday.',  'platforms' => ['X', 'LinkedIn'],         'time' => 'Mon, 18:45',       'status' => 'failed'],
    ];

    $statusStyles = [
        'scheduled' => 'bg-amber-50 text-amber-700',
        'published' => 'bg-emerald-50 text-emerald-700',
        'failed'    => 'bg-red-50 text-red-700',
    ];

    $features = [
        ['title' => 'Write once',      'text' => 'Draft a post in one editor instead of opening every app.'],
        ['title' => 'Choose platforms', 'text' => 'Pick where each post goes before you schedule it.'],
        ['title' => 'Pick a time',      'text' => 'Plan ahead and see everything coming up in one list.'],
    ];
@endphp

{{-- Hero --}}
<section class="mx-auto max-w-5xl px-6 pt-20 text-center">
    <h1 class="mx-auto max-w-3xl text-6xl font-bold leading-[1.05] tracking-tight text-balance text-neutral-900">
        Schedule your social posts from one place
    </h1>
    <p class="mx-auto mt-6 max-w-xl text-lg text-neutral-600">
        Write a post once, choose the platforms, and set when it goes out.
    </p>

    <div class="mt-9 flex items-center justify-center gap-4">
        <x-button href="#" class="px-7 py-3.5 text-base">Get Started</x-button>
        <x-button variant="light" href="{{ route('about') }}" class="px-7 py-3.5 text-base">Learn More</x-button>
    </div>
</section>

{{-- Dashboard mockup --}}
<section class="mx-auto mt-16 max-w-5xl px-6">
    <div class="grid grid-cols-5 gap-6 rounded-3xl bg-white/70 p-6 shadow-[0_20px_60px_rgba(0,0,0,0.10)]">

        {{-- Composer --}}
        <div class="col-span-2 rounded-2xl bg-white p-5 shadow-[0_6px_18px_rgba(0,0,0,0.06)]">
            <h2 class="text-sm font-semibold text-neutral-900">New post</h2>

            <div class="mt-4 h-28 rounded-xl bg-neutral-100 p-3 text-sm text-neutral-400">
                What do you want to share?
            </div>

            <div class="mt-4 flex gap-2 text-xs font-medium">
                <span class="rounded-full border-2 border-accent px-3 py-1 text-neutral-800">Instagram</span>
                <span class="rounded-full border-2 border-accent px-3 py-1 text-neutral-800">LinkedIn</span>
                <span class="rounded-full border-2 border-neutral-200 px-3 py-1 text-neutral-500">X</span>
            </div>

            <div class="mt-5 flex items-center justify-between">
                <span class="text-xs text-neutral-500">Today, 15:00</span>
                <span class="rounded-lg bg-neutral-900 px-4 py-2 text-xs font-semibold text-white">Schedule</span>
            </div>
        </div>

        {{-- Post list --}}
        <div class="col-span-3 rounded-2xl bg-white p-5 shadow-[0_6px_18px_rgba(0,0,0,0.06)]">
            <h2 class="text-sm font-semibold text-neutral-900">Your posts</h2>

            <ul class="mt-4 divide-y divide-neutral-100">
                @forelse ($posts as $post)
                    <li class="flex items-center justify-between gap-4 py-3.5">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-neutral-800">{{ $post['text'] }}</p>
                            <p class="mt-1 text-xs text-neutral-500">
                                {{ implode(', ', $post['platforms']) }} &middot; {{ $post['time'] }}
                            </p>
                        </div>
                        <span class="shrink-0 rounded-full px-3 py-1 text-xs font-medium {{ $statusStyles[$post['status']] }}">
                            {{ ucfirst($post['status']) }}
                        </span>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-neutral-500">
                        No posts yet. Write your first one to see it here.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="mx-auto mt-24 max-w-5xl px-6">
    <h2 class="max-w-xl text-3xl font-bold tracking-tight text-neutral-900">
        Less switching between apps, more time to write
    </h2>

    <div class="mt-10 grid grid-cols-3 gap-6">
        @foreach ($features as $feature)
            <div class="rounded-2xl bg-white p-7 shadow-[0_8px_30px_rgba(0,0,0,0.06)]">
                <h3 class="text-lg font-semibold text-neutral-900">{{ $feature['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-neutral-600">{{ $feature['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- Closing call to action --}}
<section class="mx-auto mt-24 max-w-5xl px-6">
    <div class="flex items-center justify-between gap-8 rounded-3xl bg-neutral-900 px-10 py-12">
        <h2 class="max-w-md text-3xl font-bold tracking-tight text-white">
            Schedule your first post today
        </h2>
        <x-button variant="light" href="#" class="px-7 py-3.5 text-base">Get Started</x-button>
    </div>
</section>
        </main>
        @include('partials.footer')
    </body>
</html>