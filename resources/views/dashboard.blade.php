@extends('layouts.workspace')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Plan and review your social content in one place.')

@section('content')
@php
    $monthStart = now()->startOfMonth();
    $calendarDays = array_merge(
        array_fill(0, $monthStart->dayOfWeek, null),
        range(1, $monthStart->daysInMonth),
    );
    $calendarDays = array_pad($calendarDays, (int) ceil(count($calendarDays) / 7) * 7, null);

    $weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
@endphp

<div class="grid gap-5 lg:grid-cols-2">
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
@endsection
