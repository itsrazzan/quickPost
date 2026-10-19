{{-- resources/views/components/button.blade.php --}}

{{-- 
    Reusable button component (renders as styled <a> element).
    Usage:
        <x-button href="{{ route('about') }}">Learn more</x-button>
        <x-button variant="light" href="{{ route('home') }}">Back</x-button>
        <x-button size="sm" href="{{ route('login') }}">Log in</x-button>
--}}
@props(['variant' => 'dark', 'size' => 'md'])

@php
    // Base interactive styles: pill shape, click scale animation, accessible focus ring
    $base = 'inline-flex items-center justify-center rounded-full text-sm font-semibold '
          . 'transition duration-150 ease-ui active:scale-[.96] '
          . 'focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent';

    // Color variants
    $variants = [
        'dark'  => 'bg-accent-strong text-white hover:bg-accent-deep',
        'light' => 'border border-neutral-200 bg-white text-neutral-800 '
                 . 'hover:border-neutral-300 hover:bg-neutral-50',
        'soft'  => 'bg-accent-pale text-neutral-900 hover:bg-accent-soft',
    ];

    // Padding & dimensions
    $sizes = [
        'sm' => 'px-4 py-1.5',
        'md' => 'px-5 py-2.5',
        'lg' => 'px-7 py-3.5',
    ];
@endphp

{{-- Merges component default classes with custom parent classes passed via HTML attributes --}}
<a {{ $attributes->merge(['class' => $base.' '.($variants[$variant] ?? $variants['dark']).' '.($sizes[$size] ?? $sizes['md'])]) }}>
    {{ $slot }}
</a>
