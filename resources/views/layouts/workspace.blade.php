@php
    $workspaceLinks = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'dashboard'],
        ['label' => 'Analytics', 'route' => 'analytics', 'icon' => 'analytics'],
        ['label' => 'Calendar', 'route' => 'calendar', 'icon' => 'calendar'],
        ['label' => 'Drafts', 'route' => 'drafts', 'icon' => 'drafts'],
        ['label' => 'Media library', 'route' => 'media-library', 'icon' => 'media'],
        ['label' => 'My settings', 'route' => 'settings', 'icon' => 'settings'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
    </head>
    <body class="min-h-screen bg-neutral-100 text-neutral-800 antialiased">
        <header class="sticky top-0 z-20 border-b border-neutral-200 bg-white">
            <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('dashboard') }}"
                   class="flex shrink-0 items-center gap-2.5 text-lg font-bold tracking-tight text-neutral-900">
                    <span class="grid size-8 place-items-center rounded-lg bg-accent text-white">
                        <svg viewBox="0 0 24 24" class="size-4.5" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="8.5"/>
                            <path d="M12 7.5V12l3 2"/>
                        </svg>
                    </span>
                    QuickPost
                </a>

                <div class="flex items-center gap-3 sm:gap-5">
                    <a href="{{ route('settings') }}"
                       class="flex items-center gap-2.5 rounded-xl px-2 py-1.5 transition hover:bg-neutral-100">
                        <span class="grid size-8 place-items-center rounded-full bg-orange-100 text-xs font-semibold text-accent-strong">
                            AR
                        </span>
                        <span class="hidden text-sm font-semibold text-neutral-800 sm:block">
                            {{ session('demo_user_name', 'Agil Razzan') }}
                        </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="rounded-lg px-2.5 py-2 text-sm font-medium text-neutral-600 transition hover:bg-neutral-100 hover:text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            Log out
                        </button>
                    </form>
                </div>
            </div>

            <nav class="flex gap-1 overflow-x-auto border-t border-neutral-200 px-3 py-2 md:hidden"
                 aria-label="Workspace navigation">
                @foreach ($workspaceLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       @if (request()->routeIs($link['route'])) aria-current="page" @endif
                       class="shrink-0 rounded-lg px-3 py-2 text-sm font-medium transition
                       {{ request()->routeIs($link['route'])
                            ? 'bg-orange-50 text-accent-strong'
                            : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </header>

        <div class="mx-auto flex max-w-[1600px] gap-8 px-4 py-5 sm:px-6 sm:py-8 lg:px-8">
            <aside class="hidden w-60 shrink-0 md:block" aria-label="Workspace navigation">
                <div class="sticky top-24">
                    <div class="mb-6 rounded-2xl border border-neutral-200 bg-white p-4">
                        <p class="text-xs font-medium text-neutral-500">Workspace</p>
                        <p class="mt-1 font-semibold text-neutral-900">QuickPost studio</p>
                        <p class="mt-1 text-xs text-neutral-500">Personal workspace</p>
                    </div>

                    <nav aria-label="Main navigation">
                        <p class="mb-2 px-3 text-xs font-semibold text-neutral-500">MENU</p>
                        <ul class="space-y-1">
                            @foreach ($workspaceLinks as $link)
                                @php($active = request()->routeIs($link['route']))
                                <li>
                                    <a href="{{ route($link['route']) }}"
                                       @if ($active) aria-current="page" @endif
                                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                                       {{ $active
                                            ? 'bg-white text-neutral-900'
                                            : 'text-neutral-600 hover:bg-white hover:text-neutral-900' }}">
                                        <span class="{{ $active ? 'text-accent-strong' : 'text-neutral-500' }}">
                                            @switch($link['icon'])
                                                @case('dashboard')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                        <rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/>
                                                        <rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/>
                                                        <rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/>
                                                        <rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>
                                                    </svg>
                                                    @break
                                                @case('analytics')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                        <path d="M4 20h16M7 16v-4M12 16V5M17 16V9"/>
                                                    </svg>
                                                    @break
                                                @case('calendar')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                        <rect x="3.5" y="5" width="17" height="15.5" rx="2"/>
                                                        <path d="M7.5 3.5v3M16.5 3.5v3M3.5 9.5h17"/>
                                                    </svg>
                                                    @break
                                                @case('drafts')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                        <path d="M5 3.5h9l5 5v12H5zM14 3.5v5h5M8 13h8M8 16.5h6"/>
                                                    </svg>
                                                    @break
                                                @case('media')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                        <rect x="3.5" y="4.5" width="17" height="15" rx="2"/>
                                                        <circle cx="9" cy="10" r="1.5"/>
                                                        <path d="m4 17 5-4 3 2 4-5 4 4"/>
                                                    </svg>
                                                    @break
                                                @case('settings')
                                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                        <circle cx="12" cy="8" r="3.5"/>
                                                        <path d="M5 20c.8-3.1 3.3-5 7-5s6.2 1.9 7 5"/>
                                                    </svg>
                                                    @break
                                            @endswitch
                                        </span>
                                        {{ $link['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                    <div class="mt-8 rounded-2xl border border-neutral-200 bg-white p-4">
                        <p class="text-sm font-semibold text-neutral-900">Demo workspace</p>
                        <p class="mt-1 text-xs leading-relaxed text-neutral-500">
                            Pages are previews. Your changes are not saved to a database.
                        </p>
                    </div>
                </div>
            </aside>

            <main class="min-w-0 flex-1">
                <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-sm font-medium text-accent-strong">@yield('eyebrow', 'Workspace')</p>
                        <h1 class="mt-1 text-3xl font-bold tracking-tight text-neutral-900">@yield('page-title')</h1>
                        <p class="mt-2 text-sm text-neutral-600">@yield('page-description')</p>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-full border border-neutral-200 bg-white px-3 py-1.5 text-xs font-medium text-neutral-600">
                        Demo preview
                    </span>
                </div>

                @yield('content')
            </main>
        </div>
    </body>
</html>
