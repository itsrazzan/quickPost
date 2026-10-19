{{-- resources/views/workspace/settings.blade.php --}}

{{-- 
    Workspace Settings View.
    Manages user profile display and calendar date/time preferences.
--}}
@extends('layouts.workspace')

@section('title', 'My settings')
@section('eyebrow', 'Preferences')
@section('page-title', 'My settings')
@section('page-description', 'Manage the profile and preferences for your demo workspace.')

@section('content')
    <div class="grid gap-5 xl:grid-cols-[15rem_minmax(0,1fr)]">
        {{-- Settings sub-navigation sidebar --}}
        <aside class="h-fit rounded-2xl border border-neutral-200 bg-white p-3"
               aria-label="Settings sections">
            <p class="px-3 py-2 text-xs font-semibold text-neutral-500">SETTINGS</p>
            <div class="rounded-xl bg-neutral-100 px-3 py-2.5 text-sm font-semibold text-neutral-900">
                Personal info
            </div>
            <p class="flex items-center justify-between px-3 py-2.5 text-sm text-neutral-500">
                Preferences <span class="text-xs">(soon)</span>
            </p>
            <p class="flex items-center justify-between px-3 py-2.5 text-sm text-neutral-500">
                Connected accounts <span class="text-xs">(soon)</span>
            </p>
        </aside>

        <div class="space-y-5">
            {{-- Section 1: Personal Profile Info --}}
            <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
                     aria-labelledby="personal-info-title">
                <div class="border-b border-neutral-200 pb-4">
                    <h2 id="personal-info-title" class="font-semibold text-neutral-900">Personal info</h2>
                    <p class="mt-1 text-sm text-neutral-500">This sample profile is not saved to a database.</p>
                </div>

                {{-- User avatar display --}}
                <div class="mt-5 flex flex-col gap-5 sm:flex-row sm:items-center">
                    <span class="grid size-16 shrink-0 place-items-center rounded-full bg-orange-100 text-lg font-semibold text-accent-strong">
                        AR
                    </span>
                    <div>
                        <p class="font-semibold text-neutral-900">Agil Razzan</p>
                        <p class="mt-1 text-sm text-neutral-500">QuickPost demo workspace</p>
                    </div>
                </div>

                {{-- Profile field definition list (<dl>, <dt>, <dd>) --}}
                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-neutral-200 p-4">
                        <dt class="text-xs font-medium text-neutral-500">Full name</dt>
                        <dd class="mt-1 font-medium text-neutral-900">Agil Razzan</dd>
                    </div>
                    <div class="rounded-xl border border-neutral-200 p-4">
                        <dt class="text-xs font-medium text-neutral-500">Email</dt>
                        <dd class="mt-1 font-medium text-neutral-900">Not connected</dd>
                    </div>
                    <div class="rounded-xl border border-neutral-200 p-4">
                        <dt class="text-xs font-medium text-neutral-500">Phone</dt>
                        <dd class="mt-1 font-medium text-neutral-900">Not added</dd>
                    </div>
                    <div class="rounded-xl border border-neutral-200 p-4">
                        <dt class="text-xs font-medium text-neutral-500">Profile photo</dt>
                        <dd class="mt-1 font-medium text-neutral-900">Upload (soon)</dd>
                    </div>
                </dl>
            </section>

            {{-- Section 2: Localization & Display Preferences --}}
            <section class="rounded-2xl border border-neutral-200 bg-white p-5 sm:p-7"
                     aria-labelledby="preferences-title">
                <div class="border-b border-neutral-200 pb-4">
                    <h2 id="preferences-title" class="font-semibold text-neutral-900">Date and time</h2>
                    <p class="mt-1 text-sm text-neutral-500">Display preferences for your calendar.</p>
                </div>
                <dl class="mt-5 grid gap-4 sm:grid-cols-3">
                    <div>
                        <dt class="text-xs font-medium text-neutral-500">First day of week</dt>
                        <dd class="mt-2 text-sm font-semibold text-neutral-900">Sunday</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-neutral-500">Date format</dt>
                        <dd class="mt-2 text-sm font-semibold text-neutral-900">DD MMM YYYY</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-neutral-500">Time format</dt>
                        <dd class="mt-2 text-sm font-semibold text-neutral-900">24 hours</dd>
                    </div>
                </dl>
                <p class="mt-5 rounded-xl bg-neutral-100 px-4 py-3 text-sm text-neutral-600">
                    Preferences are shown as examples and cannot be edited yet.
                </p>
            </section>
        </div>
    </div>
@endsection
