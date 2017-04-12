<?php
Route::get('fire', function () {
    event(new App\Events\EventName());
    return "event fired";
});

Route::get('/', function () {
    return view('test');
});

Route::resource('/charts', 'ChartsResultController');
// Route::get('/charts', 'ChartsController@index')->name('charts');
Route::post('/charts/change-type', 'ChartsResultController@changeType')->name('charts.changeType');
// Route::get('/charts/edit/{charts}', 'ChartsController@edit')->name('charts.edit');
// Route::post('/charts/update', 'ChartsController@update')->name('charts.update');