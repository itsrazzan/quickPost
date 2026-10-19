{{-- resources/views/partials/header.blade.php --}}

{{-- 
    Navigation links configuration:
    - 'route': targets a Laravel named route (e.g. 'home', 'about').
    - 'href': targets an in-page anchor section (e.g. '#features').
--}}
@php
    $links = [
        ['label' => 'Home',     'route' => 'home'],
        ['label' => 'About',    'route' => 'about'],
        ['label' => 'Features', 'href'  => route('home').'#features'],
        ['label' => 'Pricing',  'href'  => route('home').'#pricing'],
    ];
@endphp

{{-- Floating sticky navbar with frosted glass (backdrop-blur) --}}
<header class="sticky top-4 z-50 px-5 sm:px-8">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between rounded-full border border-neutral-200 bg-white/90 py-3 pl-6 pr-3 shadow-nav backdrop-blur"
         aria-label="Main navigation">

        {{-- Brand logo --}}
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

        {{-- Desktop navigation + action button --}}
        <div class="flex items-center gap-2">
            <ul class="hidden items-center gap-7 text-sm font-medium md:flex">
                @foreach ($links as $link)
                    {{-- Check if current URL matches the link's named route --}}
                    @php $active = isset($link['route']) && request()->routeIs($link['route']); @endphp
                    <li>
                        {{-- 
                            Render link: apply aria-current="page" and active underline when active,
                            otherwise apply neutral hover styles.
                        --}}
                        <a href="{{ $link['href'] ?? route($link['route']) }}"
                           @if ($active) aria-current="page" @endif
                           class="transition duration-150 ease-ui {{ $active
                                ? 'text-neutral-900 underline decoration-accent decoration-2 underline-offset-8'
                                : 'text-neutral-600 hover:text-neutral-900' }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Call-to-action button --}}
            <x-button size="sm" href="{{ route('login', ['intent' => 'signup']) }}" class="hidden sm:inline-flex">Get started</x-button>

            {{-- Mobile hamburger button: toggles between menu icon and close icon via group-aria-expanded --}}
            <button type="button"
                    data-menu-button
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    class="group grid size-11 place-items-center rounded-full text-neutral-800 transition duration-150 ease-ui hover:bg-neutral-100 active:scale-[.96] focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent md:hidden">
                <span class="sr-only">Toggle navigation</span>
                {{-- Hamburger icon (visible when closed) --}}
                <svg viewBox="0 0 24 24" class="size-5 group-aria-expanded:hidden" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
                {{-- Close icon (visible when opened) --}}
                <svg viewBox="0 0 24 24" class="hidden size-5 group-aria-expanded:block" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile dropdown menu: hidden by default, toggled via JS using data-menu-panel --}}
    <div id="mobile-menu"
         data-menu-panel
         hidden
         class="mx-auto mt-2 max-w-7xl rounded-3xl border border-neutral-200 bg-white/95 p-4 shadow-nav backdrop-blur md:hidden">
        <ul class="flex flex-col text-sm font-medium">
            @foreach ($links as $link)
                @php $active = isset($link['route']) && request()->routeIs($link['route']); @endphp
                <li>
                    <a href="{{ $link['href'] ?? route($link['route']) }}"
                       @if ($active) aria-current="page" @endif
                       class="block rounded-2xl px-4 py-3 transition duration-150 ease-ui {{ $active
                            ? 'bg-accent-pale text-neutral-900'
                            : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900' }}">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <x-button href="{{ route('login', ['intent' => 'signup']) }}" class="mt-2 w-full">Get started</x-button>
    </div>
</header>
