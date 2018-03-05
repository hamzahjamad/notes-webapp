<?php



Route::get('/', function () {
    return view('welcome');
    //return redirect('login');
});

Route::view('/{path?}', 'welcome')
     ->where('path', '.*')
     ->name('react');

Auth::routes();
