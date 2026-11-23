{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $intent === 'signup' ? 'Sign up' : 'Login' }} - QuickPost</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
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
            <section data-reveal class="w-full max-w-md rounded-3xl border border-neutral-200 bg-white p-6 sm:p-9">
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
                        {{ $intent === 'signup' ? 'Save drafts under your account.' : 'Sign in to open your saved drafts.' }}
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

                <form method="POST"
                      action="{{ $intent === 'signup' ? route('register.store') : route('login.store') }}"
                      class="mt-6 space-y-4"
                      data-loading-form>
                    @csrf
                    @if ($intent === 'signup')
                        <div>
                            <label for="name" class="block text-sm font-medium text-neutral-800">Name</label>
                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name') }}"
                                   autocomplete="name"
                                   required
                                   maxlength="255"
                                   @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                                   class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            @error('name')
                                <p id="name-error" role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-800">Email</label>
                        <input id="email"
                               name="email"
                               type="email"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               required
                               maxlength="255"
                               @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
                               class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                        @error('email')
                            <p id="email-error" role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-neutral-800">Password</label>
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="{{ $intent === 'signup' ? 'new-password' : 'current-password' }}"
                               required
                               @if ($intent === 'signup') minlength="8" @endif
                               @if ($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif
                               class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                        @error('password')
                            <p id="password-error" role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($intent === 'signup')
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-neutral-800">
                                Confirm password
                            </label>
                            <input id="password_confirmation"
                                   name="password_confirmation"
                                   type="password"
                                   autocomplete="new-password"
                                   required
                                   minlength="8"
                                   class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                        </div>
                    @else
                        <label class="flex min-h-11 items-center gap-2.5 text-sm text-neutral-700">
                            <input type="checkbox"
                                   name="remember"
                                   value="1"
                                   class="size-4 rounded border-neutral-400 text-accent-strong focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            Remember me
                        </label>
                    @endif

                    <button type="submit"
                            data-loading-button
                            data-loading-label="{{ $intent === 'signup' ? 'Creating account...' : 'Signing in...' }}"
                            class="flex min-h-11 w-full items-center justify-center rounded-full bg-accent-strong px-5 py-3 text-sm font-semibold text-white transition duration-150 hover:bg-accent-deep active:scale-[.98] focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                        <span data-button-label aria-live="polite">
                            {{ $intent === 'signup' ? 'Create account' : 'Sign in' }}
                        </span>
                    </button>
                </form>

                <p class="mt-5 text-center text-sm leading-relaxed text-neutral-600">
                    Drafts are saved to your account. Social publishing is not connected yet.
                </p>
            </section>
        </main>
    </body>
</html>
