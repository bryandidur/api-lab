<?php

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('', function () {
    return 'Hello World from API! ;D';
});

// Users
Route::group(['prefix' => 'users'], function () {
    Route::get('', 'UserController@list');
    Route::post('', 'UserController@store');

    Route::get('/{id}', 'UserController@get');
    Route::put('/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@delete');
});
