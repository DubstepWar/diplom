<?php



Route::get('/', 'HomeController@index')->name('home');
    Route::get('/parse', 'ParseController@korrespondent')->name('parse');

Route::get('/chart', 'ChartController@index')->name('chart');

Auth::routes();


