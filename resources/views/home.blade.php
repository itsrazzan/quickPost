<x-layouts.app>
    @php
    // Dummy data. Later, move these arrays into a controller and pass them with view('welcome', compact(...)).
    $posts = [
        ['text' => 'We just shipped our new landing page.', 'platforms' => ['Instagram', 'LinkedIn'], 'time' => 'Today, 15:00',    'status' => 'scheduled'],
        ['text' => 'Behind the scenes from this week.',     'platforms' => ['Instagram'],             'time' => 'Yesterday, 09:30', 'status' => 'published'],
        ['text' => 'Quick tip: plan your week on Sunday.',  'platforms' => ['X', 'LinkedIn'],         'time' => 'Mon, 18:45',       'status' => 'failed'],
    ];

    $statusStyles = [
        'scheduled' => 'bg-amber-50 text-amber-700',
        'published' => 'bg-emerald-50 text-emerald-700',
        'failed'    => 'bg-red-50 text-red-700',
    ];

    $features = [
        ['title' => 'Write once',       'text' => 'Write your post in one editor, then reuse it across every platform.'],
        ['title' => 'Choose platforms', 'text' => 'Choose Instagram, LinkedIn, or X per post — no reformatting, no copy-paste.'],
        ['title' => 'Pick a time',      'text' => 'Queue a week of content in minutes and see exactly what goes out when.'],
    ];

    $faqs = [
        ['question' => 'What is QuickPost?',              'answer' => 'A scheduler for social posts: write once, choose the platforms, and set when each post goes out.'],
        ['question' => 'Do I need an account?',           'answer' => 'No. The demo opens a temporary workspace — no email or password required.'],
        ['question' => 'Which platforms are supported?',  'answer' => 'Instagram, LinkedIn, and X are shown in this preview. More platforms are planned.'],
        ['question' => 'Is my content saved?',            'answer' => 'Not yet — the demo workspace does not store anything in a database for now.'],
        ['question' => 'When can I actually schedule posts?', 'answer' => 'Scheduling is in development. This page shows the interface as it is being built.'],
    ];
@endphp

{{-- Hero --}}
<section class="mx-auto max-w-5xl px-6 pt-20 text-center">
    <h1 class="mx-auto max-w-3xl text-6xl font-light leading-[1.05] tracking-tight text-balance text-neutral-900">
        Plan a week of social posts in one sitting
    </h1>
    <p class="mx-auto mt-6 max-w-xl text-lg text-neutral-600">
        Draft, preview, and schedule every platform from one calm workspace — then get on with your day.
    </p>

    <div class="mt-9 flex items-center justify-center gap-4">
        <x-button href="{{ route('login', ['intent' => 'signup']) }}" class="px-7 py-3.5 text-base">Start free</x-button>
        <x-button variant="light" href="#features" class="px-7 py-3.5 text-base">See how it works</x-button>
    </div>
</section>

{{-- Interface preview. Labelled as a preview: everything inside is an example, not real data (R-38). --}}
<section class="mx-auto mt-16 max-w-5xl px-6" aria-label="Interface preview">
    <p class="text-center text-sm font-medium text-neutral-600">
        Interface preview. Everything shown is an example, not real data.
    </p>
    <div class="mt-6 grid grid-cols-5 gap-6 rounded-3xl bg-white/70 p-6 shadow-[0_20px_60px_rgba(0,0,0,0.10)]">

        {{-- Composer --}}
        <div class="col-span-2 rounded-2xl border border-neutral-200 bg-white p-5">
            <h2 class="text-sm font-semibold text-neutral-900">New post</h2>

            <div class="mt-4 h-28 rounded-xl bg-neutral-100 p-3 text-sm text-neutral-600">
                What do you want to share?
            </div>

            <div class="mt-4 flex gap-2 text-xs font-medium">
                <span class="rounded-full border-2 border-accent px-3 py-1 text-neutral-800">Instagram</span>
                <span class="rounded-full border-2 border-accent px-3 py-1 text-neutral-800">LinkedIn</span>
                <span class="rounded-full border-2 border-neutral-200 px-3 py-1 text-neutral-500">X</span>
            </div>

            <div class="mt-5 flex items-center justify-between">
                <span class="text-xs text-neutral-500">Today, 15:00</span>
                <span class="rounded-lg bg-neutral-900 px-4 py-2 text-xs font-semibold text-white">Schedule</span>
            </div>
        </div>

        {{-- Example posts list --}}
        <div class="col-span-3 rounded-2xl border border-neutral-200 bg-white p-5">
            <h2 class="text-sm font-semibold text-neutral-900">Example posts</h2>

            <ul class="mt-4 divide-y divide-neutral-100">
                {{-- 
                    @forelse directive:
                    Loops over $posts, or executes the @empty block if the array is empty.
                --}}
                @forelse ($posts as $post)
                    <li class="flex items-center justify-between gap-4 py-3.5">
                        <div class="min-w-0">
                            {{-- 'truncate' adds an ellipsis (...) to prevent overflow --}}
                            <p class="truncate text-sm font-medium text-neutral-800">{{ $post['text'] }}</p>
                            <p class="mt-1 text-xs text-neutral-500">
                                {{ implode(', ', $post['platforms']) }} &middot; {{ $post['time'] }}
                            </p>
                        </div>
                        <span class="shrink-0 rounded-full px-3 py-1 text-xs font-medium {{ $statusStyles[$post['status']] }}">
                            {{ ucfirst($post['status']) }}
                        </span>
                    </li>
                @empty
                    {{-- Rendered only when $posts array has zero items --}}
                    <li class="py-8 text-center text-sm text-neutral-500">
                        No posts yet. Write your first one to see it here.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</section>

