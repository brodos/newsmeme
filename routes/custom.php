<?php

Route::get('/', 'ScreenshotController@index')->name('home');

Route::post('/compose', 'ScreenshotController@store')->middleware('throttle:12,1')->name('compose');
Route::get('/screenshot', 'ScreenshotController@show')->name('screenshot');

