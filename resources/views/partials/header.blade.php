{{-- resources/views/partials/header.blade.php --}}
{{-- Floating glass pill: the page's only frosted surface (DESIGN.md).
     Expects named routes: 'home' and 'about'. --}}
@php
    $links = [
        ['label' => 'Home',  'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
    ];
@endphp

<header class="sticky top-4 z-50 px-5 sm:px-8">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between rounded-full border border-neutral-200 bg-white/90 py-3 pl-6 pr-3 shadow-nav backdrop-blur"
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

        {{-- Desktop links + CTA --}}
        <div class="flex items-center gap-2">
            <ul class="hidden items-center gap-7 text-sm font-medium md:flex">
                @foreach ($links as $link)
                    @php $active = request()->routeIs($link['route']); @endphp
                    <li>
                        <a href="{{ route($link['route']) }}"
                           @if ($active) aria-current="page" @endif
                           class="transition duration-150 ease-ui {{ $active
                                ? 'text-neutral-900 underline decoration-accent decoration-2 underline-offset-8'
                                : 'text-neutral-600 hover:text-neutral-900' }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Placeholder CTA: about is the honest destination until a real signup exists. --}}
            <x-button href="{{ route('about') }}" class="hidden px-5 py-2.5 sm:inline-flex">Get started</x-button>

            <button type="button"
                    data-menu-button
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    class="group grid size-11 place-items-center rounded-full text-neutral-800 transition duration-150 ease-ui hover:bg-neutral-100 active:scale-[.96] focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent md:hidden">
                <span class="sr-only">Toggle navigation</span>
                <svg viewBox="0 0 24 24" class="size-5 group-aria-expanded:hidden" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
                <svg viewBox="0 0 24 24" class="hidden size-5 group-aria-expanded:block" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div id="mobile-menu"
         data-menu-panel
         hidden
         class="mx-auto mt-2 max-w-7xl rounded-3xl border border-neutral-200 bg-white/95 p-4 shadow-nav backdrop-blur md:hidden">
        <ul class="flex flex-col text-sm font-medium">
            @foreach ($links as $link)
                @php $active = request()->routeIs($link['route']); @endphp
                <li>
                    <a href="{{ route($link['route']) }}"
                       @if ($active) aria-current="page" @endif
                       class="block rounded-2xl px-4 py-3 transition duration-150 ease-ui {{ $active
                            ? 'bg-accent-pale text-neutral-900'
                            : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900' }}">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <x-button href="{{ route('about') }}" class="mt-2 w-full px-5 py-3">Get started</x-button>
    </div>
</header>
