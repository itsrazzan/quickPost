@extends('layouts.workspace')

@section('title', 'Media library')
@section('eyebrow', 'Content')
@section('page-title', 'Media library')
@section('page-description', 'Keep images and other content assets together for your posts.')

@section('content')
    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
             aria-labelledby="media-title">
        <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 pb-5 sm:flex-row sm:items-center">
            <div>
                <h2 id="media-title" class="font-semibold text-neutral-900">Your media</h2>
                <p class="mt-1 text-sm text-neutral-500">No files stored</p>
            </div>
            <span class="inline-flex w-fit items-center rounded-xl border border-neutral-200 bg-neutral-100 px-4 py-2.5 text-sm font-semibold text-neutral-500">
                Add media (soon)
            </span>
        </div>

        <div class="mt-5 grid gap-3 sm:grid-cols-3">
            <span class="rounded-xl border border-neutral-200 px-3 py-2 text-sm text-neutral-500">
                Search files (soon)
            </span>
            <span class="rounded-xl border border-neutral-200 px-3 py-2 text-sm text-neutral-500">
                File type (soon)
            </span>
            <span class="rounded-xl border border-neutral-200 px-3 py-2 text-sm text-neutral-500">
                Sort by (soon)
            </span>
        </div>

        <div class="grid min-h-80 place-items-center py-10 text-center">
            <div>
                <span class="mx-auto grid size-14 place-items-center rounded-2xl border border-neutral-200 bg-neutral-100 text-accent-strong">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3.5" y="4.5" width="17" height="15" rx="2"/>
                        <circle cx="9" cy="10" r="1.5"/>
                        <path d="m4 17 5-4 3 2 4-5 4 4"/>
                    </svg>
                </span>
                <h3 class="mt-4 font-semibold text-neutral-900">Your library is empty</h3>
                <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-neutral-500">
                    Media uploads are not available in this preview. No files will be saved.
                </p>
            </div>
        </div>
    </section>
@endsection
