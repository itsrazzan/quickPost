{{-- resources/views/workspace/media-library.blade.php --}}

{{-- 
    Workspace Media Library View.
    Menampilkan form unggah gambar dan grid media milik user.
--}}
@extends('layouts.workspace')

@section('title', 'Media library')
@section('eyebrow', 'Content')
@section('page-title', 'Media library')
@section('page-description', 'Keep images and other content assets together for your posts.')

@section('content')
    <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
             aria-labelledby="media-title">
        {{-- Header: jumlah media milik user --}}
        <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 pb-5 sm:flex-row sm:items-center">
            <div>
                <h2 id="media-title" class="font-semibold text-neutral-900">Your media</h2>
                <p class="mt-1 text-sm text-neutral-500">
                    {{ $mediaItems->total() }} file(s) stored
                </p>
            </div>
        </div>

        {{-- Flash sukses setelah upload atau hapus --}}
        @if (session('status'))
            <p role="status" class="mt-5 rounded-xl border border-green-800 bg-green-50 px-4 py-3 text-sm font-medium text-green-900">
                {{ session('status') }}
            </p>
        @endif

        {{-- Ringkasan error validasi (mis. file bukan gambar) --}}
        @if ($errors->any())
            <div role="alert" class="mt-5 rounded-xl border border-red-800 bg-red-50 px-4 py-3 text-sm text-red-900">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form upload gambar; enctype multipart wajib untuk file --}}
        <form method="POST"
              action="{{ route('media-library.store') }}"
              enctype="multipart/form-data"
              class="mt-5 grid gap-4 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-end"
              data-loading-form>
            @csrf
            <div>
                <label for="file" class="block text-sm font-medium text-neutral-800">Choose an image</label>
                <input id="file"
                       name="file"
                       type="file"
                       accept="image/jpeg,image/png,image/webp"
                       required
                       @if ($errors->has('file')) aria-invalid="true" aria-describedby="file-error" @endif
                       class="mt-1.5 block w-full cursor-pointer rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-700 file:mr-4 file:rounded-lg file:border-0 file:bg-neutral-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-neutral-800 hover:file:bg-neutral-200">
                @error('file')
                    <p id="file-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    data-loading-button
                    data-loading-label="Uploading..."
                    class="inline-flex min-h-11 items-center justify-center rounded-full bg-accent-strong px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-accent-deep focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                <span data-button-label aria-live="polite">Upload</span>
            </button>
        </form>

        @if ($mediaItems->isEmpty())
            {{-- Empty state saat belum ada media --}}
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
                        Upload a JPG, PNG, or WebP image to start building your library.
                    </p>
                </div>
            </div>
        @else
            {{-- Grid kartu media --}}
            <ul class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($mediaItems as $media)
                    <li class="overflow-hidden rounded-2xl border border-neutral-200 bg-white">
                        <img src="{{ Storage::disk($media->disk)->url($media->file_path) }}"
                             alt="{{ $media->file_name }}"
                             loading="lazy"
                             class="aspect-square w-full object-cover">
                        <div class="p-3">
                            <p class="truncate text-sm font-medium text-neutral-900" title="{{ $media->file_name }}">
                                {{ $media->file_name }}
                            </p>
                            <p class="mt-1 text-xs text-neutral-500">
                                {{ number_format($media->file_size / 1024, 1) }} KB
                                @if ($media->dimensions)
                                    &middot; {{ $media->dimensions['width'] }}&times;{{ $media->dimensions['height'] }}
                                @endif
                            </p>
                            <form method="POST" action="{{ route('media-library.destroy', $media) }}" class="mt-3" data-loading-form>
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        data-loading-button
                                        data-loading-label="Deleting..."
                                        class="inline-flex min-h-9 w-full items-center justify-center rounded-lg border border-neutral-300 px-3 py-1.5 text-xs font-semibold text-neutral-700 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                                    <span data-button-label aria-live="polite">Delete</span>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($mediaItems->hasPages())
                <div class="mt-6 border-t border-neutral-200 pt-4">
                    {{ $mediaItems->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection
