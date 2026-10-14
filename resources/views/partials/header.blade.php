{{-- resources/views/partials/header.blade.php --}}
{{-- Shared public navigation for the landing and About pages. --}}
@php
    $links = [
        ['label' => 'Home', 'route' => 'home'],
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

        <div class="flex items-center gap-4 sm:gap-7">
            <ul class="hidden items-center gap-6 text-sm font-medium sm:flex">
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
            <a href="{{ route('login', ['intent' => 'login']) }}"
               class="text-sm font-semibold text-neutral-700 transition hover:text-accent-strong">
                Login
            </a>
            <a href="{{ route('login', ['intent' => 'signup']) }}"
               class="rounded-xl bg-accent px-3.5 py-2 text-sm font-semibold text-white transition duration-150 hover:-translate-y-0.5 hover:bg-accent-strong focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent sm:px-4">
                Sign up
            </a>
        </div>
    </nav>
</header>
