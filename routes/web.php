<?php



Route::get('/', 'HomeController@index')->name('home');
    Route::get('/parse', 'ParseController@korrespondent')->name('parse');

Route::get('/chart', 'ChartController@index')->name('chart');
Route::get('/korresp_chart', 'ChartsController@korrespChart')->name('korrespChart');
Route::get('/censor_chart', 'ChartsController@censorChart')->name('censorChart');


Auth::routes();


