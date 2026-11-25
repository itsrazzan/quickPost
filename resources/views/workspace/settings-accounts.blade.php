{{-- resources/views/workspace/settings-accounts.blade.php --}}

{{-- 
    Workspace Connected Accounts View.
    Menampilkan form koneksi (mock) dan daftar akun sosial milik user.
--}}
@extends('layouts.workspace')

@section('title', 'Connected accounts')
@section('eyebrow', 'Preferences')
@section('page-title', 'Connected accounts')
@section('page-description', 'Connect the social accounts you want to publish to.')

@section('content')
    <div class="grid gap-5 xl:grid-cols-[15rem_minmax(0,1fr)]">
        {{-- Sub-navigasi settings, konsisten dengan halaman My settings --}}
        <aside class="h-fit rounded-2xl border border-neutral-200 bg-white p-3"
               aria-label="Settings sections">
            <p class="px-3 py-2 text-xs font-semibold text-neutral-500">SETTINGS</p>
            <a href="{{ route('settings') }}"
               class="block rounded-xl px-3 py-2.5 text-sm font-medium text-neutral-700 transition hover:bg-neutral-100">
                Personal info
            </a>
            <p class="flex items-center justify-between px-3 py-2.5 text-sm text-neutral-500">
                Preferences <span class="text-xs">(soon)</span>
            </p>
            <div class="rounded-xl bg-neutral-100 px-3 py-2.5 text-sm font-semibold text-neutral-900">
                Connected accounts
            </div>
        </aside>

        <div class="space-y-5">
            {{-- Flash sukses setelah connect/disconnect --}}
            @if (session('status'))
                <p role="status" class="rounded-xl border border-green-800 bg-green-50 px-4 py-3 text-sm font-medium text-green-900">
                    {{ session('status') }}
                </p>
            @endif

            {{-- Section 1: Form koneksi akun baru (mock) --}}
            <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
                     aria-labelledby="connect-title">
                <div class="border-b border-neutral-200 pb-4">
                    <h2 id="connect-title" class="font-semibold text-neutral-900">Connect an account</h2>
                    <p class="mt-1 text-sm text-neutral-500">
                        This is a demo connection. No data is sent to any platform.
                    </p>
                </div>

                {{-- Ringkasan error validasi --}}
                @if ($errors->any())
                    <div role="alert" class="mt-4 rounded-xl border border-red-800 bg-red-50 px-4 py-3 text-sm text-red-900">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('accounts.store') }}"
                      class="mt-5 grid gap-4 sm:grid-cols-2" data-loading-form>
                    @csrf

                    {{-- Pilihan platform aktif --}}
                    <div class="sm:col-span-2">
                        <label for="social_platform_id" class="block text-sm font-medium text-neutral-800">Platform</label>
                        <select id="social_platform_id"
                                name="social_platform_id"
                                required
                                @if ($errors->has('social_platform_id')) aria-invalid="true" aria-describedby="platform-error" @endif
                                class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 bg-white px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            <option value="">Select a platform</option>
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}" @selected(old('social_platform_id') == $platform->id)>
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('social_platform_id')
                            <p id="platform-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="account_name" class="block text-sm font-medium text-neutral-800">Account name</label>
                        <input id="account_name"
                               name="account_name"
                               type="text"
                               value="{{ old('account_name') }}"
                               maxlength="255"
                               required
                               @if ($errors->has('account_name')) aria-invalid="true" aria-describedby="account-name-error" @endif
                               class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                        @error('account_name')
                            <p id="account-name-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-neutral-800">Username</label>
                        <input id="username"
                               name="username"
                               type="text"
                               value="{{ old('username') }}"
                               maxlength="255"
                               required
                               @if ($errors->has('username')) aria-invalid="true" aria-describedby="username-error" @endif
                               class="mt-1.5 min-h-11 w-full rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-900 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent">
                        @error('username')
                            <p id="username-error" class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <button type="submit"
                                data-loading-button
                                data-loading-label="Connecting..."
                                class="inline-flex min-h-11 items-center justify-center rounded-full bg-accent-strong px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-accent-deep focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                            <span data-button-label aria-live="polite">Connect account</span>
                        </button>
                    </div>
                </form>
            </section>

            {{-- Section 2: Daftar akun terhubung --}}
            <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
                     aria-labelledby="accounts-title">
                <div class="border-b border-neutral-200 pb-4">
                    <h2 id="accounts-title" class="font-semibold text-neutral-900">Your accounts</h2>
                    <p class="mt-1 text-sm text-neutral-500">{{ $accounts->count() }} connected</p>
                </div>

                @if ($accounts->isEmpty())
                    {{-- Empty state --}}
                    <div class="grid min-h-48 place-items-center py-8 text-center">
                        <div>
                            <h3 class="font-semibold text-neutral-900">No accounts connected</h3>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-neutral-500">
                                Connect a platform above to see it listed here.
                            </p>
                        </div>
                    </div>
                @else
                    <ul class="mt-4 divide-y divide-neutral-200">
                        @foreach ($accounts as $account)
                            <li class="flex flex-col gap-3 py-4 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center gap-3">
                                    {{-- Inisial platform dengan warna brand dari database --}}
                                    <span class="grid size-10 shrink-0 place-items-center rounded-xl font-semibold text-white"
                                          style="background-color: {{ $account->platform?->color ?? '#4F46E5' }}">
                                        {{ mb_strtoupper(mb_substr($account->platform?->name ?? '?', 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <p class="truncate font-medium text-neutral-900">{{ $account->account_name }}</p>
                                        <p class="truncate text-xs text-neutral-500">
                                            {{ $account->platform?->name ?? 'Unknown platform' }}
                                            &middot; {{ '@'.$account->username }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-800">
                                        {{ ucfirst($account->status) }}
                                    </span>
                                    {{-- Form disconnect dengan CSRF + method spoofing DELETE --}}
                                    <form method="POST" action="{{ route('accounts.destroy', $account) }}" data-loading-form>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                data-loading-button
                                                data-loading-label="Disconnecting..."
                                                class="inline-flex min-h-9 items-center justify-center rounded-lg border border-neutral-300 px-3 py-1.5 text-xs font-semibold text-neutral-700 transition hover:bg-neutral-100 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:cursor-wait disabled:opacity-70">
                                            <span data-button-label aria-live="polite">Disconnect</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    </div>
@endsection
