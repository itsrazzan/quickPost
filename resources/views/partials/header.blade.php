{{-- resources/views/partials/header.blade.php --}}
{{-- Desktop layout. Expects named routes: 'home' and 'about'. --}}
@php
    $links = [
        ['label' => 'Home',  'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
    ];
@endphp

<header class="sticky top-4 z-50 px-6">
    {{-- The floating pill stays (it is the page's only glass surface, see DESIGN.md),
         but its definition comes from the border, not a large shadow. --}}
    <nav class="mx-auto flex max-w-5xl items-center justify-between rounded-2xl border border-neutral-200 bg-white/90 px-6 py-3 backdrop-blur"
         aria-label="Main navigation">

        {{-- Logo: a clock, because the product is about when posts go out (see DESIGN.md). --}}
        <a href="{{ route('home') }}"
           class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-neutral-900">
            <span class="grid size-8 place-items-center rounded-lg bg-accent text-white">
                <svg viewBox="0 0 24 24" class="size-4.5" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="8.5"/>
                    <path d="M12 7.5V12l3 2"/>
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
    </nav>
</header>
