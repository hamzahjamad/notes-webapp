<?php

Route::get('/', function () {
    return redirect('login');
});

Route::view('/app/{path?}', 'welcome')
     ->where('path', '.*')
     ->name('react')
     ->middleware('auth');

Auth::routes();

Route::resource('/data/notes', 'NoteController');