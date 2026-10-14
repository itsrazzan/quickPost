<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $intent === 'signup' ? 'Sign up' : 'Login' }} - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-neutral-100 text-neutral-800 antialiased">
        <header class="mx-auto flex max-w-6xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ route('home') }}"
               class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-neutral-900">
                <span class="grid size-8 place-items-center rounded-lg bg-accent text-white">
                    <svg viewBox="0 0 24 24" class="size-4.5" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="8.5"/>
                        <path d="M12 7.5V12l3 2"/>
                    </svg>
                </span>
                QuickPost
            </a>
            <a href="{{ route('home') }}"
               class="text-sm font-medium text-neutral-600 transition hover:text-accent-strong">
                Back to home
            </a>
        </header>

        <main class="grid min-h-[calc(100vh-5rem)] place-items-center px-5 pb-12 sm:px-8">
            <section class="w-full max-w-md rounded-3xl border border-neutral-200 bg-white p-6 sm:p-9">
                <div class="text-center">
                    <span class="mx-auto grid size-14 place-items-center rounded-2xl border border-neutral-200 bg-neutral-100 text-accent-strong">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="8" r="3.5"/>
                            <path d="M5 20c.8-3.1 3.3-5 7-5s6.2 1.9 7 5"/>
                        </svg>
                    </span>
                    <h1 class="mt-5 text-2xl font-bold tracking-tight text-neutral-900">
                        {{ $intent === 'signup' ? 'Create your QuickPost account' : 'Login to your account' }}
                    </h1>
                    <p class="mt-2 text-sm leading-relaxed text-neutral-600">
                        {{ $intent === 'signup' ? 'Start with a preview workspace.' : 'Welcome back to your workspace.' }}
                    </p>
                </div>

                <div class="mt-7 grid grid-cols-2 rounded-xl bg-neutral-100 p-1">
                    <a href="{{ route('login', ['intent' => 'login']) }}"
                       @if ($intent === 'login') aria-current="page" @endif
                       class="rounded-lg px-3 py-2.5 text-center text-sm font-semibold transition
                       {{ $intent === 'login' ? 'bg-white text-neutral-900' : 'text-neutral-600 hover:text-neutral-900' }}">
                        Login
                    </a>
                    <a href="{{ route('login', ['intent' => 'signup']) }}"
                       @if ($intent === 'signup') aria-current="page" @endif
                       class="rounded-lg px-3 py-2.5 text-center text-sm font-semibold transition
                       {{ $intent === 'signup' ? 'bg-white text-neutral-900' : 'text-neutral-600 hover:text-neutral-900' }}">
                        Sign up
                    </a>
                </div>

                <div class="mt-6 rounded-xl border border-neutral-200 bg-neutral-100 px-4 py-3">
                    <p class="text-sm font-semibold text-neutral-900">Demo mode</p>
                    <p class="mt-1 text-sm leading-relaxed text-neutral-600">
                        No email or password needed. Continue to open the sample workspace for Agil Razzan.
                    </p>
                </div>

                <form method="POST" action="{{ route('demo-session.store') }}" class="mt-6">
                    @csrf
                    <input type="hidden" name="intent" value="{{ $intent }}">
                    <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-accent px-5 py-3 text-sm font-semibold text-white transition duration-150 hover:-translate-y-0.5 hover:bg-accent-strong focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent">
                        {{ $intent === 'signup' ? 'Create account and continue' : 'Login and continue' }}
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6"/>
                        </svg>
                    </button>
                </form>

                <p class="mt-5 text-center text-xs leading-relaxed text-neutral-500">
                    This preview uses a temporary session. There is no database account or social connection.
                </p>
            </section>
        </main>
    </body>
</html>
