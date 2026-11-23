@extends('layouts.workspace')

@section('title', $draft->exists ? 'Edit draft' : 'Create draft')
@section('eyebrow', 'Publishing')
@section('page-title', $draft->exists ? 'Edit draft' : 'Create a draft')
@section('page-description', 'Save a title or caption now. You can revise it later.')

@section('content')
    <section class="max-w-3xl rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
             aria-labelledby="draft-form-title">
        <h2 id="draft-form-title" class="font-semibold text-neutral-900">
            {{ $draft->exists ? 'Draft details' : 'New draft' }}
        </h2>

        @if ($errors->any())
            <div role="alert" class="mt-4 rounded-xl border border-red-800 bg-red-50 px-4 py-3 text-sm text-red-900">
                Check the highlighted fields and try again.
            </div>
        @endif

        <form method="POST"
              action="{{ $draft->exists ? route('drafts.update', $draft) : route('drafts.store') }}"
              class="mt-5 space-y-5"
              data-loading-form>
            @csrf
            @if ($draft->exists)
                @method('PUT')
            @endif

            <div>
                <label for="title" class="block text-sm font-medium text-neutral-800">Title</label>
                <input id="title"
                       name="title"
                       type="text"
                       value="{{ old('title', $draft->title) }}"
                       maxlength="255"
                       @if ($errors->has('title')) aria-invalid="true" aria-describedby="title-error" @endif
                       class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                @error('title')
                    <p id="title-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="caption" class="block text-sm font-medium text-neutral-800">Caption</label>
                <textarea id="caption"
                          name="caption"
                          rows="8"
                          maxlength="5000"
                          @if ($errors->has('caption')) aria-invalid="true" aria-describedby="caption-error" @endif
                          class="mt-1.5 w-full resize-y rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm leading-relaxed text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">{{ old('caption', $draft->caption) }}</textarea>
                @error('caption')
                    <p id="caption-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                @enderror
                <p class="mt-1.5 text-xs text-neutral-600">Enter a title, a caption, or both.</p>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-neutral-200 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('drafts') }}"
                   class="inline-flex min-h-11 items-center justify-center rounded-xl border border-neutral-300 px-5 py-2.5 text-sm font-semibold text-neutral-800 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                    Cancel
                </a>
                <button type="submit"
                        data-loading-button
                        data-loading-label="Saving draft..."
                        class="inline-flex min-h-11 items-center justify-center rounded-full bg-accent-strong px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-accent-deep focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                    <span data-button-label aria-live="polite">
                        {{ $draft->exists ? 'Save changes' : 'Save draft' }}
                    </span>
                </button>
            </div>
        </form>
    </section>
@endsection
