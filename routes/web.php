<?php

use App\Http\Middleware\EnsureDemoUser;
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


// Routes for Login or sign up page
Route::get('/login', function (Request $request) {
    // check if the session has a demo user name, if so redirect to dashboard
    if ($request->session()->has('demo_user_name')) {
        return to_route('dashboard');
    }

    $intent = $request->query('intent') === 'signup' ? 'signup' : 'login';
    // if there is no session, then show the login page with the intent
    return view('auth.login', ['intent' => $intent]);
})->name('login');


// send post request for demo session
Route::post('/demo-session', function (Request $request) {
    $request->validate([
        'intent' => ['required', 'in:login,signup'],
    ]);

    $request->session()->regenerate();
    $request->session()->put('demo_user_name', 'Agil Razzan');
    //redirect to dashboard after setting the session
    return to_route('dashboard');
})->name('demo-session.store');


//====Route for dashboard=====
// check user session, if not redirect to login page
Route::middleware(EnsureDemoUser::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
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

    Route::get('/drafts', function () {
        return view('workspace.drafts');
    })->name('drafts');

    Route::get('/media-library', function () {
        return view('workspace.media-library');
    })->name('media-library');

    Route::get('/settings', function () {
        return view('workspace.settings');
    })->name('settings');
    // Logout route
    Route::post('/logout', function (Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    })->name('logout'); 
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
