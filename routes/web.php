<?php



Route::get('/', 'HomeController@index')->name('home');
    Route::get('/parse', 'ParseController@gazetaUa')->name('parse');


Auth::routes();


