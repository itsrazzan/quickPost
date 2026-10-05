{{-- resources/views/components/button.blade.php --}}
{{-- Usage: <x-button href="{{ route('about') }}">See how QuickPost works</x-button>
            <x-button variant="light" href="{{ route('home') }}">Back to home</x-button> --}}
@props(['variant' => 'dark'])

@php
    $base = 'inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-sm font-semibold '
          . 'transition duration-150 hover:-translate-y-0.5 active:translate-y-px '
          . 'focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent';

    $variants = [
        // Elevation stays small: a button marks interaction, it does not float (DESIGN.md).
        'dark'  => 'bg-linear-to-b from-neutral-700 to-neutral-900 text-white '
                 . 'shadow-[0_2px_6px_rgba(0,0,0,0.20)] '
                 . 'hover:shadow-[0_4px_12px_rgba(0,0,0,0.24)] '
                 . 'active:shadow-[0_1px_3px_rgba(0,0,0,0.18)]',

        // The border is the boundary: white on white needs a 3:1 edge, and neutral-500
        // is the nearest Tailwind stop that passes (4.74:1 on white, computed).
        'light' => 'border border-neutral-500 bg-white text-neutral-800 '
                 . 'hover:bg-neutral-50 active:bg-neutral-100',
    ];
@endphp

<a {{ $attributes->merge(['class' => $base . ' ' . ($variants[$variant] ?? $variants['dark'])]) }}>
    {{ $slot }}
</a>
