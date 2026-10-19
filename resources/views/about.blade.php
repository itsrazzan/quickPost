{{-- resources/views/about.blade.php --}}

{{-- 
    Define mock view data. In a production app, these arrays 
    would typically be passed from a controller.
--}}
@php
    // Project technology stack
    $stack = ['Laravel', 'Blade', 'Tailwind CSS', 'Vite'];

    // Feature development roadmap
    $progress = [
        ['task' => 'Header, footer, and home page', 'status' => 'done'],
        ['task' => 'About page and custom 404 page', 'status' => 'done'],
        ['task' => 'Create-post form',               'status' => 'next'],
        ['task' => 'Publishing to real platforms',   'status' => 'later'],
    ];

    // Status-to-Tailwind color mapping for dynamic badge styling
    $progressStyles = [
        'done'  => 'bg-emerald-50 text-emerald-700',
        'next'  => 'bg-amber-50 text-amber-700',
        'later' => 'bg-neutral-100 text-neutral-500',
    ];

    // FAQ items
    $faqs = [
        ['q' => 'Is QuickPost a real product?',
         'a' => 'Not yet. It is a learning project for now, built to practice Laravel and Blade.'],
        ['q' => 'Which platforms does it support?',
         'a' => 'None yet. The pages you see are the interface only; nothing is published anywhere.'],
        ['q' => 'What is it built with?',
         'a' => 'Laravel for the backend, Blade for the views, and Tailwind CSS for the styling.'],
    ];
@endphp

{{-- 
    Base layout component (resources/views/components/layouts/app.blade.php).
    Content inside is injected into the layout's $slot variable.
--}}
<x-layouts.app>
    {{-- Named slot: passes the page title into the layout's <title> tag --}}
    <x-slot:title>About</x-slot:title>

    {{-- Intro / Hero section --}}
    <section class="mx-auto max-w-5xl px-6 pt-20">
        <h1 class="max-w-3xl text-5xl font-light leading-[1.1] tracking-tight text-balance text-neutral-900">
            A scheduler for social posts, built to learn Laravel
        </h1>
        <p class="mt-6 max-w-2xl text-lg leading-relaxed text-neutral-600">
            QuickPost explores one idea: write a post once, choose the platforms,
            and set when it goes out.
        </p>
    </section>

    {{-- 
        Two-column grid section:
        Left column (col-span-3) for context, right column (col-span-2) for tech stack pills.
    --}}
    <section class="mx-auto mt-16 grid max-w-5xl grid-cols-5 gap-6 px-6">
        <div class="col-span-3 rounded-2xl border border-neutral-200 bg-white p-8">
            <h2 class="text-xl font-semibold text-neutral-900">Why it exists</h2>
            <p class="mt-3 leading-relaxed text-neutral-600">
                Managing several social accounts means repeating the same steps in every app.
                This project tests how one interface could handle writing, choosing platforms,
                and scheduling in a single place.
            </p>
            <p class="mt-3 leading-relaxed text-neutral-600">
                It is also a course assignment, so the code is written to be read and understood,
                not only to work.
            </p>
        </div>

        {{-- Tech stack pills --}}
        <div class="col-span-2 rounded-2xl border border-neutral-200 bg-white p-8">
            <h2 class="text-xl font-semibold text-neutral-900">Built with</h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                @foreach ($stack as $tool)
                    <li class="rounded-full bg-neutral-100 px-3.5 py-1.5 text-sm font-medium text-neutral-700">
                        {{ $tool }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Progress roadmap list --}}
    <section class="mx-auto mt-16 max-w-5xl px-6">
        <h2 class="text-2xl font-semibold tracking-tight text-neutral-900">Where the project is</h2>

        <ul class="mt-6 divide-y divide-neutral-100 rounded-2xl border border-neutral-200 bg-white px-8">
            @foreach ($progress as $item)
                <li class="flex items-center justify-between py-4">
                    <span class="text-neutral-800">{{ $item['task'] }}</span>
                    {{-- Dynamic badge color lookup and capitalized status label --}}
                    <span class="rounded-full px-3 py-1 text-xs font-medium {{ $progressStyles[$item['status']] }}">
                        {{ ucfirst($item['status']) }}
                    </span>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- FAQ: native HTML5 <details> & <summary> accordion (zero JavaScript required) --}}
    <section class="mx-auto mt-16 max-w-5xl px-6">
        <h2 class="text-2xl font-semibold tracking-tight text-neutral-900">Questions</h2>

        <div class="mt-6 space-y-3">
            @foreach ($faqs as $faq)
                {{-- 'group' class allows styling child elements on parent state (group-open:...) --}}
                <details class="group rounded-2xl border border-neutral-200 bg-white px-8 py-5">
                    {{-- Clickable summary header; hides native browser triangle marker --}}
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 font-medium text-neutral-900
                                    focus-visible:outline-3 focus-visible:outline-offset-4 focus-visible:outline-accent
                                    [&::-webkit-details-marker]:hidden">
                        {{ $faq['q'] }}
                        {{-- SVG arrow icon rotates 180 deg when the details panel opens --}}
                        <svg viewBox="0 0 24 24" class="size-5 shrink-0 text-neutral-500 transition group-open:rotate-180"
                             fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </summary>
                    <p class="mt-3 leading-relaxed text-neutral-600">{{ $faq['a'] }}</p>
                </details>
            @endforeach
        </div>
    </section>
</x-layouts.app>
