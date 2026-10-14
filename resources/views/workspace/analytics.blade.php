@extends('layouts.workspace')

@section('title', 'Analytics')
@section('eyebrow', 'Measure')
@section('page-title', 'Analytics')
@section('page-description', 'Review how your posts perform across connected platforms.')

@section('content')
    <div class="grid gap-5 xl:grid-cols-[minmax(0,1.5fr)_minmax(18rem,1fr)]">
        <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                 aria-labelledby="reach-title">
            <div class="flex flex-col justify-between gap-3 border-b border-neutral-200 pb-4 sm:flex-row sm:items-center">
                <div>
                    <h2 id="reach-title" class="font-semibold text-neutral-900">Post reach</h2>
                    <p class="mt-1 text-sm text-neutral-500">Reach and engagement over time</p>
                </div>
                <span class="rounded-lg border border-neutral-200 px-3 py-2 text-sm text-neutral-500">
                    Last 30 days (soon)
                </span>
            </div>
            <div class="grid min-h-72 place-items-center py-8 text-center">
                <div>
                    <span class="mx-auto grid size-14 place-items-center rounded-2xl border border-neutral-200 bg-neutral-100 text-accent-strong">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 19.5h16M6.5 16v-4M11.5 16V6M16.5 16v-7"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-semibold text-neutral-900">No analytics to show yet</h3>
                    <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-neutral-500">
                        Post performance will appear here after publishing and analytics are connected.
                    </p>
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-6"
                 aria-labelledby="metrics-title">
            <h2 id="metrics-title" class="font-semibold text-neutral-900">Engagement overview</h2>
            <p class="mt-1 text-sm text-neutral-500">Across your social accounts</p>
            <ul class="mt-5 divide-y divide-neutral-200">
                @foreach (['Reach', 'Likes', 'Comments', 'Shares'] as $metric)
                    <li class="flex items-center justify-between py-4">
                        <span class="text-sm text-neutral-700">{{ $metric }}</span>
                        <span class="text-sm font-medium text-neutral-500">No data</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-3 rounded-xl bg-neutral-100 px-3 py-2.5 text-xs leading-relaxed text-neutral-600">
                Analytics is a preview. No metrics are connected or stored yet.
            </p>
        </section>
    </div>
@endsection
