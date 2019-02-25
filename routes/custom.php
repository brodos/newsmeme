<?php

Route::get('/', 'ScreenshotController@index');

Route::post('/screenshot', 'ScreenshotController@store')->middleware('throttle:12,1');

