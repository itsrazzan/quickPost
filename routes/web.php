<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SocialAccountController;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return 'Hello World';
});

// Assignment Week 2
// Default Route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'create'])->name('login');

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login.store');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $draftCount = $request->user()->contents()->where('status', 'draft')->count();

        return view('dashboard', ['draftCount' => $draftCount]);
    })->name('dashboard');

    Route::get('/analytics', function () {
        return view('workspace.analytics');
    })->name('analytics');

    Route::get('/calendar', function (Request $request) {
        $validated = $request->validate([
            'month' => ['sometimes', 'date_format:Y-m'],
        ]);
        $calendarMonth = CarbonImmutable::parse(($validated['month'] ?? now()->format('Y-m')).'-01');

        return view('workspace.calendar', ['calendarMonth' => $calendarMonth]);
    })->name('calendar');

    Route::resource('drafts', ContentController::class)
        ->except('show')
        ->names([
            'index' => 'drafts',
            'create' => 'drafts.create',
            'store' => 'drafts.store',
            'edit' => 'drafts.edit',
            'update' => 'drafts.update',
            'destroy' => 'drafts.destroy',
        ]);
    Route::post('/drafts/{draftId}/restore', [ContentController::class, 'restore'])
        ->whereNumber('draftId')
        ->name('drafts.restore');

    // Media library: upload, daftar, dan hapus media milik user.
    Route::get('/media-library', [MediaController::class, 'index'])->name('media-library');
    Route::post('/media-library', [MediaController::class, 'store'])->name('media-library.store');
    Route::delete('/media-library/{media}', [MediaController::class, 'destroy'])->name('media-library.destroy');

    Route::get('/settings', function () {
        return view('workspace.settings');
    })->name('settings');

    // Connected accounts (mock): halaman akun sosial terhubung.
    Route::get('/settings/accounts', [SocialAccountController::class, 'index'])->name('accounts');
    Route::post('/settings/accounts', [SocialAccountController::class, 'store'])->name('accounts.store');
    Route::delete('/settings/accounts/{account}', [SocialAccountController::class, 'destroy'])->name('accounts.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/program', function () {
    return view('comingsoon', ['page' => 'Program']);
});
Route::get('/ourteam', function () {
    return view('comingsoon', ['page' => 'Our team']);
});
Route::get('/contactus', function () {
    return view('comingsoon', ['page' => 'Contact us']);
});
// Route Redirect
Route::redirect('/hubungikami', '/contactus');

// Route Fallback
Route::fallback(function () {
    return view('errors.404');
})->name('404');

// Route with optional parameter
Route::get('/ourteam/{name?}',
    function ($name) {
        echo "Meet Our Team Member: $name";
    });
