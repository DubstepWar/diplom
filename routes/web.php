<?php



Route::get('/', 'HomeController@index')->name('home');
Route::get('/parse', 'ParseController@index')->name('parse');


Auth::routes();


