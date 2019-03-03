<?php

Route::get('/', 'ScreenshotController@index')->name('home');

Route::post('/compose', 'ScreenshotController@store')->middleware('throttle:60,1')->name('compose');

Route::get('/screenshot', 'ScreenshotController@show')->name('screenshot');

Route::get('/download', 'ScreenshotController@download')->name('download');
