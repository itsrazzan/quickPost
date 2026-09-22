<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
return "Hello World";
});


//Assignment Week 2
    // Default Route
Route::get('/', function () {
return view('home');
});
Route::get('/about', function () {
return view('about');
});
Route::get('/Program', function () {
return view('Program');
});
Route::get('/ourteam', function () {
return view('ourteam');
});
Route::get('/contactus', function () {
return view('contactus');
});
    //Route Redirect
Route::redirect('/hubungikami', '/contactus');

    //Route Fallback
Route::fallback(function (){
    return "Sorry, The page you are looking for is not found";
});

    //Route with optional parameter
Route::get('/ourteam/{name?}',
function ($name){
    echo "Meet Our Team Member: $name";
})
?>