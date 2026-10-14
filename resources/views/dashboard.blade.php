@php
    $monthStart = now()->startOfMonth();
    $calendarDays = array_merge(
        array_fill(0, $monthStart->dayOfWeek, null),
        range(1, $monthStart->daysInMonth),
    );
    $calendarDays = array_pad($calendarDays, (int) ceil(count($calendarDays) / 7) * 7, null);

    $navigation = [
        ['label' => 'Dashboard', 'available' => true],
        ['label' => 'Publishing', 'available' => false],
        ['label' => 'Drafts', 'available' => false],
        ['label' => 'Media library', 'available' => false],
        ['label' => 'Analytics', 'available' => false],
        ['label' => 'Settings', 'available' => false],
    ];

    $weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-neutral-100 text-neutral-800 antialiased">
        <header class="border-b border-neutral-200 bg-neutral-100">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8">
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

                <a href="{{ route('about') }}"
                   class="text-sm font-medium text-neutral-600 transition hover:text-accent-strong">
                    About QuickPost
                </a>
            </div>
        </header>

        <div class="mx-auto flex max-w-7xl gap-8 px-5 py-8 sm:px-8 lg:py-10">
            <aside class="hidden w-52 shrink-0 md:block" aria-label="Dashboard navigation">
                <p class="mb-3 px-3 text-sm font-semibold text-neutral-900">Workspace</p>
                <nav>
                    <ul class="space-y-1">
                        @foreach ($navigation as $item)
                            <li>
                                @if ($item['available'])
                                    <a href="{{ route('dashboard') }}" aria-current="page"
                                       class="flex items-center gap-3 rounded-xl bg-white px-3 py-2.5 text-sm font-semibold text-neutral-900">
                                        <svg viewBox="0 0 24 24" class="size-4.5 text-accent-strong" fill="none"
                                             stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/>
                                            <rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/>
                                            <rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/>
                                            <rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>
                                        </svg>
                                        {{ $item['label'] }}
                                    </a>
                                @else
                                    <span class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm text-neutral-500">
                                        {{ $item['label'] }}
                                        <span class="text-xs">(soon)</span>
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>

                <div class="mt-8 border-t border-neutral-200 pt-5">
                    <p class="px-3 text-xs leading-relaxed text-neutral-500">
                        QuickPost is a learning project. Posting to social platforms is not available yet.
                    </p>
                </div>
            </aside>

            <main class="min-w-0 flex-1">
                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-sm font-medium text-accent-strong">Workspace overview</p>
                        <h1 class="mt-1 text-3xl font-bold tracking-tight text-neutral-900">Dashboard</h1>
                        <p class="mt-2 text-sm text-neutral-600">Plan and review your social content in one place.</p>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-full border border-neutral-200 bg-white px-3 py-1.5 text-xs font-medium text-neutral-600">
                        Interface preview. Everything shown is an example, not real data.
                    </span>
                </div>

                <div class="mt-7 grid gap-5 lg:grid-cols-2">
                    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                             aria-labelledby="calendar-title">
                        <div class="flex items-center justify-between gap-4 border-b border-neutral-200 pb-4">
                            <div class="flex items-center gap-3">
                                <span class="grid size-9 place-items-center rounded-xl bg-neutral-100 text-accent-strong">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3.5" y="5" width="17" height="15.5" rx="2"/>
                                        <path d="M7.5 3.5v3M16.5 3.5v3M3.5 9.5h17"/>
                                    </svg>
                                </span>
                                <div>
                                    <h2 id="calendar-title" class="font-semibold text-neutral-900">Content calendar</h2>
                                    <p class="mt-0.5 text-sm text-neutral-500">{{ $monthStart->format('F Y') }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-medium text-neutral-500">Calendar (soon)</span>
                        </div>

                        <div class="mt-5 grid grid-cols-7 gap-1.5 sm:gap-2">
                            @foreach ($weekdays as $weekday)
                                <span class="pb-1 text-center text-xs font-medium text-neutral-500">{{ $weekday }}</span>
                            @endforeach
                            @foreach ($calendarDays as $day)
                                @if ($day)
                                    <span @if ($day === now()->day) aria-current="date" @endif
                                          class="grid aspect-square place-items-center rounded-lg border text-sm
                                          {{ $day === now()->day
                                                ? 'border-accent bg-white font-semibold text-accent-strong'
                                                : 'border-neutral-200 bg-neutral-100 text-neutral-700' }}">
                                        {{ $day }}
                                    </span>
                                @else
                                    <span aria-hidden="true" class="aspect-square rounded-lg bg-neutral-100"></span>
                                @endif
                            @endforeach
                        </div>
                    </section>

                    <section class="flex min-h-80 flex-col rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                             aria-labelledby="analytics-title">
                        <div class="flex items-center justify-between gap-4 border-b border-neutral-200 pb-4">
                            <div class="flex items-center gap-3">
                                <span class="grid size-9 place-items-center rounded-xl bg-neutral-100 text-accent-strong">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M4 19.5h16M6.5 16v-4M11.5 16V6M16.5 16v-7"/>
                                    </svg>
                                </span>
                                <div>
                                    <h2 id="analytics-title" class="font-semibold text-neutral-900">Post performance</h2>
                                    <p class="mt-0.5 text-sm text-neutral-500">Engagement overview</p>
                                </div>
                            </div>
                            <span class="text-sm font-medium text-neutral-500">Analytics (soon)</span>
                        </div>

                        <div class="flex flex-1 flex-col items-center justify-center py-10 text-center">
                            <span class="grid size-14 place-items-center rounded-2xl border border-neutral-200 bg-neutral-100 text-neutral-500">
                                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                                     stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 19.5h16M6.5 16v-4M11.5 16V6M16.5 16v-7"/>
                                </svg>
                            </span>
                            <h3 class="mt-4 font-semibold text-neutral-900">No performance data yet</h3>
                            <p class="mt-1 max-w-xs text-sm leading-relaxed text-neutral-500">
                                Analytics will be available when QuickPost can publish and collect post results.
                            </p>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                             aria-labelledby="status-title">
                        <div class="flex items-center justify-between gap-4 border-b border-neutral-200 pb-4">
                            <div class="flex items-center gap-3">
                                <span class="grid size-9 place-items-center rounded-xl bg-neutral-100 text-accent-strong">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 4.5h14v15H5zM8 9h8M8 12.5h8M8 16h4"/>
                                    </svg>
                                </span>
                                <div>
                                    <h2 id="status-title" class="font-semibold text-neutral-900">Content status</h2>
                                    <p class="mt-0.5 text-sm text-neutral-500">Your drafts and scheduled posts</p>
                                </div>
                            </div>
                        </div>

                        <ul class="divide-y divide-neutral-200">
                            @foreach (['Drafts', 'Scheduled posts', 'Published posts'] as $status)
                                <li class="flex items-center justify-between gap-4 py-4">
                                    <span class="text-sm font-medium text-neutral-700">{{ $status }}</span>
                                    <span class="text-xs font-medium text-neutral-500">(soon)</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <section class="flex min-h-72 flex-col rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                             aria-labelledby="upcoming-title">
                        <div class="flex items-center gap-3 border-b border-neutral-200 pb-4">
                            <span class="grid size-9 place-items-center rounded-xl bg-neutral-100 text-accent-strong">
                                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor"
                                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="8.5"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </span>
                            <div>
                                <h2 id="upcoming-title" class="font-semibold text-neutral-900">Upcoming posts</h2>
                                <p class="mt-0.5 text-sm text-neutral-500">Your next scheduled content</p>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col items-center justify-center py-8 text-center">
                            <h3 class="font-semibold text-neutral-900">No scheduled posts</h3>
                            <p class="mt-1 max-w-xs text-sm leading-relaxed text-neutral-500">
                                Scheduled content will appear here once post scheduling is available.
                            </p>
                            <span class="mt-4 text-sm font-medium text-accent-strong">Create a post (soon)</span>
                        </div>
                    </section>
                </div>

                <p class="mt-6 text-center text-xs text-neutral-500 md:hidden">
                    Publishing, drafts, media library, analytics, and settings (soon)
                </p>
            </main>
        </div>
    </body>
</html>
