{{-- resources/views/partials/footer.blade.php --}}
{{-- Desktop layout. Links with '#' are placeholders until those pages exist. --}}
{{-- Links with null have no page yet: they render as plain "(soon)" text, never as dead links. --}}
@php
    $columns = [
        'Pages' => [
            ['Home',  route('home')],
            ['About', route('about')],
        ],
        'Product' => [
            ['Features',   null],
            ['Scheduling', null],
        ],
        'Legal' => [
            ['Privacy Policy', null],
            ['Terms of Use',   null],
        ],
    ];
@endphp

<footer class="mx-auto mt-24 max-w-5xl px-6 pb-10">
    <div class="rounded-3xl border border-neutral-200 bg-white px-10 py-12">

        <div class="flex justify-between gap-16">
            {{-- Brand + tagline --}}
            <div class="max-w-xs">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-neutral-900">
                    <span class="grid size-8 place-items-center rounded-lg bg-accent text-white">
                        <svg viewBox="0 0 24 24" class="size-4.5" fill="currentColor" aria-hidden="true">
                            <path d="M13 2 4 14h6l-1 8 9-12h-6l1-8Z"/>
                        </svg>
                    </span>
                    QuickPost
                </a>
                <p class="mt-4 text-sm leading-relaxed text-neutral-500">
                    Write once, schedule everywhere.
                </p>
            </div>

            {{-- Link columns --}}
            <div class="grid grid-cols-3 gap-16 text-sm">
                @foreach ($columns as $title => $items)
                    <div>
                        <h3 class="mb-4 font-semibold text-neutral-900">{{ $title }}</h3>
                        <ul class="space-y-3 text-neutral-500">
                            @foreach ($items as [$label, $url])
                                <li>
                                    @if ($url)
                                        <a href="{{ $url }}"
                                           class="transition hover:text-accent-strong">
                                            {{ $label }}
                                        </a>
                                    @else
                                        <span>{{ $label }} (soon)</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Copyright --}}
        <div class="mt-12 border-t border-neutral-200 pt-6 text-sm text-neutral-500">
            &copy; {{ date('Y') }} QuickPost. All rights reserved.
        </div>
    </div>
</footer>
