{{-- resources/views/components/button.blade.php --}}
{{-- Usage: <x-button href="#">Get Started</x-button>
            <x-button variant="light" href="#">See Features</x-button> --}}
@props(['variant' => 'dark'])

@php
    $base = 'inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-sm font-semibold '
          . 'transition duration-150 hover:-translate-y-0.5 active:translate-y-px '
          . 'focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent';

    $variants = [
        'dark'  => 'bg-linear-to-b from-neutral-700 to-neutral-900 text-white '
                 . 'shadow-[inset_0_1px_0_rgba(255,255,255,0.18),0_10px_24px_rgba(0,0,0,0.28)] '
                 . 'hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.18),0_14px_30px_rgba(0,0,0,0.32)] '
                 . 'active:shadow-[inset_0_1px_0_rgba(255,255,255,0.12),0_4px_10px_rgba(0,0,0,0.25)]',

        'light' => 'bg-white text-neutral-800 '
                 . 'shadow-[0_6px_18px_rgba(0,0,0,0.08)] '
                 . 'hover:shadow-[0_10px_24px_rgba(0,0,0,0.12)] '
                 . 'active:shadow-[0_2px_8px_rgba(0,0,0,0.08)]',
    ];
@endphp

<a {{ $attributes->merge(['class' => $base . ' ' . ($variants[$variant] ?? $variants['dark'])]) }}>
    {{ $slot }}
</a>
