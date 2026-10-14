@extends('layouts.workspace')

@section('title', 'Drafts')
@section('eyebrow', 'Publishing')
@section('page-title', 'Drafts')
@section('page-description', 'Keep unfinished ideas together before they are ready to publish.')

@section('content')
    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
             aria-labelledby="drafts-list-title">
        <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 pb-5 sm:flex-row sm:items-center">
            <div>
                <h2 id="drafts-list-title" class="font-semibold text-neutral-900">All drafts</h2>
                <p class="mt-1 text-sm text-neutral-500">Drafts you have saved for later</p>
            </div>
            <span class="rounded-lg border border-neutral-200 px-3 py-2 text-sm font-medium text-neutral-500">
                Filters (soon)
            </span>
        </div>

        <div class="grid min-h-80 place-items-center py-10 text-center">
            <div>
                <span class="mx-auto grid size-14 place-items-center rounded-2xl border border-neutral-200 bg-neutral-100 text-accent-strong">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 3.5h9l5 5v12H5zM14 3.5v5h5M8 13h8M8 16.5h6"/>
                    </svg>
                </span>
                <h3 class="mt-4 font-semibold text-neutral-900">No drafts yet</h3>
                <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-neutral-500">
                    When you start a post and save it for later, it will show up here.
                </p>
                <p class="mt-4 text-sm font-semibold text-accent-strong">Create a post (soon)</p>
            </div>
        </div>
    </section>
@endsection
