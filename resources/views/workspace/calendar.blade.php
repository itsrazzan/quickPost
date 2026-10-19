{{-- resources/views/workspace/calendar.blade.php --}}

{{-- 
    Workspace Monthly Calendar View.
    Receives $calendarMonth (CarbonImmutable instance) from the controller or route closure.
    Computes offset padding for weekday alignment and provides previous/next month navigation links.
--}}
@extends('layouts.workspace')

@section('title', 'Calendar')
@section('eyebrow', 'Publishing')
@section('page-title', 'Calendar')
@section('page-description', 'See your content plan by date and keep your schedule in view.')

@section('content')
    @php
        // Pad beginning of month array to align with day of week (0 = Sunday)
        $calendarDays = array_merge(
            array_fill(0, $calendarMonth->dayOfWeek, null),
            range(1, $calendarMonth->daysInMonth),
        );
        // Pad end of month to complete full 7-column rows
        $calendarDays = array_pad($calendarDays, (int) ceil(count($calendarDays) / 7) * 7, null);
        $weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    @endphp

    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
             aria-labelledby="month-title">
        {{-- Calendar Header: Month/Year title and month traversal controls --}}
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-neutral-200 pb-5">
            <div>
                <h2 id="month-title" class="text-xl font-semibold text-neutral-900">
                    {{ $calendarMonth->format('F Y') }}
                </h2>
                <p class="mt-1 text-sm text-neutral-500">Monthly view</p>
            </div>
            {{-- Traversal buttons querying previous, current, or next month in 'Y-m' format --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('calendar', ['month' => $calendarMonth->subMonth()->format('Y-m')]) }}"
                   aria-label="Previous month"
                   class="grid size-10 place-items-center rounded-lg border border-neutral-200 text-neutral-700 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                    <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </a>
                <a href="{{ route('calendar', ['month' => now()->format('Y-m')]) }}"
                   class="rounded-lg border border-neutral-200 px-3.5 py-2 text-sm font-medium text-neutral-700 transition hover:bg-neutral-100">
                    Today
                </a>
                <a href="{{ route('calendar', ['month' => $calendarMonth->addMonth()->format('Y-m')]) }}"
                   aria-label="Next month"
                   class="grid size-10 place-items-center rounded-lg border border-neutral-200 text-neutral-700 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                    <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- 7-column calendar day grid --}}
        <div class="mt-5 grid grid-cols-7 gap-1.5 sm:gap-2">
            @foreach ($weekdays as $weekday)
                <span class="pb-2 text-center text-xs font-semibold text-neutral-500 sm:text-sm">{{ $weekday }}</span>
            @endforeach
            @foreach ($calendarDays as $day)
                @if ($day)
                    @php($date = $calendarMonth->setDay($day))
                    {{-- Highlight current day if it matches system today --}}
                    <div @if ($date->isToday()) aria-current="date" @endif
                         class="flex min-h-14 flex-col items-center justify-center rounded-lg border p-1 text-sm
                         {{ $date->isToday()
                              ? 'border-accent bg-orange-50 font-semibold text-accent-strong'
                              : 'border-neutral-200 bg-neutral-100 text-neutral-700' }}
                         sm:min-h-20 sm:items-start sm:justify-start sm:p-2.5">
                        <span>{{ $day }}</span>
                    </div>
                @else
                    {{-- Empty offset cell --}}
                    <div aria-hidden="true" class="min-h-14 rounded-lg bg-neutral-100 sm:min-h-20"></div>
                @endif
            @endforeach
        </div>

        <p class="mt-5 rounded-xl border border-neutral-200 bg-neutral-100 px-4 py-3 text-sm text-neutral-600">
            No posts are scheduled. Calendar entries will appear here when scheduling is available.
        </p>
    </section>
@endsection
