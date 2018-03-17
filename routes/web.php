<?php

Route::get('/', function () {
    return redirect('login');
});

Route::view('/app/{path?}', 'main')
     ->where('path', '.*')
     ->name('react')
     ->middleware('auth');

Auth::routes();

Route::apiResource('/data/notes', 'NoteController');