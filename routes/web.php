<?php



Route::get('/', 'HomeController@index')->name('home');
    Route::get('/parse', 'ParseController@korrespondent')->name('parse');

Route::get('/chart', 'ChartController@index')->name('chart');
Route::get('/korresp_chart', 'ChartsController@korrespChart')->name('korrespChart');
Route::get('/korresp_charts', 'ChartsController@show');


Auth::routes();


