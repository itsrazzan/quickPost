{{-- resources/views/workspace/drafts.blade.php --}}

@extends('layouts.workspace')

@section('title', 'Drafts')
@section('eyebrow', 'Publishing')
@section('page-title', 'Drafts')
@section('page-description', 'Keep unfinished ideas together before they are ready to publish.')

@section('content')
    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7" aria-labelledby="drafts-list-title">
        <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 pb-5 sm:flex-row sm:items-center">
            <div>
                <h2 id="drafts-list-title" class="font-semibold text-neutral-900">All drafts</h2>
                <p class="mt-1 text-sm text-neutral-600">Drafts saved to your account</p>
            </div>
            <a href="{{ route('drafts.create') }}"
               class="inline-flex min-h-11 items-center justify-center rounded-full bg-accent-strong px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-accent-deep focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent">
                Create a draft
            </a>
        </div>

        @if (session('status'))
            <p role="status" class="mt-5 rounded-xl border border-green-800 bg-green-50 px-4 py-3 text-sm font-medium text-green-900">
                {{ session('status') }}
            </p>
        @endif

        @if ($drafts->isEmpty())
            <div class="grid min-h-72 place-items-center py-10 text-center">
                <div>
                    <span class="mx-auto grid size-14 place-items-center rounded-2xl border border-neutral-300 bg-neutral-100 text-accent-strong">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 3.5h9l5 5v12H5zM14 3.5v5h5M8 13h8M8 16.5h6"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-semibold text-neutral-900">No drafts yet</h3>
                    <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-neutral-600">
                        Save a title or caption and it will appear here.
                    </p>
                    <a href="{{ route('drafts.create') }}"
                       class="mt-4 inline-flex min-h-11 items-center justify-center rounded-full bg-accent-strong px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-accent-deep focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent">
                        Write your first draft
                    </a>
                </div>
            </div>
        @else
            <ul class="divide-y divide-neutral-200">
                @foreach ($drafts as $draft)
                    <li class="flex flex-col gap-4 py-5 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                            <h3 class="font-semibold text-neutral-900">
                                {{ $draft->title ?: 'Untitled draft' }}
                            </h3>
                            <p class="mt-1 whitespace-pre-line break-words text-sm leading-relaxed text-neutral-700">
                                {{ $draft->caption ?: 'No caption added.' }}
                            </p>
                            <p class="mt-2 text-xs text-neutral-600">
                                Updated {{ $draft->updated_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex shrink-0 flex-wrap gap-2">
                            <a href="{{ route('drafts.edit', $draft) }}"
                               class="inline-flex min-h-11 items-center justify-center rounded-xl border border-neutral-300 px-4 py-2 text-sm font-semibold text-neutral-800 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('drafts.destroy', $draft) }}" data-loading-form>
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        data-loading-button
                                        data-loading-label="Moving draft..."
                                        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-neutral-300 px-4 py-2 text-sm font-semibold text-neutral-800 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                                    <span data-button-label aria-live="polite">Move to recently deleted</span>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($drafts->hasPages())
                <div class="border-t border-neutral-200 pt-4">
                    {{ $drafts->links() }}
                </div>
            @endif
        @endif

        @if ($deletedDrafts->isNotEmpty())
            <section class="mt-8 border-t border-neutral-200 pt-6" aria-labelledby="deleted-drafts-title">
                <h2 id="deleted-drafts-title" class="font-semibold text-neutral-900">Recently deleted</h2>
                <ul class="mt-3 divide-y divide-neutral-200">
                    @foreach ($deletedDrafts as $deletedDraft)
                        <li class="flex flex-col gap-3 py-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <p class="break-words text-sm font-medium text-neutral-800">
                                    {{ $deletedDraft->title ?: 'Untitled draft' }}
                                </p>
                                <p class="mt-1 text-xs text-neutral-600">
                                    Deleted {{ $deletedDraft->deleted_at->diffForHumans() }}
                                </p>
                            </div>
                            <form method="POST"
                                  action="{{ route('drafts.restore', $deletedDraft->id) }}"
                                  data-loading-form>
                                @csrf
                                <button type="submit"
                                        data-loading-button
                                        data-loading-label="Restoring draft..."
                                        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-neutral-300 px-4 py-2 text-sm font-semibold text-neutral-800 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                                    <span data-button-label aria-live="polite">Restore</span>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </section>
@endsection
