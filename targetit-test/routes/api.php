<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');

    Route::get('me', 'MeController');
});

Route::apiResource('users', 'UserController');
Route::apiResource('sectors', 'SectorController');
Route::apiResource('locals', 'LocalController');
Route::apiResource('rooms', 'RoomController');
Route::apiResource('schedulings', 'SchedulingController');
Route::post('schedulings/date', 'SchedulingController@schedulingsDay');
