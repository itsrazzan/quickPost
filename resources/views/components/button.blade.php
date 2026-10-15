{{-- resources/views/components/button.blade.php --}}
{{-- Usage: <x-button href="{{ route('about') }}">See how QuickPost works</x-button>
          <x-button variant="light" href="{{ route('home') }}">Back to home</x-button>
          <x-button variant="soft" href="{{ route('about') }}">Learn more</x-button> --}}
@props(['variant' => 'dark'])

@php
    // Pill shape, pressable feedback: 150ms, scale on :active (DESIGN.md, Motion).
    $base = 'inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-semibold '
          . 'transition duration-150 ease-ui active:scale-[.96] '
          . 'focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent';

    $variants = [
        // White on accent-strong passes 4.5:1; white on accent (3.37:1) would not.
        'dark'  => 'bg-accent-strong text-white hover:bg-accent-deep',

        'light' => 'border border-neutral-200 bg-white text-neutral-800 '
                 . 'hover:border-neutral-300 hover:bg-neutral-50',

        'soft'  => 'bg-accent-pale text-neutral-900 hover:bg-accent-soft',
    ];
@endphp

<a {{ $attributes->merge(['class' => $base . ' ' . ($variants[$variant] ?? $variants['dark'])]) }}>
    {{ $slot }}
</a>
