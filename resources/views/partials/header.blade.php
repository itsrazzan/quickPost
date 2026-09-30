{{-- resources/views/partials/header.blade.php --}}
{{-- Desktop layout. Expects named routes: 'home' and 'about'. --}}
@php
    $links = [
        ['label' => 'Home',  'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
    ];
@endphp

<header class="sticky top-4 z-50 px-6">
    <nav class="mx-auto flex max-w-5xl items-center justify-between rounded-2xl bg-white/90 px-6 py-3
                shadow-[0_8px_30px_rgba(0,0,0,0.08)] backdrop-blur"
         aria-label="Main navigation">

        {{-- Logo --}}
        <a href="{{ route('home') }}"
           class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-neutral-900">
            <span class="grid size-8 place-items-center rounded-lg bg-accent text-white">
                <svg viewBox="0 0 24 24" class="size-4.5" fill="currentColor" aria-hidden="true">
                    <path d="M13 2 4 14h6l-1 8 9-12h-6l1-8Z"/>
                </svg>
            </span>
            QuickPost
        </a>

        {{-- Links --}}
        <ul class="flex items-center gap-8 text-sm font-medium">
            @foreach ($links as $link)
                @php $active = request()->routeIs($link['route']); @endphp
                <li>
                    <a href="{{ route($link['route']) }}"
                       @if ($active) aria-current="page" @endif
                       class="transition {{ $active
                            ? 'text-neutral-900 underline decoration-accent decoration-2 underline-offset-8'
                            : 'text-neutral-600 hover:text-neutral-900' }}">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Call to action (placeholder link until a "create post" page exists) --}}
        <x-button href="#">Get Started</x-button>
    </nav>
</header>
