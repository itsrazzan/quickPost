<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
return "Hello World";
});


//Assignment Week 2
    // Default Route
Route::get('/', function () {
return view('home');
})->name('home');
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
    //Route Redirect
Route::redirect('/hubungikami', '/contactus');

    //Route Fallback
Route::fallback(function (){
    return view('errors.404');
})-> name('404');

    //Route with optional parameter
Route::get('/ourteam/{name?}',
function ($name){
    echo "Meet Our Team Member: $name";
})
?>