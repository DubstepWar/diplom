<?php



Route::get('/', 'HomeController@index')->name('home');
    Route::get('/parse', 'ParseController@korrespondent')->name('parse');


Auth::routes();