{{-- Product features breakdown --}}
<section id="features" class="mx-auto mt-24 max-w-5xl scroll-mt-24 px-6">
    <h2 class="max-w-xl text-3xl font-semibold tracking-tight text-neutral-900">
        Everything between the idea and the post going live
    </h2>

    {{-- The three features are the product's actual sequence, so they read as steps, not cards. --}}
    <ol class="mt-10 grid grid-cols-3 gap-6">
        {{-- Loop with index ($index => $feature) to render step numbers --}}
        @foreach ($features as $index => $feature)
            <li class="border-t-2 border-neutral-900 pt-5">
                <span class="text-sm font-semibold text-accent-strong">Step {{ $index + 1 }}</span>
                <h3 class="mt-2 text-lg font-semibold text-neutral-900">{{ $feature['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-neutral-600">{{ $feature['text'] }}</p>
            </li>
        @endforeach
    </ol>
</section>

{{-- Pricing preview --}}
<section id="pricing" class="mx-auto mt-24 max-w-5xl scroll-mt-24 px-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <h2 class="max-w-md text-3xl font-semibold tracking-tight text-neutral-900">
            Simple pricing while QuickPost grows
        </h2>
        <p class="text-xs font-medium text-neutral-500">
            Preview — not final. Plans may change before launch.
        </p>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-3">
        <div class="flex flex-col rounded-2xl border border-neutral-200 bg-white p-6">
            <h3 class="font-semibold text-neutral-900">Free</h3>
            <p class="mt-3 text-3xl font-semibold tracking-tight text-neutral-900">Rp0</p>
            <p class="mt-1 text-sm text-neutral-500">Try the workspace, no account needed.</p>
            <ul class="mt-5 space-y-2.5 text-sm text-neutral-600">
                <li>1 workspace</li>
                <li>10 scheduled posts per month</li>
                <li>2 platforms</li>
            </ul>
            <x-button variant="light" href="{{ route('login', ['intent' => 'signup']) }}" class="mt-6 w-full">Start free</x-button>
        </div>

        <div class="relative flex flex-col rounded-2xl border-2 border-accent bg-white p-6">
            <span class="absolute -top-3 left-6 rounded-full bg-accent-strong px-3 py-1 text-xs font-semibold text-white">
                Most popular
            </span>
            <h3 class="font-semibold text-neutral-900">Pro</h3>
            <p class="mt-3 text-3xl font-semibold tracking-tight text-neutral-900">
                Rp49rb<span class="text-sm font-medium text-neutral-500">/month</span>
            </p>
            <p class="mt-1 text-sm text-neutral-500">For solo creators posting every week.</p>
            <ul class="mt-5 space-y-2.5 text-sm text-neutral-600">
                <li>Unlimited scheduled posts</li>
                <li>All platforms</li>
                <li>Calendar and drafts view</li>
            </ul>
            <x-button href="{{ route('login', ['intent' => 'signup']) }}" class="mt-6 w-full">Get started</x-button>
        </div>

        <div class="flex flex-col rounded-2xl border border-neutral-200 bg-white p-6">
            <h3 class="font-semibold text-neutral-900">Team</h3>
            <p class="mt-3 text-3xl font-semibold tracking-tight text-neutral-900">
                Rp149rb<span class="text-sm font-medium text-neutral-500">/month</span>
            </p>
            <p class="mt-1 text-sm text-neutral-500">For small teams that plan together.</p>
            <ul class="mt-5 space-y-2.5 text-sm text-neutral-600">
                <li>Everything in Pro</li>
                <li>5 seats</li>
                <li>Approval workflow</li>
            </ul>
            <x-button variant="light" href="{{ route('login', ['intent' => 'signup']) }}" class="mt-6 w-full">Get started</x-button>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="mx-auto mt-24 max-w-3xl scroll-mt-24 px-6">
    <h2 class="text-3xl font-semibold tracking-tight text-neutral-900">
        Frequently asked questions
    </h2>

    <div class="mt-8 space-y-3">
        @foreach ($faqs as $faq)
            <details class="group rounded-2xl border border-neutral-200 bg-white px-8 py-5">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-6 font-medium text-neutral-900
                                focus-visible:outline-3 focus-visible:outline-offset-4 focus-visible:outline-accent
                                [&::-webkit-details-marker]:hidden">
                    {{ $faq['question'] }}
                    <span class="shrink-0 text-neutral-400 transition group-open:rotate-45" aria-hidden="true">+</span>
                </summary>
                <p class="mt-3 text-sm leading-relaxed text-neutral-600">{{ $faq['answer'] }}</p>
            </details>
        @endforeach
    </div>
</section>

{{-- Closing call to action --}}
<section class="mx-auto mt-24 max-w-5xl px-6">
    <div class="flex flex-col items-start justify-between gap-8 rounded-3xl bg-neutral-900 px-10 py-12 sm:flex-row sm:items-center">
        <div>
            <h2 class="max-w-md text-3xl font-semibold tracking-tight text-white">
                Ready to plan your first week?
            </h2>
            <p class="mt-2 max-w-md text-sm leading-relaxed text-neutral-400">
                Open the demo workspace and see the whole workflow before signing up for anything.
            </p>
        </div>
        <x-button variant="light" href="{{ route('login', ['intent' => 'signup']) }}" class="shrink-0 px-7 py-3.5 text-base">
            Create your free workspace
        </x-button>
    </div>
</section>
</x-layouts.app>